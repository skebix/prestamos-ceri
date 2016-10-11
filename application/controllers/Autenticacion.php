<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 31/03/2016
 * Time: 09:30 AM
 */

class Autenticacion extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    function index(){

        //Lo primero es ver si ya ingresó, no?
        $cedula = $this->session->cedula;
        if($cedula){
            $this->session->set_flashdata('info', 'Ya ha ingresado al sistema.');
            redirect('inicio');
        }

        $data['title'] = 'Ingresar';

        $this->form_validation->set_rules('cedula', 'C&eacute;dula', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required|callback__password_correct');

        if (!$this->form_validation->run()) {
            //Si no pasa las reglas de validación, mostramos el formulario
            $this->parser->parse('templates/header_basic', $data);
            $this->parser->parse('authentication/login_form', $data);
            $this->parser->parse('templates/footer_basic', $data);
        }else{
            //Si los datos tienen el formato correcto, agregar los datos a la sesión
            $cedula = $this->input->post('cedula');
            $usuario = $this->usuarios_model->get_usuario($cedula);

            if($usuario){
                $this->session->set_userdata($usuario);

                $this->session->set_flashdata('success', 'Acaba de ingresar al sistema.');
                redirect('inicio');
            }else{
                $this->session->set_flashdata('danger', 'Hubo un problema al conectarse con la Base de Datos. Por favor intente ingresar nuevamente.');
                redirect('inicio');
            }
        }
    }

    public function forgot_password(){
        $data['title'] = 'Olvid&oacute; su contrase&ntilde;a';

        $this->form_validation->set_rules('email', 'Correo electr&oacute;nico', 'required|callback__email_exists');

        if(!$this->form_validation->run()){

            //Si no pasa las reglas de validación, mostramos el formulario
            $this->parser->parse('templates/header_basic', $data);
            $this->parser->parse('authentication/forgot_password', $data);
            $this->parser->parse('templates/footer_basic', $data);
        }else{

            $email = $this->input->post('email');

            //Si los datos tienen el formato correcto, debo crear un token temporal para cambio de contraseña

            //Acá genero el token de un sólo uso
            $token_temporal = bin2hex(openssl_random_pseudo_bytes(16));
            $hashed_password['forgot_password_token'] = $this->bcrypt->hash_password($token_temporal);

            $data['token_temporal'] = $token_temporal;

            //Tomo el email del formulario y busco ese usuario en la BD (va a existir, porque ya se validó con email_exist)
            $usuario = $this->usuarios_model->get_usuario_by_email($email);
            if($usuario){
                $data['cedula'] = $usuario['cedula'];

                //Actualizo el token en la BD
                $this->usuarios_model->update_token($usuario['cedula'], $hashed_password);
            }else{
                $this->session->set_flashdata('danger', 'Hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('inicio');
            }

            $this->email->from('skebix@skebix.com.ve', 'PRESTAMOS-CERI');
            $this->email->to($email);
            $this->email->subject('Recuperar contraseña');

            $mensaje = $this->parser->parse('email/forgot_password', $data, true);

            $this->email->message($mensaje);
            $resultado = $this->email->send();

            if($resultado){
                $this->session->set_flashdata('success', 'Correo enviado satisfactoriamente.');
                redirect('inicio');
            }
            
            $this->session->set_flashdata('danger', 'Hubo un problema al enviar el correo electr&oacute;nico, por favor intente nuevamente.');
            redirect('autenticacion/forgot_password');
        }
    }

    public function validar_token($cedula, $unhashed_token){

        $usuario = $this->usuarios_model->get_usuario($cedula);
        if($usuario){
            if($this->bcrypt->check_password($unhashed_token, $usuario['forgot_password_token'])){
                $this->session->set_userdata('reset_password', true);
                $this->session->set_userdata('cedula', $cedula);

                $this->reset_password();
            }else{
                $this->session->set_flashdata('warning', 'El token ya fue utilizado o es inv&aacute;lido.');
                redirect('inicio');
            }
        }else{
            $this->session->set_flashdata('danger', 'Hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
            redirect('inicio');
        }
    }

    public function reset_password(){

        $reset_password = $this->session->reset_password;
        if($reset_password){
            $this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required');
            $this->form_validation->set_rules('password_confirmation', 'Confirmar contrase&ntilde;a', 'required|matches[password]');

            if(!$this->form_validation->run()){
                $data['title'] = 'Nueva contrase&ntilde;a';

                $this->parser->parse('templates/header_basic', $data);
                $this->parser->parse('authentication/reset_password', $data);
                $this->parser->parse('templates/footer_basic', $data);
            }else{
                $cedula = $this->session->cedula;

                $raw_password = $this->input->post('password');
                $data['hashed_password'] = $this->bcrypt->hash_password($raw_password);
                $data['forgot_password_token'] = null;

                $was_updated = $this->usuarios_model->update_by_cedula('usuarios', $cedula, $data);
                
                if($was_updated){
                    $eliminar = array('id', 'cedula', 'administrador', 'reset_password', 'mensaje');
                    $this->session->unset_userdata($eliminar);
                    $this->session->set_flashdata('success', 'Contrase&ntilde;a cambiada satisfactoriamente.');
                    redirect('inicio');
                }else{
                    $this->session->set_flashdata('danger', 'Hubo un problema al conectarse con la Base de Datos. Por favor intente ingresar nuevamente.');
                    redirect('inicio');
                }
            }
        }else{
            $this->session->set_flashdata('warning', 'El token ya fue utilizado o es inv&aacute;lido.');
            redirect('inicio');
        }
    }

    public function salir(){
        $eliminar = array('id', 'cedula', 'administrador', 'reset_password', 'mensaje');
        $this->session->unset_userdata($eliminar);
        $this->session->set_flashdata('success', 'Sesi&oacute;n cerrada.');
        redirect('inicio');
    }

    public function _email_exists($str){
        $this->form_validation->set_message('_email_exists', 'El correo electr&oacute;nico no se encuentra registrado en el sistema.');
        $usuario = $this->usuarios_model->get_usuario_by_email($str);
        return ($usuario)? true: false;
    }

    public function _password_correct($str){
        $this->form_validation->set_message('_password_correct', 'Combinación de c&eacute;dula y contrase&ntilde;a inv&aacute;lida.');
        $cedula = $this->input->post('cedula');
        $usuario = $this->usuarios_model->get_usuario($cedula);
        return $this->bcrypt->check_password($str, $usuario['hashed_password']);
    }
}