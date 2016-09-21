<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 31/03/2016
 * Time: 07:45 AM
 */

class Usuarios extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->listar();
    }

    function registro(){

        $data['title'] = 'Registro';

        $categorias_usuario = $this->categoria_model->get_categorias('categoria_usuario');
        if($categorias_usuario){
            $data['categorias_usuario'] = $categorias_usuario;
        }else{
            $this->session->set_flashdata('mensaje', 'Hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
            redirect('inicio');
        }

        $this->form_validation->set_rules('primer_nombre', 'Primer nombre', 'trim|required|callback__alpha_space|max_length[255]');
        $this->form_validation->set_rules('segundo_nombre', 'Segundo nombre', 'trim|required|callback__alpha_space|max_length[255]');
        $this->form_validation->set_rules('primer_apellido', 'Primer apellido', 'trim|required|callback__alpha_space|max_length[255]');
        $this->form_validation->set_rules('segundo_apellido', 'Segundo apellido', 'trim|required|callback__alpha_space|max_length[255]');
        $this->form_validation->set_rules('cedula', 'C&eacute;dula', 'required|is_unique[usuarios.cedula]|is_natural_no_zero', array('is_unique' => 'Esa c&eacute;dula ya se encuentra registrada en el sistema.'));
        $this->form_validation->set_rules('email', 'Correo electr&oacute;nico', 'required|is_unique[usuarios.email]|valid_email', array('is_unique' => 'Ese correo electr&oacute;nico ya se encuentra registrado en el sistema.'));
        $this->form_validation->set_rules('telefono', 'Tel&eacute;fono', 'required|is_natural_no_zero|exact_length[7]');
        $this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required');
        $this->form_validation->set_rules('password_confirmation', 'Confirmar contrase&ntilde;a', 'required|matches[password]');

        $this->form_validation->set_rules('correo_institucional', 'Correo institucional', 'trim|is_unique[usuarios.correo_institucional]|valid_email', array('is_unique' => 'Ese correo electr&oacute;nico ya se encuentra registrado en el sistema.'));
        $this->form_validation->set_rules('twitter', 'Twitter', 'trim|max_length[15]|callback__valid_twitter_username');
        $this->form_validation->set_rules('facebook', 'Facebook', 'trim|min_length[5]|callback__valid_facebook_username');
        $this->form_validation->set_rules('instagram', 'Instagram', 'trim|max_length[30]|callback__valid_instagram_username');

        if(!$this->form_validation->run()){

            //Si el que intenta crear la cuenta es un Administrador, le doy opciones para crear nuevos administradores.
            $administrador = $this->session->administrador;
            $data['administrador'] = $administrador;

            //Si no pasa las reglas de validación, mostramos el formulario
            $this->parser->parse('templates/header', $data);
            $this->parser->parse('usuarios/register', $data);
            $this->parser->parse('templates/footer', $data);
        }else{
            //Si los datos tienen el formato correcto, debo registrar al usuario en la BD
            $usuario = array();

            $usuario['primer_nombre'] = $this->input->post('primer_nombre');
            $usuario['segundo_nombre'] = $this->input->post('segundo_nombre');
            $usuario['primer_apellido'] = $this->input->post('primer_apellido');
            $usuario['segundo_apellido'] = $this->input->post('segundo_apellido');
            $usuario['cedula'] = $this->input->post('cedula');
            $usuario['email'] = $this->input->post('email');
            $usuario['id_categoria_usuario'] = $this->input->post('id_categoria_usuario');

            $codigo_area = $this->input->post('codigo_area');
            $telefono = $this->input->post('telefono');
            $usuario['telefono'] = $codigo_area . '-' . $telefono;

            $usuario['correo_institucional'] = $this->input->post('correo_institucional');
            $usuario['twitter'] = $this->input->post('twitter');
            $usuario['facebook'] = $this->input->post('facebook');
            $usuario['instagram'] = $this->input->post('instagram');

            $raw_password = $this->input->post('password');
            $password = $this->bcrypt->hash_password($raw_password);
            $usuario['hashed_password'] = $password;
            $usuario['administrador'] = ($this->input->post('administrador')) ? $this->input->post('administrador') : FALSE;

            $was_inserted = $this->usuarios_model->create_user($usuario);

            //Si lo guardó correctamente, redirigir al inicio con éxito
            if($was_inserted){
                $this->session->set_flashdata('mensaje', 'El usuario fue creado satisfactoriamente.');
                redirect('inicio');
            }

            //Si llegué a este punto es porque no pudo guardar el usuario
            $this->session->set_flashdata('mensaje', 'No se pudo crear el usuario, por favor intente de nuevo.');
            redirect('inicio');
        }
    }

    public function listar(){

        //Lo primero es ver si es Administrador, no?
        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Lista de Usuarios';

            $usuarios = $this->usuarios_model->get_usuarios();
            if($usuarios){
                $data['usuarios'] = $usuarios;

                $this->parser->parse('templates/header', $data);
                $this->parser->parse('usuarios/show', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                $this->session->set_flashdata('mensaje', 'Hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('inicio');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_flashdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function detalles($cedula){

        //Lo primero es ver si es Administrador, o si el que intenta ver los detalles es el mismo usuario
        $cedula_sesion = $this->session->cedula;
        $administrador = $this->session->administrador;
        if($administrador || ($cedula === $cedula_sesion)){
            $data['title'] = 'Detalles del Usuario';

            $usuario = $this->usuarios_model->get_usuario($cedula);
            if($usuario){

                $categoria = $this->categoria_model->get_categoria('categoria_usuario', $usuario['id_categoria_usuario']);
                if($categoria){
                    $data['tipo_usuario'] = ($usuario['administrador']) ? 'Administrador' : 'Regular';
                    $data['categoria'] = $categoria['categoria'];
                    $data = array_merge($data, $usuario);

                    $this->parser->parse('templates/header', $data);
                    $this->parser->parse('usuarios/details', $data);
                    $this->parser->parse('templates/footer', $data);
                }else{
                    $this->session->set_flashdata('mensaje', 'Hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                    redirect('inicio');
                }
            }else{
                $this->session->set_flashdata('mensaje', 'El usuario que intenta visualizar no existe, o hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('inicio');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_flashdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function actualizar($id){

        //Lo primero es ver si es Administrador, o si el que intenta actualizar es el mismo usuario
        $id_sesion = $this->session->id;
        $administrador = $this->session->administrador;
        if($administrador || ($id === $id_sesion)){

            //Tomo los datos del usuario de la BD, para poder pre-llenar el formulario
            $data['title'] = 'Actualizar Usuario';

            $usuario = $this->usuarios_model->get_usuario_by_id($id);
            if($usuario){
                $categorias_usuario = $this->categoria_model->get_categorias('categoria_usuario');
                if($categorias_usuario){
                    $data['categorias_usuario'] = array_column($categorias_usuario, 'categoria', 'id');

                    $data['categoria_usuario_selected'] = $usuario['id_categoria_usuario'];

                    $data = array_merge($data, $usuario);
                    $data['codigo_area_selected'] = substr($data['telefono'], 0, 4);
                    $data['telefono'] = substr($data['telefono'], -7);

                    $codigo_area = array(
                        '0212'  => '0212',
                        '0412'  => '0412',
                        '0414'  => '0414',
                        '0416'  => '0416',
                        '0424'  => '0424',
                        '0426'  => '0426',
                    );

                    $atributos_codigo_area = array(
                        'class'       => 'form-control col-sm-2',
                    );

                    $atributos_categorias_usuario = array(
                        'class'       => 'form-control col-sm-10',
                    );

                    $atributos_administrador = array(
                        'class'       => 'checkbox',
                    );

                    $data['codigo_area'] = $codigo_area;
                    $data['atributos_codigo_area'] = $atributos_codigo_area;
                    $data['atributos_categorias_usuario'] = $atributos_categorias_usuario;
                    $data['administrador_actualizar'] = $usuario['administrador'];
                    $data['atributos_administrador'] = $atributos_administrador;
                }else{
                    $this->session->set_flashdata('mensaje', 'Hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                    redirect('inicio');
                }
            }else{
                $this->session->set_flashdata('mensaje', 'El usuario que intenta actualizar no existe o hubo un problema al conectarse con la Base de Datos. Por favor intente nuevamente.');
                redirect('inicio');
            }

            $this->form_validation->set_rules('primer_nombre', 'Primer nombre', 'trim|required|callback__alpha_space|max_length[255]');
            $this->form_validation->set_rules('segundo_nombre', 'Segundo nombre', 'trim|required|callback__alpha_space|max_length[255]');
            $this->form_validation->set_rules('primer_apellido', 'Primer apellido', 'trim|required|callback__alpha_space|max_length[255]');
            $this->form_validation->set_rules('segundo_apellido', 'Segundo apellido', 'trim|required|callback__alpha_space|max_length[255]');
            $this->form_validation->set_rules('cedula', 'C&eacute;dula', 'required|callback__unique_cedula|is_natural_no_zero');
            $this->form_validation->set_rules('email', 'Correo electr&oacute;nico', 'required|callback__unique_email|valid_email');
            $this->form_validation->set_rules('telefono', 'Tel&eacute;fono', 'required|is_natural_no_zero|exact_length[7]');
            $this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required');
            $this->form_validation->set_rules('password_confirmation', 'Confirmar contrase&ntilde;a', 'required|matches[password]');

            if (!$this->form_validation->run()){

                //Si el que intenta actualizar la cuenta es un Administrador, le doy opciones para cambiar el tipo a Administrador.
                $data['administrador'] = $administrador;

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('usuarios/update', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar al usuario en la BD
                $usuario = array();

                $usuario['primer_nombre'] = $this->input->post('primer_nombre');
                $usuario['segundo_nombre'] = $this->input->post('segundo_nombre');
                $usuario['primer_apellido'] = $this->input->post('primer_apellido');
                $usuario['segundo_apellido'] = $this->input->post('segundo_apellido');
                $usuario['cedula'] = $this->input->post('cedula');
                $usuario['email'] = $this->input->post('email');
                $usuario['id_categoria_usuario'] = $this->input->post('id_categoria_usuario');

                $codigo_area = $this->input->post('codigo_area');
                $telefono = $this->input->post('telefono');
                $usuario['telefono'] = $codigo_area . '-' . $telefono;

                $raw_password = $this->input->post('password');
                $password = $this->bcrypt->hash_password($raw_password);
                $usuario['hashed_password'] = $password;
                $usuario['administrador'] = ($this->input->post('administrador')) ? $this->input->post('administrador') : FALSE;

                $usuario['correo_institucional'] = $this->input->post('correo_institucional');
                $usuario['twitter'] = $this->input->post('twitter');
                $usuario['facebook'] = $this->input->post('facebook');
                $usuario['instagram'] = $this->input->post('instagram');

                $was_updated = $this->usuarios_model->update_user($id, $usuario);
                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_updated){
                    $this->session->set_flashdata('mensaje', 'El usuario fue actualizado satisfactoriamente.');
                    redirect('usuarios/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el usuario
                $this->session->set_flashdata('mensaje', 'No se pudo actualizar el usuario, por favor intente de nuevo.');
                redirect('usuarios/detalles/' . $usuario['cedula']);
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_flashdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function eliminar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){
            
            $solicitudes = $this->solicitudes_model->get_solicitudes_by_usuario('solicitudes', $id);
            $cantidad_solicitudes = count($solicitudes);
            if($cantidad_solicitudes > 0){
                $this->session->set_flashdata('mensaje', 'Este usuario no puede ser eliminado, posee ' . $cantidad_solicitudes . ' solicitudes. Elimine las solicitudes primero, o deshabilite el usuario en lugar de eliminarlo.');
                redirect('usuarios/listar');
            }else{
                $usuario = $this->usuarios_model->get_usuario_by_id($id);
                if($usuario){
                    $delete_id = $this->usuarios_model->delete_user($id);
                    if($delete_id){
                        $this->session->set_flashdata('mensaje', 'Usuario eliminado satisfactoriamente.');
                        redirect('usuarios/listar');
                    }else{
                        $this->session->set_flashdata('mensaje', 'No se pudo eliminar su usuario, por favor intente nuevamente');
                        redirect('usuarios/listar');
                    }
                }else{
                    $this->session->set_flashdata('mensaje', 'El usuario que intenta eliminar no existe.');
                    redirect('usuarios/listar');
                }
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_flashdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function deshabilitar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){

            $usuario = $this->usuarios_model->get_usuario_by_id($id);
            if($usuario){
                if($usuario['habilitado']){
                    $datos['habilitado'] = FALSE;

                    $was_updated = $this->usuarios_model->update_user($id, $datos);

                    $solicitudes = $this->solicitudes_model->get_solicitudes_by_usuario('solicitudes', $usuario['id']);
                    foreach($solicitudes as $k => $solicitud){
                        $this->solicitudes_model->update_solicitud('solicitudes', $solicitud['id'], $datos);
                    }

                    if($was_updated){
                        $this->session->set_flashdata('mensaje', 'El usuario fue deshabilitado satisfactoriamente. Recuerde que al deshabilitar un usuario, tambi&eacute;n est&aacute; deshabilitando sus solicitudes.');
                        redirect('usuarios/listar');
                    }else{
                        $this->session->set_flashdata('mensaje', 'No se pudo deshabilitar el usuario, por favor intente nuevamente.');
                        redirect('usuarios/listar');
                    }
                }else{
                    $this->session->set_flashdata('mensaje', 'El usuario ya se encuentra deshabilitado.');
                    redirect('usuarios/listar');
                }
            }else{
                $this->session->set_flashdata('mensaje', 'El usuario que intenta deshabilitar no existe.');
                redirect('usuarios/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_flashdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function habilitar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){

            $usuario = $this->usuarios_model->get_usuario_by_id($id);
            if($usuario){
                if(!$usuario['habilitado']){
                    $datos['habilitado'] = TRUE;

                    $was_updated = $this->usuarios_model->update_user($id, $datos);

                    $solicitudes = $this->solicitudes_model->get_solicitudes_by_usuario('solicitudes', $usuario['id']);
                    foreach($solicitudes as $k => $solicitud){
                        $this->solicitudes_model->update_solicitud('solicitudes', $solicitud['id'], $datos);
                    }

                    $this->categoria_model->update_categoria('categoria_usuario', $usuario['id_categoria_usuario'], $datos);

                    if($was_updated){
                        $this->session->set_flashdata('mensaje', 'El usuario fue habilitado satisfactoriamente. Recuerde que al habilitar un usuario, tambi&eacute;n est&aacute; habilitando sus solicitudes.');
                        redirect('usuarios/listar');
                    }else{
                        $this->session->set_flashdata('mensaje', 'No se pudo habilitar el usuario, por favor intente nuevamente.');
                        redirect('usuarios/listar');
                    }
                }else{
                    $this->session->set_flashdata('mensaje', 'El usuario ya se encuentra habilitado.');
                    redirect('usuarios/listar');
                }
            }else{
                $this->session->set_flashdata('mensaje', 'El usuario que intenta habilitar no existe.');
                redirect('usuarios/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_flashdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function _alpha_space($str){
        $this->form_validation->set_message('_alpha_space', 'El campo {field} puede contener &uacute;nicamente letras y espacios.');
        //To my future self: ^ es el inicio, $ el fin, \p{L} son las letras y el modificador u trata el string como UTF-8
        return (preg_match('/^[\p{L} ]*$/u', $str))? true: false;
    }

    public function _valid_twitter_username($str){
        $this->form_validation->set_message('_valid_twitter_username', 'El campo {field} no contiene un usuario de Twitter v&aacute;lido.');
        return (preg_match('/^[a-zA-Z0-9_]*$/', $str))? true: false;
    }

    public function _valid_facebook_username($str){
        $this->form_validation->set_message('_valid_facebook_username', 'El campo {field} no contiene un usuario de Facebook v&aacute;lido.');
        return (preg_match('/^[a-zA-Z0-9\.]*$/', $str))? true: false;
    }

    public function _valid_instagram_username($str){
        $this->form_validation->set_message('_valid_instagram_username', 'El campo {field} no contiene un usuario de Instagram v&aacute;lido.');
        return (preg_match('/^[a-zA-Z0-9\._]*$/', $str))? true: false;
    }

    public function _unique_email($email){
        $this->form_validation->set_message('_unique_email', 'Ese correo electr&oacute;nico ya se encuentra registrado en el sistema.');
        $usuario = $this->usuarios_model->get_usuario_by_email($email);
        $id_actualizar = $this->uri->segment(3, 0);
        return !($usuario && ($id_actualizar != $usuario['id']));
    }

    public function _unique_cedula($cedula){
        $this->form_validation->set_message('_unique_cedula', 'Esa c&eacute;dula ya se encuentra registrada en el sistema.');
        $id_actualizar = $this->uri->segment(3, 0);
        $usuario_nueva_cedula = $this->usuarios_model->get_usuario($cedula);
        //To my future self: si ya hay un usuario con la cédula "nueva" (que tomé del input), y la cédula es distinta a
        //la que antes tenía, entonces no puedo actualizar ese campo porque ya alguien la tiene registrada.
        return !($usuario_nueva_cedula && ($id_actualizar != $usuario_nueva_cedula['id']));
    }
}