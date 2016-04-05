<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 31/03/2016
 * Time: 09:30 AM
 */

class Authentication extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    function index(){

        //Lo primero es ver si ya ingresó, no?
        $cedula = $this->session->cedula;
        if($cedula){
            redirect('home'); //TODO Redirigir con éxito al home
        }

        $data['title'] = 'Ingresar';

        $this->form_validation->set_rules('cedula', 'C&eacute;dula', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required');

        if (!$this->form_validation->run()) {
            //Si no pasa las reglas de validación, mostramos el formulario
            $this->parser->parse('templates/header', $data);
            $this->parser->parse('authentication/login_form', $data);
            $this->parser->parse('templates/footer', $data);
        }else{
            //Si los datos tienen el formato correcto, debo verificar si el usuario existe en la BD
            $cedula = $this->input->post('cedula');
            $password = $this->input->post('password');

            $usuario = $this->usuarios_model->get_usuario($cedula);

            //Ahora, si existe un usuario en la BD con esa cédula, debo verificar que la contraseña coincida
            if ($this->bcrypt->check_password($password, $usuario['hashed_password'])) {
                $this->session->set_userdata($usuario);
                $administrador = ($usuario['id_administracion'] === '1') ? true : false;
                $this->session->set_userdata('administrador', $administrador);

                redirect('home'); //TODO Redirigir con éxito al home
            }

            //Si llegué a este punto es porque la contraseña no coincide
            redirect('home'); //TODO Redirigir con error al home
        }
    }

    public function forgot_password(){
        $data['title'] = 'Olvid&oacute; su contrase&ntilde;a';

        $this->form_validation->set_rules('email', 'Correo electr&oacute;nico', 'required|callback__email_exists');

        if(!$this->form_validation->run()){

            //Si no pasa las reglas de validación, mostramos el formulario
            $this->parser->parse('templates/header', $data);
            $this->parser->parse('authentication/forgot_password', $data);
            $this->parser->parse('templates/footer', $data);
        }else{
            //Si los datos tienen el formato correcto, debo crear un token temporal para cambio de contraseña

            //Acá genero el token de un sólo uso
            $token_temporal = bin2hex(openssl_random_pseudo_bytes(16));
            $hashed_password['forgot_password_token'] = $this->bcrypt->hash_password($token_temporal);
            $data['token_temporal'] = $token_temporal;

            //Tomo el email del formulario y busco ese usuario en la BD (va a existir, porque ya se validó con email_exist)
            $email = $this->input->post('email');
            $usuario = $this->usuarios_model->get_usuario_by_email($email);

            //Actualizo el token en la BD
            $updated = $this->usuarios_model->update_token($usuario['cedula'], $hashed_password);

            $this->email->from('skebix@skebix.com.ve', 'PRESTAMOS-CERI');
            $this->email->to($email);
            $this->email->subject('Recuperar contraseña');

            $mensaje = $this->parser->parse('email/forgot_password', $data, true);

            $this->email->message($mensaje);
            $resultado = $this->email->send();
            echo $this->email->print_debugger();
        }
    }

    public function salir(){
        $eliminar = array('cedula', 'administrador');
        $this->session->unset_userdata($eliminar);
        $this->session->sess_destroy();
        redirect('home'); //TODO Redirigir con éxito al home
    }

    public function _email_exists($str){
        $this->form_validation->set_message('_email_exists', 'El correo electr&oacute;nico no se encuentra registrado en el sistema.');
        $usuario = $this->usuarios_model->get_usuario_by_email($str);
        return ($usuario)? true: false;
    }
}