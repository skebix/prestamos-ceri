<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 07/04/2016
 * Time: 03:09 PM
 */

class Categorias_usuario extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        echo "Por diseñar";
    }

    function crear(){

        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Crear categor&iacute;a';

            $this->form_validation->set_rules('categoria_usuario', 'Categor&iacute;a de usuario', 'trim|required|callback__alpha_space|max_length[255]');

            if (!$this->form_validation->run()) {

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('categorias_usuario/create', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar la nueva categoría en la BD
                $usuario = array();

                $datos['categoria'] = $this->input->post('categoria_usuario');

                $was_inserted = $this->categoria_model->create_categoria($datos);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_inserted){
                    redirect('inicio'); //TODO Redirigir con éxito al inicio
                }

                //Si llegué a este punto es porque no pudo guardar el usuario
                redirect('inicio'); //TODO Redirigir con error al inicio
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            redirect('inicio'); //TODO redirect al inicio con error
        }
    }

    public function _alpha_space($str){
        $this->form_validation->set_message('_alpha_space', 'El campo {field} puede contener &uacute;nicamente letras y espacios.');
        //To my future self: ^ es el inicio, $ el fin, \p{L} son las letras y el modificador u trata el string como UTF-8
        return (preg_match('/^[\p{L} ]*$/u', $str))? true: false;
    }
}