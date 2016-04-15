<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 08:14 AM
 */

class Espacios extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        echo "Por diseñar";
    }

    function crear(){

        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Crear Espacio';

            $this->form_validation->set_rules('espacio', 'Nombre de espacio', 'trim|required|callback__alpha_special|max_length[255]');

            if (!$this->form_validation->run()) {

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('espacios/create', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar la nueva categoría en la BD
                $datos['nombre_espacio'] = $this->input->post('espacio');

                $table = 'espacios';
                $was_inserted = $this->espacios_model->create_espacio($table, $datos);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_inserted){
                    $this->session->set_userdata('mensaje', 'El espacio fue creado satisfactoriamente.');
                    redirect('espacios/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el servicio
                $this->session->set_userdata('mensaje', 'No se pudo crear su espacio.');
                redirect('espacios/listar');
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

            $data['title'] = 'Lista de Espacios';

            $table = 'espacios';
            $espacios = $this->espacios_model->get_espacios($table);
            $data['espacios'] = $espacios;

            $this->parser->parse('templates/header', $data);
            $this->parser->parse('espacios/show', $data);
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
            $data['title'] = 'Actualizar Espacio';

            $table = 'espacios';

            $espacio = $this->espacios_model->get_espacio($table, $id);
            $data = array_merge($data, $espacio);

            $atributos_otro_espacio = array(
                'class'       => 'checkbox',
            );

            $data['atributos_otro_espacio'] = $atributos_otro_espacio;

            $this->form_validation->set_rules('espacio', 'Nombre del espacio', 'trim|required|callback__alpha_special|max_length[255]');

            if (!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('espacios/update', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                $espacio['nombre_espacio'] = $this->input->post('espacio');
                $espacio['otro_espacio'] = ($this->input->post('otro_espacio')) ? $this->input->post('otro_espacio') : FALSE;

                //Si los datos tienen el formato correcto, debo registrar al servicio en la BD
                $was_updated = $this->espacios_model->update_espacio($table, $id, $espacio);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_updated){
                    $this->session->set_userdata('mensaje', 'El espacio fue actualizado satisfactoriamente.');
                    redirect('espacios/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el servicio
                $this->session->set_userdata('mensaje', 'No se pudo actualizar su espacio.');
                redirect('espacios/listar');
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
            $table = 'espacios';
            $delete_id = $this->espacios_model->delete_espacio($table, $id);
            if($delete_id){
                $this->session->set_userdata('mensaje', 'Espacio eliminado satisfactoriamente.');
                redirect('espacios/listar');
            }else{
                $this->session->set_userdata('mensaje', 'No se pudo eliminar su espacio.');
                redirect('espacios/listar');
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