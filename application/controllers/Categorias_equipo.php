<?php defined('BASEPATH') OR exit('No direct script access allowed');
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
        $this->listar();
    }

    function crear(){

        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Crear categor&iacute;a';

            $this->form_validation->set_rules('categoria_equipo', 'Categor&iacute;a de equipo', 'trim|required|callback__alpha_special|max_length[255]');

            if(!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('categorias_equipo/create', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar la nueva categoría en la BD
                $datos['categoria'] = $this->input->post('categoria_equipo');

                $was_inserted = $this->categoria_model->create_categoria('categoria_equipo', $datos);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_inserted){
                    $this->session->set_flashdata('success', 'Categor&iacute;a de equipo creada satisfactoriamente.');
                    redirect('categorias-equipo/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el equipo
                $this->session->set_flashdata('danger', 'No se pudo crear su categor&iacute;a de equipo. Por favor intente nuevamente.');
                redirect('categorias-equipo/listar');
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

            $data['title'] = 'Categor&iacute;as de equipo disponibles';

            $categorias = $this->categoria_model->get_categorias('categoria_equipo');

            if($categorias){
                $data['categorias'] = $categorias;

                $this->parser->parse('templates/header', $data);
                $this->parser->parse('categorias_equipo/show', $data);
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
            $data['title'] = 'Actualizar Categor&iacute;a de equipo';

            $categoria = $this->categoria_model->get_categoria('categoria_equipo', $id);
            if($categoria){
                $data['id'] = $categoria['id'];
                $data['categoria'] = $categoria['categoria'];
            }else{
                $this->session->set_flashdata('danger', 'La categor&iacute;a que intenta actualizar no existe o hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('inicio');
            }

            $this->form_validation->set_rules('categoria_equipo', 'Categor&iacute;a de equipo', 'trim|required|callback__alpha_special|max_length[255]');

            if(!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('categorias_equipo/update', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                $categoria['categoria'] = $this->input->post('categoria_equipo');

                //Si los datos tienen el formato correcto, debo registrar al equipo en la BD
                $was_updated = $this->categoria_model->update_categoria('categoria_equipo', $id, $categoria);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_updated){
                    $this->session->set_flashdata('success', 'Categor&iacute;a de equipo actualizada satisfactoriamente.');
                    redirect('categorias-equipo/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el equipo
                $this->session->set_flashdata('danger', 'No se pudo actualizar su categor&iacute;a de equipo. Por favor intente nuevamente.');
                redirect('categorias-equipo/listar');
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

            $cantidad_equipos = $this->equipos_model->get_amount_equipos_by_categoria($id);
            if($cantidad_equipos > 0){
                $this->session->set_flashdata('warning', 'Esta categor&iacute;a no puede ser eliminada, est&aacute; siendo utilizada por ' . $cantidad_equipos . ' equipos. Elimine los equipos primero, o deshabilite la categor&iacute;a en lugar de eliminarla.');
                redirect('categorias-equipo/listar');
            }else{
                $categoria_equipo = $this->categoria_model->get_categoria('categoria_equipo', $id);
                if($categoria_equipo){
                    $delete_id = $this->categoria_model->delete_categoria('categoria_equipo', $id);
                    if($delete_id){
                        $this->session->set_flashdata('success', 'Categor&iacute;a de equipo eliminada satisfactoriamente.');
                        redirect('categorias-equipo/listar');
                    }else{
                        $this->session->set_flashdata('danger', 'No se pudo eliminar su categor&iacute;a de equipo, por favor intente nuevamente');
                        redirect('categorias-equipo/listar');
                    }
                }else{
                    $this->session->set_flashdata('danger', 'La categor&iacute;a de equipo que intenta eliminar no existe.');
                    redirect('categorias-equipo/listar');
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

            $categoria_equipo = $this->categoria_model->get_categoria('categoria_equipo', $id);
            if($categoria_equipo){
                if($categoria_equipo['habilitado']){
                    $datos['habilitado'] = FALSE;

                    $was_updated = $this->categoria_model->update_categoria('categoria_equipo', $id, $datos);
                    if($was_updated){
                        $equipos = $this->equipos_model->get_equipos_by_categoria($id);
                        foreach($equipos as $k => $equipo){
                            $this->equipos_model->update_equipo('equipos', $equipo['id'], $datos);
                        }

                        $this->session->set_flashdata('success', 'La categor&iacute;a de equipo fue deshabilitada satisfactoriamente. Recuerde que al deshabilitar una categor&iacute;a, tambi&eacute;n est&aacute; deshabilitando los equipos de la misma.');
                        redirect('categorias-equipo/listar');
                    }else{
                        $this->session->set_flashdata('danger', 'No se pudo deshabilitar la categor&iacute; de equipo, por favor intente nuevamente.');
                        redirect('categorias-equipo/listar');
                    }
                }else{
                    $this->session->set_flashdata('warning', 'La categor&iacute;a de equipo ya se encuentra deshabilitada.');
                    redirect('categorias-equipo/listar');
                }
            }else{
                $this->session->set_flashdata('warning', 'La categor&iacute;a de equipo que intenta deshabilitar no existe.');
                redirect('categorias-equipo/listar');
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

            $categoria_equipo = $this->categoria_model->get_categoria('categoria_equipo', $id);
            if($categoria_equipo){
                if(!$categoria_equipo['habilitado']){
                    $datos['habilitado'] = TRUE;

                    $was_updated = $this->categoria_model->update_categoria('categoria_equipo', $id, $datos);
                    if($was_updated){
                        $equipos = $this->equipos_model->get_equipos_by_categoria($id);
                        foreach($equipos as $k => $equipo){
                            $this->equipos_model->update_equipo('equipos', $equipo['id'], $datos);
                        }

                        $this->session->set_flashdata('success', 'La categor&iacute;a de equipo fue habilitada satisfactoriamente. Recuerde que al habilitar una categor&iacute;a, tambi&eacute;n est&aacute; habilitando los equipos pertenencientes a la misma.');
                        redirect('categorias-equipo/listar');
                    }else{
                        $this->session->set_flashdata('danger', 'No se pudo habilitar la categor&iacute; de equipo, por favor intente nuevamente.');
                        redirect('categorias-equipo/listar');
                    }
                }else{
                    $this->session->set_flashdata('warning', 'La categor&iacute; de equipo ya se encuentra habilitada.');
                    redirect('categorias-equipo/listar');
                }
            }else{
                $this->session->set_flashdata('warning', 'La categor&iacute; de equipo que intenta habilitar no existe.');
                redirect('categorias-equipo/listar');
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