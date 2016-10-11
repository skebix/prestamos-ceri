<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 14/04/2016
 * Time: 03:21 PM
 */

class Servicios extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->listar();
    }

    function crear(){

        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Nuevo servicio';

            $categorias_servicio = $this->categoria_model->get_categorias_habilitadas('categoria_servicio');
            if($categorias_servicio){
                $data['categorias_servicio'] = $categorias_servicio;
            }else {
                $this->session->set_flashdata('danger', 'No existen categor&iacute;as de servicio, o hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('servicios/listar');
            }

            $this->form_validation->set_rules('nombre_servicio', 'Categor&iacute;a de servicio', 'trim|required|callback__alpha_special|max_length[255]');

            if(!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('servicios/create', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar la nueva categoría en la BD
                $datos['id_categoria_servicio'] = $this->input->post('id_categoria_servicio');
                $datos['nombre_servicio'] = $this->input->post('nombre_servicio');

                $was_inserted = $this->servicios_model->create_servicio('servicios', $datos);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_inserted){
                    $this->session->set_flashdata('success', 'El servicio fue a&ntilde;adido satisfactoriamente.');
                    redirect('servicios/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el servicio
                $this->session->set_flashdata('danger', 'No se pudo agregar el servicio, por favor intente nuevamente.');
                redirect('servicios/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_flashdata('warning', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function listar(){

        //Lo primero es ver si es Administrador, no?
        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Servicios';

            $servicios = $this->servicios_model->get_servicios('servicios');

            $data['servicios'] = $servicios;

            $this->parser->parse('templates/header', $data);
            $this->parser->parse('servicios/show', $data);
            $this->parser->parse('templates/footer', $data);
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_flashdata('warning', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function actualizar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){

            //Tomo los datos del servicio de la BD, para poder pre-llenar el formulario
            $data['title'] = 'Actualizar servicio';

            $categorias_servicio = $this->categoria_model->get_categorias('categoria_servicio');
            if($categorias_servicio){
                $data['categorias_servicio'] = array_column($categorias_servicio, 'categoria', 'id');

                $servicio = $this->servicios_model->get_servicio($id);
                if($servicio){
                    $data = array_merge($data, $servicio);
                    $data['categoria_servicio_selected'] = $servicio['id_categoria_servicio'];

                    $atributos_categoria_servicio = array('class' => 'form-control col-sm-2',);

                    $data['atributos_categoria_servicio'] = $atributos_categoria_servicio;
                }else{
                    $this->session->set_flashdata('danger', 'El servicio que intenta actualizar no existe o hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                    redirect('inicio');
                }
            }else{
                $this->session->set_flashdata('danger', 'Hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('inicio');
            }

            $this->form_validation->set_rules('nombre_servicio', 'Nombre servicio', 'trim|required|callback__alpha_special|max_length[255]');

            if (!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('servicios/update', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar el servicio en la BD
                $servicio = array();

                $servicio['nombre_servicio'] = $this->input->post('nombre_servicio');
                $servicio['id_categoria_servicio'] = $this->input->post('categoria_servicio');
                
                $was_updated = $this->servicios_model->update_servicio('servicios', $id, $servicio);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_updated){
                    $this->session->set_flashdata('success', 'El servicio fue modificado satisfactoriamente.');
                    redirect('servicios/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el servicio
                $this->session->set_flashdata('danger', 'No se pudo modificar el servicio, por favor intente nuevamente.');
                redirect('servicios/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_flashdata('warning', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function eliminar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){

            $cantidad_solicitudes = $this->solicitudes_model->get_solicitudes_by_servicio($id);
            if($cantidad_solicitudes > 0){
                $this->session->set_flashdata('warning', 'Este servicio no puede ser eliminado, est&aacute; siendo utilizado por ' . $cantidad_solicitudes . ' solicitudes. Elimine las solicitudes primero, o deshabilite el servicio en lugar de eliminarlo.');
                redirect('servicios/listar');
            }else{
                $servicio = $this->servicios_model->get_servicio($id);
                if($servicio){
                    $delete_id = $this->servicios_model->delete_servicio('servicios', $id);
                    if($delete_id){
                        $this->session->set_flashdata('success', 'El servicio fue eliminado satisfactoriamente.');
                        redirect('servicios/listar');
                    }else{
                        $this->session->set_flashdata('danger', 'No se pudo eliminar su servicio, por favor intente nuevamente');
                        redirect('servicios/listar');
                    }
                }else{
                    $this->session->set_flashdata('warning', 'El servicio que intenta eliminar no existe.');
                    redirect('servicios/listar');
                }
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_flashdata('warning', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function deshabilitar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){

            $servicio = $this->servicios_model->get_servicio($id);
            if($servicio){
                if($servicio['habilitado']){
                    $datos['habilitado'] = FALSE;

                    $was_updated = $this->servicios_model->update_servicio('servicios', $id, $datos);
                    if($was_updated){
                        $this->session->set_flashdata('success', 'El servicio fue deshabilitado satisfactoriamente.');
                        redirect('servicios/listar');
                    }else{
                        $this->session->set_flashdata('danger', 'No se pudo deshabilitar el servicio, por favor intente nuevamente.');
                        redirect('servicios/listar');
                    }
                }else{
                    $this->session->set_flashdata('warning', 'El servicio ya se encuentra deshabilitado.');
                    redirect('servicios/listar');
                }
            }else{
                $this->session->set_flashdata('warning', 'El servicio que intenta deshabilitar no existe.');
                redirect('servicios/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_flashdata('warning', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function habilitar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){

            $servicio = $this->servicios_model->get_servicio($id);
            if($servicio){
                if(!$servicio['habilitado']){
                    $datos['habilitado'] = TRUE;

                    $was_updated = $this->servicios_model->update_servicio('servicios', $id, $datos);
                    if($was_updated){
                        $this->categoria_model->update_categoria('categoria_servicio', $servicio['id_categoria_servicio'], $datos);

                        $this->session->set_flashdata('success', 'El servicio fue habilitado satisfactoriamente. Recuerde que al habilitar el servicio, tambi&eacute;n se habilita la categor&iacute;a a la que pertenece.');
                        redirect('servicios/listar');
                    }else{
                        $this->session->set_flashdata('danger', 'No se pudo habilitar el servicio, por favor intente nuevamente.');
                        redirect('servicios/listar');
                    }
                }else{
                    $this->session->set_flashdata('warning', 'El servicio ya se encuentra habilitado.');
                    redirect('servicios/listar');
                }
            }else{
                $this->session->set_flashdata('warning', 'El servicio que intenta habilitar no existe.');
                redirect('servicios/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_flashdata('warning', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function _alpha_special($str){
        $this->form_validation->set_message('_alpha_special', 'El campo {field} puede contener &uacute;nicamente letras, números y los caracteres ().');
        //To my future self: ^ es el inicio, $ el fin, \p{L} son las letras y el modificador u trata el string como UTF-8
        return (preg_match('/^[\p{L}0-9 ()]*$/u', $str))? true: false;
    }
}