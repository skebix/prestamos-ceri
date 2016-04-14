<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 13/04/2016
 * Time: 04:16 PM
 */

class Categorias_servicio extends CI_Controller {

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

            $this->form_validation->set_rules('categoria_servicio', 'Categor&iacute;a de servicio', 'trim|required|callback__alpha_special|max_length[255]');

            if (!$this->form_validation->run()) {

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('categorias_servicio/create', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar la nueva categoría en la BD
                $datos['categoria'] = $this->input->post('categoria_servicio');

                $table = 'categoria_servicio';
                $was_inserted = $this->categoria_model->create_categoria($table, $datos);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_inserted){
                    $this->session->set_userdata('mensaje', 'Categor&iacute;a de servicio creada satisfactoriamente.');
                    redirect('categorias-servicio/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el servicio
                $this->session->set_userdata('mensaje', 'No se pudo crear su categor&iacute;a de servicio.');
                redirect('categorias-servicio/listar');
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

            $data['title'] = 'Lista de Categor&iacute;as de servicio';

            $table = 'categoria_servicio';
            $categorias = $this->categoria_model->get_categorias($table);
            $data['categorias'] = $categorias;

            $this->parser->parse('templates/header', $data);
            $this->parser->parse('categorias_servicio/show', $data);
            $this->parser->parse('templates/footer', $data);
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

            //Tomo los datos del servicio de la BD, para poder pre-llenar el formulario
            $data['title'] = 'Actualizar Categor&iacute;a de servicio';

            $table = 'categoria_servicio';

            $categoria = $this->categoria_model->get_categoria($table, $id);
            $data['id'] = $categoria['id'];
            $data['categoria'] = $categoria['categoria'];

            $this->form_validation->set_rules('categoria_servicio', 'Categor&iacute;a de servicio', 'trim|required|callback__alpha_special|max_length[255]');

            if (!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('categorias_servicio/update', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                $categoria['categoria'] = $this->input->post('categoria_servicio');

                //Si los datos tienen el formato correcto, debo registrar al servicio en la BD
                $was_updated = $this->categoria_model->update_categoria($table, $id, $categoria);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_updated){
                    $this->session->set_userdata('mensaje', 'Categor&iacute;a de servicio actualizada satisfactoriamente.');
                    redirect('categorias-servicio/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el servicio
                $this->session->set_userdata('mensaje', 'No se pudo actualizar su categor&iacute;a de servicio.');
                redirect('categorias-servicio/listar');
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
            $table = 'categoria_servicio';
            $delete_id = $this->categoria_model->delete_categoria($table, $id);
            if($delete_id){
                $this->session->set_userdata('mensaje', 'Categor&iacute;a de servicio eliminada satisfactoriamente.');
                redirect('categorias-servicio/listar');
            }else{
                $this->session->set_userdata('mensaje', 'No se pudo eliminar su categor&iacute;a de servicio.');
                redirect('categorias-servicio/listar');
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