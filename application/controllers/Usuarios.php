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

    function registro(){

        $data['title'] = 'Registro';

        $categorias_usuario = $this->usuarios_model->get_categorias_usuario();
        $data['categorias_usuario'] = $categorias_usuario;

        $this->form_validation->set_rules('primer_nombre', 'Primer nombre', 'trim|required|callback__alpha_space|max_length[255]');
        $this->form_validation->set_rules('segundo_nombre', 'Segundo nombre', 'trim|required|callback__alpha_space|max_length[255]');
        $this->form_validation->set_rules('primer_apellido', 'Primer apellido', 'trim|required|callback__alpha_space|max_length[255]');
        $this->form_validation->set_rules('segundo_apellido', 'Segundo apellido', 'trim|required|callback__alpha_space|max_length[255]');
        $this->form_validation->set_rules('cedula', 'C&eacute;dula', 'required|is_unique[usuarios.cedula]|is_natural_no_zero', array('is_unique' => 'Esa c&eacute;dula ya se encuentra registrada en el sistema.'));
        $this->form_validation->set_rules('email', 'Correo electr&oacute;nico', 'required|is_unique[usuarios.email]|valid_email', array('is_unique' => 'Ese correo electr&oacute;nico ya se encuentra registrado en el sistema.'));
        $this->form_validation->set_rules('telefono', 'Tel&eacute;fono', 'required|is_natural_no_zero|exact_length[7]');
        $this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required');
        $this->form_validation->set_rules('password_confirmation', 'Confirmar contrase&ntilde;a', 'required|matches[password]');

        if (!$this->form_validation->run()) {

            //Si el que intenta crear la cuenta es un Administrador, le doy opciones para crear nuevos administradores.
            $administrador = $this->session->administrador;
            $data['administrador'] = $administrador;

            //Si no pasa las reglas de validación, mostramos el formulario
            $this->parser->parse('templates/header', $data);
            $this->parser->parse('usuarios/register', $data);
            $this->parser->parse('templates/footer', $data);
        }else{
            //Si los datos tienen el formato correcto, debo registrar al usuario en la BD
            $usuario = array();

            $usuario['primer_nombre'] = $this->input->post('primer_nombre');
            $usuario['primer_nombre'] = $this->input->post('primer_nombre');
            $usuario['segundo_nombre'] = $this->input->post('segundo_nombre');
            $usuario['primer_apellido'] = $this->input->post('primer_apellido');
            $usuario['segundo_apellido'] = $this->input->post('segundo_apellido');
            $usuario['cedula'] = $this->input->post('cedula');
            $usuario['email'] = $this->input->post('email');
            $usuario['id_categoria_usuario'] = $this->input->post('id_categoria_usuario');

            $codigo_area = $this->input->post('codigo_area');
            $telefono = $this->input->post('telefono');
            $usuario['telefono'] = $codigo_area . '-' . $telefono;

            $raw_password = $this->input->post('password');
            $password = $this->bcrypt->hash_password($raw_password);
            $usuario['hashed_password'] = $password;

            //TO MY FUTURE SELF: 2 is a regular user.
            $usuario['id_administracion'] = ($this->input->post('id_administracion')) ? $this->input->post('id_administracion') : 2;

            $was_inserted = $this->usuarios_model->create_user($usuario);

            //Si lo guardó correctamente, redirigir al home con éxito
            if($was_inserted){
                redirect('home'); //TODO Redirigir con éxito al home
            }

            //Si llegué a este punto es porque no pudo guardar el usuario
            redirect('home'); //TODO Redirigir con error al home
        }
    }

    public function listar(){

        //Lo primero es ver si es Administrador, no?
        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Lista de Usuarios';

            $usuarios = $this->usuarios_model->get_usuarios();
            $data['usuarios'] = $usuarios;

            $this->parser->parse('templates/header', $data);
            $this->parser->parse('usuarios/show', $data);
            $this->parser->parse('templates/footer', $data);
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            redirect('home'); //TODO redirect al home con error
        }
    }

    public function detalles($cedula){

        //Lo primero es ver si es Administrador, o si el que intenta ver los detalles es el mismo usuario
        $cedula_sesion = $this->session->cedula;
        $administrador = $this->session->administrador;
        if($administrador || ($cedula === $cedula_sesion)){
            $data['title'] = 'Detalles del Usuario';

            $usuario = $this->usuarios_model->get_usuario($cedula);
            $administracion = $this->categoria_model->get_administracion($usuario['id_administracion']);
            $categoria = $this->categoria_model->get_categoria($usuario['id_categoria_usuario']);

            $data['tipo_usuario'] = $administracion['tipo_usuario'];
            $data['categoria'] = $categoria['categoria'];
            $data = array_merge($data, $usuario);

            $this->parser->parse('templates/header', $data);
            $this->parser->parse('usuarios/details', $data);
            $this->parser->parse('templates/footer', $data);
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            redirect('home'); //TODO redirect al home con error
        }
    }

    public function actualizar($cedula){

        //Lo primero es ver si es Administrador, o si el que intenta actualizar es el mismo usuario
        $cedula_sesion = $this->session->cedula;
        $administrador = $this->session->administrador;
        if($administrador || ($cedula === $cedula_sesion)){

            $data['title'] = 'Actualizar Usuario';

            $usuario = $this->usuarios_model->get_usuario($cedula);
            $data = array_merge($data, $usuario);
            $data['telefono'] = substr($data['telefono'], -7);

            $this->form_validation->set_rules('primer_nombre', 'Primer nombre', 'trim|required|callback__alpha_space|max_length[255]');
            $this->form_validation->set_rules('segundo_nombre', 'Segundo nombre', 'trim|required|callback__alpha_space|max_length[255]');
            $this->form_validation->set_rules('primer_apellido', 'Primer apellido', 'trim|required|callback__alpha_space|max_length[255]');
            $this->form_validation->set_rules('segundo_apellido', 'Segundo apellido', 'trim|required|callback__alpha_space|max_length[255]');
            $this->form_validation->set_rules('cedula', 'C&eacute;dula', 'required|is_unique[usuarios.cedula]|is_natural_no_zero', array('is_unique' => 'Esa c&eacute;dula ya se encuentra registrada en el sistema.'));
            $this->form_validation->set_rules('email', 'Correo electr&oacute;nico', 'required|is_unique[usuarios.email]|valid_email', array('is_unique' => 'Ese correo electr&oacute;nico ya se encuentra registrado en el sistema.'));
            $this->form_validation->set_rules('telefono', 'Tel&eacute;fono', 'required|is_natural_no_zero|exact_length[7]');
            $this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required');
            $this->form_validation->set_rules('password_confirmation', 'Confirmar contrase&ntilde;a', 'required|matches[password]');

            if (!$this->form_validation->run()){

                //Si el que intenta crear la cuenta es un Administrador, le doy opciones para cambiar el tipo a Administrador.
                $data['administrador'] = $administrador;

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('usuarios/update', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar al usuario en la BD
                $usuario = array();

                $usuario['primer_nombre'] = $this->input->post('primer_nombre');
                $usuario['segundo_nombre'] = $this->input->post('segundo_nombre');
                $usuario['primer_apellido'] = $this->input->post('primer_apellido');
                $usuario['segundo_apellido'] = $this->input->post('segundo_apellido');
                $usuario['cedula'] = $this->input->post('cedula');
                $usuario['email'] = $this->input->post('email');
                $usuario['id_categoria_usuario'] = $this->input->post('id_categoria_usuario');

                $codigo_area = $this->input->post('codigo_area');
                $telefono = $this->input->post('telefono');
                $usuario['telefono'] = $codigo_area . '-' . $telefono;

                $raw_password = $this->input->post('password');
                $password = $this->bcrypt->hash_password($raw_password);
                $usuario['hashed_password'] = $password;

                //TO MY FUTURE SELF: 2 is a regular user.
                $usuario['id_administracion'] = ($this->input->post('id_administracion')) ? $this->input->post('id_administracion') : 2;

                $was_inserted = $this->usuarios_model->create_user($usuario);

                //Si lo guardó correctamente, redirigir al home con éxito
                if($was_inserted){
                    redirect('home'); //TODO Redirigir con éxito al home
                }

                //Si llegué a este punto es porque no pudo guardar el usuario
                redirect('home'); //TODO Redirigir con error al home
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            redirect('home'); //TODO redirect al home con error
        }
    }

    public function eliminar($cedula){

        //Lo primero es ver si es Administrador, o si el que intenta borrarlo es el mismo usuario
        $cedula_sesion = $this->session->cedula;
        $administrador = $this->session->administrador;
        if($administrador || ($cedula === $cedula_sesion)){

            $data['title'] = 'Lista de Usuarios';

            $delete_id = $this->usuarios_model->delete_user($cedula);
            if($delete_id){
                //TODO redirigir a la lista con éxito
                redirect('usuarios/listar');
            }else{
                //TODO redirigir a la lista con error
                redirect('usuarios/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            redirect('home'); //TODO redirect al home con error
        }
    }

    public function _alpha_space($str){
        $this->form_validation->set_message('_alpha_space', 'El campo {field} puede contener &uacute;nicamente letras y espacios.');
        //To my future self: ^ es el inicio, $ el fin, \p{L} son las letras y el modificador u trata el string como UTF-8
        return (preg_match('/^[\p{L} ]*$/u', $str))? true: false;
    }
}