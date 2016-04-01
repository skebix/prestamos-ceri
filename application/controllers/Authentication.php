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
            $this->load->view('templates/header', $data);
            $this->load->view('authentication/login_form', $data);
            $this->load->view('templates/footer');
        }else{
            //Si los datos tienen el formato correcto, debo verificar si el usuario existe en la BD
            $cedula = $this->input->post('cedula');
            $password = $this->input->post('password');

            $usuario = $this->usuarios_model->get_usuario($cedula);

            //Ahora, si existe un usuario en la BD con esa cédula, debo verificar que la contraseña coincida
            if ($this->bcrypt->check_password($password, $usuario['hashed_password'])) {
                $this->session->set_userdata($usuario);

                redirect('home'); //TODO Redirigir con éxito al home
            }

            //Si llegué a este punto es porque la contraseña no coincide
            redirect('home'); //TODO Redirigir con error al home
        }
    }

    public function logout(){
        $this->session->unset_userdata('cedula');
        redirect('home'); //TODO Redirigir con éxito al home
    }
}