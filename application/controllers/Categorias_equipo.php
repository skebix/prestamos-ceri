<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 08/04/2016
 * Time: 09:35 AM
 */

class Categorias_equipo extends CI_Controller {

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

            $this->form_validation->set_rules('categoria_equipo', 'Categor&iacute;a de equipo', 'trim|required|callback__alpha_special|max_length[255]');

            if (!$this->form_validation->run()) {

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('categorias_equipo/create', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar la nueva categoría en la BD
                $datos['categoria'] = $this->input->post('categoria_equipo');

                $table = 'categoria_equipo';
                $was_inserted = $this->categoria_model->create_categoria($table, $datos);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_inserted){
                    redirect('categorias-equipo/listar'); //TODO Redirigir con éxito al inicio
                }

                //Si llegué a este punto es porque no pudo guardar el equipo
                redirect('categorias-equipo/listar'); //TODO Redirigir con error al inicio
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            redirect('inicio'); //TODO redirect al inicio con error
        }
    }

    public function listar(){

        //Lo primero es ver si es Administrador, no?
        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Lista de Categor&iacute;as de equipo';

            $table = 'categoria_equipo';
            $categorias = $this->categoria_model->get_categorias($table);
            $data['categorias'] = $categorias;

            $this->parser->parse('templates/header', $data);
            $this->parser->parse('categorias_equipo/show', $data);
            $this->parser->parse('templates/footer', $data);
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            redirect('inicio'); //TODO redirect al inicio con error
        }
    }

    public function actualizar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){

            //Tomo los datos del equipo de la BD, para poder pre-llenar el formulario
            $data['title'] = 'Actualizar Categor&iacute;a de equipo';

            $table = 'categoria_equipo';

            $categoria = $this->categoria_model->get_categoria($table, $id);
            $data['id'] = $categoria['id'];
            $data['categoria'] = $categoria['categoria'];

            $this->form_validation->set_rules('categoria_equipo', 'Categor&iacute;a de equipo', 'trim|required|callback__alpha_special|max_length[255]');

            if (!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('categorias_equipo/update', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                $categoria['categoria'] = $this->input->post('categoria_equipo');

                //Si los datos tienen el formato correcto, debo registrar al equipo en la BD
                $was_updated = $this->categoria_model->update_categoria($table, $id, $categoria);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_updated){
                    redirect('categorias-equipo/listar'); //TODO Redirigir con éxito al inicio
                }

                //Si llegué a este punto es porque no pudo guardar el equipo
                redirect('categorias-equipo/listar'); //TODO Redirigir con error al inicio
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            redirect('inicio'); //TODO redirect al inicio con error
        }
    }

    public function eliminar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){
            $table = 'categoria_equipo';
            $delete_id = $this->categoria_model->delete_categoria($table, $id);
            if($delete_id){
                //TODO redirigir a la lista con éxito
                redirect('categorias-equipo/listar');
            }else{
                //TODO redirigir a la lista con error
                redirect('categorias-equipo/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            redirect('inicio'); //TODO redirect al inicio con error
        }
    }

    public function _alpha_special($str){
        $this->form_validation->set_message('_alpha_special', 'El campo {field} puede contener &uacute;nicamente letras, números y los caracteres ().');
        //To my future self: ^ es el inicio, $ el fin, \p{L} son las letras y el modificador u trata el string como UTF-8
        return (preg_match('/^[\p{L}0-9 ()]*$/u', $str))? true: false;
    }
}