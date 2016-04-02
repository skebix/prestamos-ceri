<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 31/03/2016
 * Time: 07:45 AM
 */

class Usuarios extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('usuarios_model');
        $this->load->helper('url_helper');
        $this->load->helper('text');
    }

    public function index(){
        echo "Por diseñar";

    }

    public function mostrar($cedula = NULL){

        //Vamos a la BD con la cédula que recibimos como parámetro
        $usuario = $this->usuarios_model->get_usuario($cedula);
        if($usuario){

        }
    }

    function registro(){

        $data['title'] = 'Registro';

        $categorias_usuario = $this->usuarios_model->get_categorias_usuario();
        $data['categorias_usuario'] = $categorias_usuario;

        $this->form_validation->set_rules('primer_nombre', 'Primer nombre', 'required|');
        $this->form_validation->set_rules('cedula', 'C&eacute;dula', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required');

        if (!$this->form_validation->run()) {
            //Si no pasa las reglas de validación, mostramos el formulario
            $this->parser->parse('templates/header', $data);
            $this->parser->parse('usuarios/register_form', $data);
            $this->parser->parse('templates/footer', $data);
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
}