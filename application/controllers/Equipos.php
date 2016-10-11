<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 07:21 AM
 */

class Equipos extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->listar();
    }

    function crear(){

        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Nuevo equipo';

            $categorias_equipo = $this->categoria_model->get_categorias_habilitadas('categoria_equipo');
            if($categorias_equipo){
                $data['categorias_equipo'] = $categorias_equipo;
            }else{
                $this->session->set_flashdata('danger', 'No existen categor&iacute;as de equipo, o hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('equipos/listar');
            }

            $this->form_validation->set_rules('nombre_equipo', 'Nombre de equipo', 'trim|required|callback__alpha_special|max_length[255]');

            if(!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('equipos/create', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar la nueva categoría en la BD
                $datos['id_categoria_equipo'] = $this->input->post('id_categoria_equipo');
                $datos['nombre_equipo'] = $this->input->post('nombre_equipo');

                $was_inserted = $this->equipos_model->create_equipo('equipos', $datos);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_inserted){
                    $this->session->set_flashdata('success', 'El equipo fue a&ntilde;adido satisfactoriamente.');
                    redirect('equipos/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el equipo
                $this->session->set_flashdata('danger', 'No se pudo agregar el equipo, por favor intente nuevamente.');
                redirect('equipos/listar');
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

            $data['title'] = 'Equipos';

            $equipos = $this->equipos_model->get_equipos('equipos');
            if($equipos){
                $data['equipos'] = $equipos;

                $this->parser->parse('templates/header', $data);
                $this->parser->parse('equipos/show', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                $this->session->set_flashdata('danger', 'Hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('inicio');
            }
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

            //Tomo los datos del equipo de la BD, para poder pre-llenar el formulario
            $data['title'] = 'Actualizar Equipo';

            $categorias_equipo = $this->categoria_model->get_categorias_habilitadas('categoria_equipo');
            if($categorias_equipo){
                $data['categorias_equipo'] = array_column($categorias_equipo, 'categoria', 'id');

                $equipo = $this->equipos_model->get_equipo($id);
                if($equipo){
                    $data = array_merge($data, $equipo);
                    $data['categoria_equipo_selected'] = $equipo['id_categoria_equipo'];

                    $atributos_categoria_equipo = array('class' => 'form-control col-sm-2',);

                    $data['atributos_categoria_equipo'] = $atributos_categoria_equipo;
                }else{
                    $this->session->set_flashdata('danger', 'El equipo que intenta actualizar no existe o hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                    redirect('inicio');
                }
            }else{
                $this->session->set_flashdata('danger', 'Hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('inicio');
            }

            $this->form_validation->set_rules('nombre_equipo', 'Nombre equipo', 'trim|required|callback__alpha_special|max_length[255]');

            if(!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('equipos/update', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar el equipo en la BD
                $equipo = array();

                $equipo['nombre_equipo'] = $this->input->post('nombre_equipo');
                $equipo['id_categoria_equipo'] = $this->input->post('categoria_equipo');
                
                $was_updated = $this->equipos_model->update_equipo('equipos', $id, $equipo);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_updated){
                    $this->session->set_flashdata('success', 'El equipo fue modificado satisfactoriamente.');
                    redirect('equipos/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el equipo
                $this->session->set_flashdata('danger', 'No se pudo modificar el equipo, por favor intente nuevamente.');
                redirect('equipos/listar');
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

            $cantidad_solicitudes = $this->solicitudes_model->get_solicitudes_by_equipo($id);
            if($cantidad_solicitudes > 0){
                $this->session->set_flashdata('warning', 'Este equipo no puede ser eliminado, est&aacute; siendo utilizado por ' . $cantidad_solicitudes . ' solicitudes. Elimine las solicitudes primero, o deshabilite el equipo en lugar de eliminarlo.');
                redirect('equipos/listar');
            }else{
                $equipo = $this->equipos_model->get_equipo($id);
                if($equipo){
                    $delete_id = $this->equipos_model->delete_equipo('equipos', $id);
                    if($delete_id){
                        $this->session->set_flashdata('success', 'Equipo eliminado satisfactoriamente.');
                        redirect('equipos/listar');
                    }else{
                        $this->session->set_flashdata('danger', 'No se pudo eliminar su equipo, por favor intente nuevamente');
                        redirect('equipos/listar');
                    }
                }else{
                    $this->session->set_flashdata('warning', 'El equipo que intenta eliminar no existe.');
                    redirect('equipos/listar');
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

            $equipo = $this->equipos_model->get_equipo($id);
            if($equipo){
                if($equipo['habilitado']){
                    $datos['habilitado'] = FALSE;

                    $was_updated = $this->equipos_model->update_equipo('equipos', $id, $datos);
                    if($was_updated){
                        $this->session->set_flashdata('success', 'El equipo fue deshabilitado satisfactoriamente.');
                        redirect('equipos/listar');
                    }else{
                        $this->session->set_flashdata('danger', 'No se pudo deshabilitar el equipo, por favor intente nuevamente.');
                        redirect('equipos/listar');
                    }
                }else{
                    $this->session->set_flashdata('warning', 'El equipo ya se encuentra deshabilitado.');
                    redirect('equipos/listar');
                }
            }else{
                $this->session->set_flashdata('warning', 'El equipo que intenta deshabilitar no existe.');
                redirect('equipos/listar');
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

            $equipo = $this->equipos_model->get_equipo($id);
            if($equipo){
                if(!$equipo['habilitado']){
                    $datos['habilitado'] = TRUE;

                    $was_updated = $this->equipos_model->update_equipo('equipos', $id, $datos);
                    if($was_updated){
                        $this->categoria_model->update_categoria('categoria_equipo', $equipo['id_categoria_equipo'], $datos);

                        $this->session->set_flashdata('success', 'El equipo fue habilitado satisfactoriamente. Recuerde que al habilitar el equipo, tambi&eacute;n se habilita la categor&iacute;a a la que pertenece.');
                        redirect('equipos/listar');
                    }else{
                        $this->session->set_flashdata('danger', 'No se pudo habilitar el equipo, por favor intente nuevamente.');
                        redirect('equipos/listar');
                    }
                }else{
                    $this->session->set_flashdata('warning', 'El equipo ya se encuentra habilitado.');
                    redirect('equipos/listar');
                }
            }else{
                $this->session->set_flashdata('warning', 'El equipo que intenta habilitar no existe.');
                redirect('equipos/listar');
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