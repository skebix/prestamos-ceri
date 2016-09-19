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
        $this->listar();
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

                $was_inserted = $this->espacios_model->create_espacio('espacios', $datos);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_inserted){
                    $this->session->set_userdata('mensaje', 'El espacio fue creado satisfactoriamente.');
                    redirect('espacios/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el servicio
                $this->session->set_userdata('mensaje', 'No se pudo crear su espacio, por favor intente nuevamnte.');
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

            $espacios = $this->espacios_model->get_espacios('espacios');
            if($espacios){
                $data['espacios'] = $espacios;

                $this->parser->parse('templates/header', $data);
                $this->parser->parse('espacios/show', $data);
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

            //Tomo los datos del servicio de la BD, para poder pre-llenar el formulario
            $data['title'] = 'Actualizar Espacio';

            $espacio = $this->espacios_model->get_espacio('espacios', $id);
            if($espacio){
                $data = array_merge($data, $espacio);

                $atributos_otro_espacio = array(
                    'class'       => 'checkbox',
                );

                $data['atributos_otro_espacio'] = $atributos_otro_espacio;
            }else{
                $this->session->set_userdata('mensaje', 'El espacio que intenta actualizar no existe o hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('inicio');
            }

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
                $was_updated = $this->espacios_model->update_espacio('espacios', $id, $espacio);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_updated){
                    $this->session->set_userdata('mensaje', 'El espacio fue actualizado satisfactoriamente.');
                    redirect('espacios/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el servicio
                $this->session->set_userdata('mensaje', 'No se pudo actualizar su espacio, por favor intente nuevamente.');
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

            $cantidad_solicitudes = $this->solicitudes_model->get_solicitudes_by_espacio($id);
            if($cantidad_solicitudes > 0){
                $this->session->set_userdata('mensaje', 'Este espacio no puede ser eliminado, est&aacute; siendo utilizado por ' . $cantidad_solicitudes . ' solicitudes. Elimine las solicitudes primero, o deshabilite el espacio en lugar de eliminarlo.');
                redirect('espacios/listar');
            }else{
                $delete_id = $this->espacios_model->delete_espacio('espacios', $id);
                if($delete_id){
                    $this->session->set_userdata('mensaje', 'espacio eliminado satisfactoriamente.');
                    redirect('espacios/listar');
                }else{
                    $this->session->set_userdata('mensaje', 'No se pudo eliminar su espacio, por favor intente nuevamente');
                    redirect('espacios/listar');
                }
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function deshabilitar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){

            $espacio = $this->espacios_model->get_espacio('espacios', $id);
            if($espacio){
                if($espacio['habilitado']){
                    $datos['habilitado'] = FALSE;

                    $was_updated = $this->espacios_model->update_espacio('espacios', $id, $datos);
                    if($was_updated){
                        $this->session->set_userdata('mensaje', 'El espacio fue deshabilitado satisfactoriamente.');
                        redirect('espacios/listar');
                    }else{
                        $this->session->set_userdata('mensaje', 'No se pudo deshabilitar el espacio, por favor intente nuevamente.');
                        redirect('espacios/listar');
                    }
                }else{
                    $this->session->set_userdata('mensaje', 'El espacio ya se encuentra deshabilitado.');
                    redirect('espacios/listar');
                }
            }else{
                $this->session->set_userdata('mensaje', 'El espacio que intenta deshabilitar no existe.');
                redirect('espacios/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function habilitar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){

            $espacio = $this->espacios_model->get_espacio('espacios', $id);
            if($espacio){
                if(!$espacio['habilitado']){
                    $datos['habilitado'] = TRUE;

                    $was_updated = $this->espacios_model->update_espacio('espacios', $id, $datos);
                    if($was_updated){
                        $this->session->set_userdata('mensaje', 'El espacio fue habilitado satisfactoriamente.');
                        redirect('espacios/listar');
                    }else{
                        $this->session->set_userdata('mensaje', 'No se pudo habilitar el espacio, por favor intente nuevamente.');
                        redirect('espacios/listar');
                    }
                }else{
                    $this->session->set_userdata('mensaje', 'El espacio ya se encuentra habilitado.');
                    redirect('espacios/listar');
                }
            }else{
                $this->session->set_userdata('mensaje', 'El espacio que intenta habilitar no existe.');
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