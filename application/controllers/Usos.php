<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 10:51 AM
 */

class Usos extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        echo "Por diseñar";
    }

    function crear(){

        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Crear Uso';

            $this->form_validation->set_rules('uso', 'Nombre de uso', 'trim|required|callback__alpha_special|max_length[255]');

            if (!$this->form_validation->run()) {

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('usos/create', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar la nueva categoría en la BD
                $datos['uso'] = $this->input->post('uso');

                $table = 'usos';
                $was_inserted = $this->usos_model->create_uso($table, $datos);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_inserted){
                    $this->session->set_userdata('mensaje', 'El uso fue creado satisfactoriamente.');
                    redirect('usos/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el servicio
                $this->session->set_userdata('mensaje', 'No se pudo crear su uso.');
                redirect('usos/listar');
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

            $data['title'] = 'Lista de usos';

            $table = 'usos';
            $usos = $this->usos_model->get_usos($table);
            $data['usos'] = $usos;

            $this->parser->parse('templates/header', $data);
            $this->parser->parse('usos/show', $data);
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
            $data['title'] = 'Actualizar uso';

            $table = 'usos';

            $uso = $this->usos_model->get_uso($table, $id);
            $data = array_merge($data, $uso);

            $atributos_otro_uso = array(
                'class'       => 'checkbox',
            );

            $data['atributos_otro_uso'] = $atributos_otro_uso;

            $this->form_validation->set_rules('uso', 'Nombre del uso', 'trim|required|callback__alpha_special|max_length[255]');

            if (!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('usos/update', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                $uso['uso'] = $this->input->post('uso');
                $uso['otro_uso'] = ($this->input->post('otro_uso')) ? $this->input->post('otro_uso') : FALSE;

                //Si los datos tienen el formato correcto, debo registrar al servicio en la BD
                $was_updated = $this->usos_model->update_uso($table, $id, $uso);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_updated){
                    $this->session->set_userdata('mensaje', 'El uso fue actualizado satisfactoriamente.');
                    redirect('usos/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el servicio
                $this->session->set_userdata('mensaje', 'No se pudo actualizar su uso.');
                redirect('usos/listar');
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
            $table = 'usos';
            $delete_id = $this->usos_model->delete_uso($table, $id);
            if($delete_id){
                $this->session->set_userdata('mensaje', 'uso eliminado satisfactoriamente.');
                redirect('usos/listar');
            }else{
                $this->session->set_userdata('mensaje', 'No se pudo eliminar su uso.');
                redirect('usos/listar');
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