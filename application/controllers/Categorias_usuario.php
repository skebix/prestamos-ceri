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
        $this->listar();
    }

    function crear(){

        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Crear categor&iacute;a';

            $this->form_validation->set_rules('categoria_usuario', 'Categor&iacute;a de usuario', 'trim|required|callback__alpha_special|max_length[255]');

            if (!$this->form_validation->run()) {

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('categorias_usuario/create', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar la nueva categoría en la BD
                $datos['categoria'] = $this->input->post('categoria_usuario');

                $was_inserted = $this->categoria_model->create_categoria('categoria_usuario', $datos);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_inserted){
                    $this->session->set_userdata('mensaje', 'Categor&iacute;a de usuario creada satisfactoriamente.');
                    redirect('categorias-usuario/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el usuario
                $this->session->set_userdata('mensaje', 'No se pudo crear su categor&iacute;a de usuario. Por favor intente nuevamente.');
                redirect('categorias-usuario/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function listar(){

        //Lo primero es ver si es Administrador, no?
        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Lista de Categor&iacute;as de usuario';

            $categorias = $this->categoria_model->get_categorias('categoria_usuario');
            if($categorias){
                $data['categorias'] = $categorias;

                $this->parser->parse('templates/header', $data);
                $this->parser->parse('categorias_usuario/show', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                $this->session->set_userdata('mensaje', 'Hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('inicio');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function actualizar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){

            //Tomo los datos del usuario de la BD, para poder pre-llenar el formulario
            $data['title'] = 'Actualizar Categor&iacute;a de usuario';

            $categoria = $this->categoria_model->get_categoria('categoria_usuario', $id);
            if($categoria){
                $data['id'] = $categoria['id'];
                $data['categoria'] = $categoria['categoria'];
            }else{
                $this->session->set_userdata('mensaje', 'La categor&iacute;a que intenta actualizar no existe o hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('inicio');
            }

            $this->form_validation->set_rules('categoria_usuario', 'Categor&iacute;a de usuario', 'trim|required|callback__alpha_special|max_length[255]');

            if (!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('categorias_usuario/update', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                $categoria['categoria'] = $this->input->post('categoria_usuario');

                //Si los datos tienen el formato correcto, debo registrar al usuario en la BD
                $was_updated = $this->categoria_model->update_categoria('categoria_usuario', $id, $categoria);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_updated){
                    $this->session->set_userdata('mensaje', 'Categor&iacute;a de usuario actualizada satisfactoriamente.');
                    redirect('categorias-usuario/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el usuario
                $this->session->set_userdata('mensaje', 'No se pudo actualizar su categor&iacute;a de usuario. Por favor intente nuevamente.');
                redirect('categorias-usuario/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function eliminar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){
            $table = 'categoria_usuario';
            $delete_id = $this->categoria_model->delete_categoria($table, $id);
            if($delete_id){
                $this->session->set_userdata('mensaje', 'Categor&iacute;a de usuario eliminada satisfactoriamente.');
                redirect('categorias-usuario/listar');
            }else{
                $this->session->set_userdata('mensaje', 'No se pudo eliminar su categor&iacute;a de usuario.');
                redirect('categorias-usuario/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function _alpha_special($str){
        $this->form_validation->set_message('_alpha_special', 'El campo {field} puede contener &uacute;nicamente letras, números y los caracteres ().');
        //To my future self: ^ es el inicio, $ el fin, \p{L} son las letras y el modificador u trata el string como UTF-8
        return (preg_match('/^[\p{L}0-9 ()]*$/u', $str))? true: false;
    }
}