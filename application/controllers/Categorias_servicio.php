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
        $this->listar();
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

                $was_inserted = $this->categoria_model->create_categoria('categoria_servicio', $datos);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_inserted){
                    $this->session->set_userdata('mensaje', 'Categor&iacute;a de servicio creada satisfactoriamente.');
                    redirect('categorias-servicio/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el servicio
                $this->session->set_userdata('mensaje', 'No se pudo crear su categor&iacute;a de servicio. Por favor intente nuevamente.');
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

            $categorias = $this->categoria_model->get_categorias('categoria_servicio');

            if($categorias){
                $data['categorias'] = $categorias;

                $this->parser->parse('templates/header', $data);
                $this->parser->parse('categorias_servicio/show', $data);
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
            $data['title'] = 'Actualizar Categor&iacute;a de servicio';

            $categoria = $this->categoria_model->get_categoria('categoria_servicio', $id);

            if($categoria){
                $data['id'] = $categoria['id'];
                $data['categoria'] = $categoria['categoria'];
            }else{
                $this->session->set_userdata('mensaje', 'La categoría que intenta actualizar no existe, o hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('inicio');
            }

            $this->form_validation->set_rules('categoria_servicio', 'Categor&iacute;a de servicio', 'trim|required|callback__alpha_special|max_length[255]');

            if (!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('categorias_servicio/update', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                $categoria['categoria'] = $this->input->post('categoria_servicio');

                //Si los datos tienen el formato correcto, debo registrar al servicio en la BD
                $was_updated = $this->categoria_model->update_categoria('categoria_servicio', $id, $categoria);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_updated){
                    $this->session->set_userdata('mensaje', 'Categor&iacute;a de servicio actualizada satisfactoriamente.');
                    redirect('categorias-servicio/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el servicio
                $this->session->set_userdata('mensaje', 'No se pudo actualizar su categor&iacute;a de servicio. Por favor intente nuevamente.');
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

            $cantidad_servicios = $this->servicios_model->get_amount_servicios_by_categoria($id);
            if($cantidad_servicios > 0){
                $this->session->set_userdata('mensaje', 'Esta categor&iacute;a no puede ser eliminada, est&aacute; siendo utilizada por ' . $cantidad_servicios . ' servicios. Elimine los servicios primero, o deshabilite la categor&iacute;a en lugar de eliminarla.');
                redirect('categorias-servicio/listar');
            }else{
                $categoria_servicio = $this->categoria_model->get_categoria('categoria_servicio', $id);
                if($categoria_servicio){
                    $delete_id = $this->categoria_model->delete_categoria('categoria_servicio', $id);
                    if($delete_id){
                        $this->session->set_userdata('mensaje', 'Categor&iacute;a de servicio eliminada satisfactoriamente.');
                        redirect('categorias-servicio/listar');
                    }else{
                        $this->session->set_userdata('mensaje', 'No se pudo eliminar su categor&iacute;a de servicio, por favor intente nuevamente');
                        redirect('categorias-servicio/listar');
                    }
                }else{
                    $this->session->set_userdata('mensaje', 'La categor&iacute; de servicio que intenta eliminar no existe.');
                    redirect('categorias-servicio/listar');
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

            $categoria_servicio = $this->categoria_model->get_categoria('categoria_servicio', $id);
            if($categoria_servicio){
                if($categoria_servicio['habilitado']){
                    $datos['habilitado'] = FALSE;

                    $was_updated = $this->categoria_model->update_categoria('categoria_servicio', $id, $datos);
                    if($was_updated){
                        $servicios = $this->servicios_model->get_servicios_by_categoria($id);
                        foreach($servicios as $k => $servicio){
                            $this->servicios_model->update_servicio('servicios', $servicio['id'], $datos);
                        }

                        $this->session->set_userdata('mensaje', 'La categor&iacute;a de servicio fue deshabilitada satisfactoriamente. Recuerde que al deshabilitar una categor&iacute;a, tambi&eacute;n est&aacute; deshabilitando los servicios pertenencientes a la misma.');
                        redirect('categorias-servicio/listar');
                    }else{
                        $this->session->set_userdata('mensaje', 'No se pudo deshabilitar la categor&iacute; de servicio, por favor intente nuevamente.');
                        redirect('categorias-servicio/listar');
                    }
                }else{
                    $this->session->set_userdata('mensaje', 'La categor&iacute; de servicio ya se encuentra deshabilitada.');
                    redirect('categorias-servicio/listar');
                }
            }else{
                $this->session->set_userdata('mensaje', 'La categor&iacute; de servicio que intenta deshabilitar no existe.');
                redirect('categorias-servicio/listar');
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

            $categoria_servicio = $this->categoria_model->get_categoria('categoria_servicio', $id);
            if($categoria_servicio){
                if(!$categoria_servicio['habilitado']){
                    $datos['habilitado'] = TRUE;

                    $was_updated = $this->categoria_model->update_categoria('categoria_servicio', $id, $datos);
                    if($was_updated){
                        $servicios = $this->servicios_model->get_servicios_by_categoria($id);
                        foreach($servicios as $k => $servicio){
                            $this->servicios_model->update_servicio('servicios', $servicio['id'], $datos);
                        }

                        $this->session->set_userdata('mensaje', 'La categor&iacute;a de servicio fue abilitada satisfactoriamente. Recuerde que al habilitar una categor&iacute;a, tambi&eacute;n est&aacute; habilitando los servicios pertenencientes a la misma.');
                        redirect('categorias-servicio/listar');
                    }else{
                        $this->session->set_userdata('mensaje', 'No se pudo habilitar la categor&iacute; de servicio, por favor intente nuevamente.');
                        redirect('categorias-servicio/listar');
                    }
                }else{
                    $this->session->set_userdata('mensaje', 'La categor&iacute; de servicio ya se encuentra habilitada.');
                    redirect('categorias-servicio/listar');
                }
            }else{
                $this->session->set_userdata('mensaje', 'La categor&iacute; de servicio que intenta habilitar no existe.');
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