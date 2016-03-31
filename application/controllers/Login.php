<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 31/03/2016
 * Time: 09:30 AM
 */

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('text');
    }

    function index(){
        $data['title'] = 'Ingresar';

        $this->form_validation->set_rules('cedula', 'C&eacute;dula', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required');

        if (!$this->form_validation->run()) {
            //Si no pasa las reglas de validación, mostramos el formulario
            $this->load->view('templates/header', $data);
            $this->load->view('templates/login/login_form', $data);
            $this->load->view('templates/footer');
        }else{
            //Si los datos tienen el formato correcto, debo verificar si el usuario existe en la BD
            $cedula = $this->input->post('cedula');
            $password = $this->input->post('password');

            $usuario = $this->usuarios_model->get_usuario($cedula);

            $str = $this->db->last_query(); echo $str; die();
            $password = $this->input->post('password');
            $this->load->view('welcome_message');
        }
    }

}