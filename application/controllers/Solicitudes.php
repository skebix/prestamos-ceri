<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 19/04/16
 * Time: 10:54 PM
 */

class Solicitudes extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        echo "Fase de pruebas de solicitudes: crear / actualizar/ borrar";
    }

    public function crear(){

        $administrador = $this->session->administrador;
        if($administrador){

            $usuarios = $this->usuarios_model->get_usuarios();

            $data['title'] = 'Nueva solicitud';
            $data['usuarios'] = $usuarios;

            $select_nuevo_espacio = $this->input->post('select_nuevo_espacio');
            $select_usos_espacio = $this->input->post('select_usos_espacio');

            $select_nuevo_equipo = $this->input->post('select_nuevo_equipo');
            $select_nuevo_servicio = $this->input->post('select_nuevo_servicio');

            $input_nuevo_espacio = $this->input->post('input_nuevo_espacio');
            $input_otro_uso = $this->input->post('input_otro_uso');

            if($this->input->post()){
                $data = array_merge($this->input->post(), $data);
            }

            $otro_espacio = $this->espacios_model->get_espacio_by_name('espacios', 'Otro (especifique)');
            $otro_uso = $this->usos_model->get_uso_by_name('usos', 'Otro (especifique)');

            $indices_espacios = array();
            if(isset($select_nuevo_espacio)){
                foreach($select_nuevo_espacio as $k => $v){
                    if($v == $otro_espacio['id']){
                        $indices_espacios[] = $k;
                    }
                }
            }

            $viejos_espacios = $input_nuevo_espacio;
            if(isset($viejos_espacios)){
                foreach($viejos_espacios as $k => $v){
                    $data['input_nuevo_espacio_' . $indices_espacios[$k]] = $v;
                    $this->form_validation->set_rules('input_nuevo_espacio[' . $indices_espacios[$k] . ']', 'nombre nuevo espacio', 'required');
                }
            }

            $indices_usos = array();
            if(isset($select_usos_espacio)){
                foreach($select_usos_espacio as $k => $v){
                    if($v == $otro_uso['id']){
                        $indices_usos[] = $k;
                    }
                }
            }

            $viejos_usos = $input_otro_uso;
            if(isset($viejos_usos)){
                foreach($viejos_usos as $k => $v){
                    $data['input_otro_uso_' . $indices_usos[$k]] = $v;
                    $this->form_validation->set_rules('input_otro_uso[' . $indices_usos[$k] . ']', 'uso del espacio', 'required');
                }
            }

            $this->form_validation->set_rules('fecha_uso', 'Fecha de uso', 'required');
            $this->form_validation->set_rules('hora_entrega', 'Hora de entrega', 'required');
            $this->form_validation->set_rules('hora_devolucion', 'Hora de devoluci&oacute;n', 'required');

            $fecha_uso = $this->input->post('fecha_uso');
            $hora_entrega = $this->input->post('hora_entrega');
            $hora_devolucion = $this->input->post('hora_devolucion');

            if(!empty($fecha_uso) && !empty($hora_entrega) && !empty($hora_devolucion)){
                if(!empty($select_nuevo_equipo)){
                    foreach($select_nuevo_equipo as $k => $v){
                        $this->form_validation->set_rules('select_nuevo_equipo[' . $k . ']', 'Equipo', 'callback__equipo_ya_reservado');
                    }
                }

                if(!empty($select_nuevo_espacio)){
                    foreach($select_nuevo_espacio as $k => $v){
                        if($v != $otro_espacio['id']){
                            $this->form_validation->set_rules('select_nuevo_espacio[' . $k . ']', 'Espacio', 'callback__espacio_ya_reservado');
                        }
                    }
                }

                if(!empty($select_nuevo_servicio)){
                    foreach($select_nuevo_espacio as $k => $v){
                        $this->form_validation->set_rules('input_nuevo_servicio[' . $k . ']', 'descripci&oacute;n del servicio', 'required');
                    }
                }
            }

            if(!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('solicitudes/create', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar la nueva solicitud en la BD
                $datos['id_reservado'] = $this->session->id;
                $datos['id_solicitante'] = $this->input->post('id_solicitante');
                $datos['fecha_solicitud'] = date('Y-m-d');

                $fecha_uso = DateTime::createFromFormat('d/m/Y', $fecha_uso);
                $datos['fecha_uso'] = $fecha_uso->format('Y-m-d');

                $hora_entrega = DateTime::createFromFormat('h:i A', $hora_entrega);
                $datos['hora_entrega'] = $hora_entrega->format('H:i:s');

                $hora_devolucion = DateTime::createFromFormat('h:i A', $hora_devolucion);
                $datos['hora_devolucion'] = $hora_devolucion->format('H:i:s');

                $table = 'solicitudes';
                $id_solicitud = $this->solicitudes_model->create_solicitud($table, $datos);

                if($id_solicitud){

                    if(isset($select_nuevo_equipo)){
                        foreach($select_nuevo_equipo as $k => $v){
                            $datos = array();
                            $datos['id_equipo'] = $v;
                            $datos['id_solicitud'] = $id_solicitud;
                            $insert_id = $this->solicitudes_model->insert_auxiliares('solicitudes_equipos', $datos);
                        }
                    }

                    if(isset($select_nuevo_espacio)){
                        foreach($select_nuevo_espacio as $k => $v){
                            $datos = array();
                            if($v == $otro_espacio['id']){
                                $datos['nombre_espacio'] = $data['input_nuevo_espacio_' . $k];
                                $datos['otro_espacio'] = TRUE;
                                $id_espacio = $this->espacios_model->create_espacio('espacios', $datos);
                            }else{
                                $id_espacio = $v;
                            }

                            if($select_usos_espacio[$k] == $otro_uso['id']){
                                $datos = array();
                                $datos['uso'] = $data['input_otro_uso_' . $k];
                                $datos['otro_uso'] = TRUE;
                                $id_uso = $this->usos_model->create_uso('usos', $datos);
                            }else{
                                $id_uso = $select_usos_espacio[$k];
                            }

                            $datos = array();
                            $datos['id_solicitud'] = $id_solicitud;
                            $datos['id_espacio'] = $id_espacio;
                            $datos['id_uso'] = $id_uso;
                            $insert_id = $this->solicitudes_model->insert_auxiliares('solicitudes_espacios_usos', $datos);
                        }
                    }

                    if(isset($select_nuevo_servicio)){
                        foreach($select_nuevo_servicio as $k => $v){
                            $datos = array();
                            $datos['nombre_servicio'] = $data['input_nuevo_servicio'][$k];
                            $datos['id_categoria_servicio'] = $v;
                            $id_servicio = $this->servicios_model->create_servicio('servicios', $datos);

                            $datos = array();
                            $datos['id_servicio'] = $id_servicio;
                            $datos['id_solicitud'] = $id_solicitud;
                            $insert_id = $this->solicitudes_model->insert_auxiliares('solicitudes_servicios', $datos);
                        }
                    }

                    $this->session->set_userdata('mensaje', 'La solicitud fue creada satisfactoriamente.');
                    redirect('solicitudes/detalles/' . $id_solicitud);
                }

                //Si llegué a este punto es porque no pudo guardar la solicitud
                $this->session->set_userdata('mensaje', 'No se pudo crear la solicitud, por favor intente nuevamente.');
                redirect('solicitudes/listar');
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
            $data['title'] = 'Actualizar Solicitud';
            $data['id_solicitud'] = $id;

            $solicitud = $this->solicitudes_model->get_solicitud($id);

            if(isset($solicitud)){
                $equipos = $this->solicitudes_model->get_equipos_by_solicitud('solicitudes_equipos', $id);
                $espacios = $this->solicitudes_model->get_espacios_by_solicitud('solicitudes_espacios_usos', $id);
                $servicios = $this->solicitudes_model->get_servicios_by_solicitud('solicitudes_servicios', $id);

                $usuarios = $this->usuarios_model->get_usuarios();

                $otro_espacio = $this->espacios_model->get_espacio_by_name('espacios', 'Otro (especifique)');
                $otro_uso = $this->usos_model->get_uso_by_name('usos', 'Otro (especifique)');
                $otro_servicio = $this->servicios_model->get_servicio_by_name('servicios', 'Otro (especifique)');

                $data['usuarios'] = $usuarios;

                if($this->input->post()){
                    $data = array_merge($this->input->post(), $data);

                    $fecha_uso = $this->input->post('fecha_uso');
                    $hora_entrega = $this->input->post('hora_entrega');
                    $hora_devolucion = $this->input->post('hora_devolucion');

                    $select_nuevo_equipo = $this->input->post('select_nuevo_equipo');
                    $select_nuevo_espacio = $this->input->post('select_nuevo_espacio');
                    $select_usos_espacio = $this->input->post('select_usos_espacio');
                    $select_nuevo_servicio = $this->input->post('select_nuevo_servicio');

                    $input_nuevo_espacio = $this->input->post('input_nuevo_espacio');
                    $input_otro_uso = $this->input->post('input_otro_uso');
                    $input_nuevo_servicio = $this->input->post('input_nuevo_servicio');
                }else{
                    $select_nuevo_equipo = array();
                    foreach($equipos as $k => $equipo){
                        $select_nuevo_equipo[] = $equipo['id_equipo'];
                    }

                    $select_nuevo_espacio = array();
                    $select_usos_espacio = array();
                    $input_otro_uso = array();
                    $input_nuevo_espacio = array();

                    foreach($espacios as $k => $espacio){
                        if($espacio['otro_espacio']){
                            $select_nuevo_espacio[] = $otro_espacio['id'];
                            $input_nuevo_espacio[] = $espacio['nombre_espacio'];
                        }else{
                            $select_nuevo_espacio[] = $espacio['id_espacio'];
                        }

                        if($espacio['otro_uso']){
                            $select_usos_espacio[] = $otro_uso['id'];
                            $input_otro_uso[] = $espacio['uso'];
                        }else{
                            $select_usos_espacio[] = $espacio['id_uso'];
                        }
                    }

                    $select_nuevo_servicio = array();
                    $input_nuevo_servicio = array();
                    foreach($servicios as $k => $servicio){
                        $select_nuevo_servicio[] = $servicio['id_categoria_servicio'];
                        $input_nuevo_servicio[] = $servicio['nombre_servicio'];
                    }
                }

                $data['select_nuevo_equipo'] = $select_nuevo_equipo;
                $data['select_nuevo_espacio'] = $select_nuevo_espacio;
                $data['select_nuevo_servicio'] = $select_nuevo_servicio;
                $data['select_usos_espacio'] = $select_usos_espacio;
                $data['input_nuevo_espacio'] = $input_nuevo_espacio;
                $data['input_otro_uso'] = $input_otro_uso;
                $data['input_nuevo_servicio'] = $input_nuevo_servicio;

                $data['fecha_uso'] = $solicitud['fecha_uso'];
                $data['hora_entrega'] = $solicitud['hora_entrega'];
                $data['hora_devolucion'] = $solicitud['hora_devolucion'];
                
                $indices_espacios = array();
                if(isset($select_nuevo_espacio)){
                    foreach($select_nuevo_espacio as $k => $v){
                        if($v == $otro_espacio['id']){
                            $indices_espacios[] = $k;
                        }
                    }
                }

                $viejos_espacios = $input_nuevo_espacio;
                if(isset($viejos_espacios)){
                    foreach($viejos_espacios as $k => $v){
                        $data['input_nuevo_espacio_' . $indices_espacios[$k]] = $v;
                        $this->form_validation->set_rules('input_nuevo_espacio[' . $indices_espacios[$k] . ']', 'nombre nuevo espacio', 'required');
                    }
                }

                $indices_usos = array();
                if(isset($select_usos_espacio)){
                    foreach($select_usos_espacio as $k => $v){
                        if($v == $otro_uso['id']){
                            $indices_usos[] = $k;
                        }
                    }
                }

                $viejos_usos = $input_otro_uso;
                if(isset($viejos_usos)){
                    foreach($viejos_usos as $k => $v){
                        $data['input_otro_uso_' . $indices_usos[$k]] = $v;
                        $this->form_validation->set_rules('input_otro_uso[' . $indices_usos[$k] . ']', 'uso del espacio', 'required');
                    }
                }

                $this->form_validation->set_rules('fecha_uso', 'Fecha de uso', 'required');
                $this->form_validation->set_rules('hora_entrega', 'Hora de entrega', 'required');
                $this->form_validation->set_rules('hora_devolucion', 'Hora de devoluci&oacute;n', 'required');

                if(!empty($fecha_uso) && !empty($hora_entrega) && !empty($hora_devolucion)){
                    if(!empty($select_nuevo_equipo)){
                        foreach($select_nuevo_equipo as $k => $v){
                            $this->form_validation->set_rules('select_nuevo_equipo[' . $k . ']', 'Equipo', 'callback__equipo_reservado_actualizar');
                        }
                    }

                    if(!empty($select_nuevo_espacio)){
                        foreach($select_nuevo_espacio as $k => $v){
                            if($v != $otro_espacio['id']){
                                $this->form_validation->set_rules('select_nuevo_espacio[' . $k . ']', 'Espacio', 'callback__espacio_reservado_actualizar');
                            }
                        }
                    }

                    if(!empty($select_nuevo_servicio)){
                        foreach($select_nuevo_servicio as $k => $v){
                            $this->form_validation->set_rules('input_nuevo_servicio[' . $k . ']', 'descripci&oacute;n del servicio', 'required');
                        }
                    }
                }

                if (!$this->form_validation->run()){

                    //Si el que intenta actualizar la cuenta es un Administrador, le doy opciones para cambiar el tipo a Administrador.
                    $data['administrador'] = $administrador;

                    //Si no pasa las reglas de validación, mostramos el formulario
                    $this->parser->parse('templates/header', $data);
                    $this->parser->parse('solicitudes/update', $data);
                    $this->parser->parse('templates/footer', $data);
                }else{
                    //Si los datos tienen el formato correcto, debo actualizarla
                    $datos['id_reservado'] = $this->session->id;
                    $datos['id_solicitante'] = $this->input->post('id_solicitante');
                    $datos['fecha_solicitud'] = date('Y-m-d');

                    $fecha_uso = DateTime::createFromFormat('d/m/Y', $fecha_uso);
                    $datos['fecha_uso'] = $fecha_uso->format('Y-m-d');

                    $hora_entrega = DateTime::createFromFormat('h:i A', $hora_entrega);
                    $datos['hora_entrega'] = $hora_entrega->format('H:i:s');

                    $hora_devolucion = DateTime::createFromFormat('h:i A', $hora_devolucion);
                    $datos['hora_devolucion'] = $hora_devolucion->format('H:i:s');

                    $table = 'solicitudes';
                    $updated = $this->solicitudes_model->update_solicitud($table, $id ,$datos);

                    if($updated){

                        $this->solicitudes_model->delete_auxiliares('solicitudes_equipos', $id);
                        $this->solicitudes_model->delete_auxiliares('solicitudes_espacios_usos', $id);
                        $this->solicitudes_model->delete_auxiliares('solicitudes_servicios', $id);

                        foreach($espacios as $k => $espacio){
                            if($espacio['otro_espacio']){
                                $this->espacios_model->delete_espacio('espacios', $espacio['id_espacio']);
                            }

                            if($espacio['otro_uso']){
                                $this->usos_model->delete_uso('usos', $espacio['id_uso']);
                            }
                        }

                        foreach($servicios as $k => $servicio){
                            $this->servicios_model->delete_servicio('servicios', $servicio['id_servicio']);
                        }

                        $id_solicitud = $id;
                        if(isset($select_nuevo_equipo)){
                            foreach($select_nuevo_equipo as $k => $v){
                                $datos = array();
                                $datos['id_equipo'] = $v;
                                $datos['id_solicitud'] = $id_solicitud;
                                $insert_id = $this->solicitudes_model->insert_auxiliares('solicitudes_equipos', $datos);
                            }
                        }

                        if(isset($select_nuevo_espacio)){
                            foreach($select_nuevo_espacio as $k => $v){
                                $datos = array();
                                if($v == $otro_espacio['id']){
                                    $datos['nombre_espacio'] = $data['input_nuevo_espacio_' . $k];
                                    $datos['otro_espacio'] = TRUE;
                                    $id_espacio = $this->espacios_model->create_espacio('espacios', $datos);
                                }else{
                                    $id_espacio = $v;
                                }

                                if($select_usos_espacio[$k] == $otro_uso['id']){
                                    $datos = array();
                                    $datos['uso'] = $data['input_otro_uso_' . $k];
                                    $datos['otro_uso'] = TRUE;
                                    $id_uso = $this->usos_model->create_uso('usos', $datos);
                                }else{
                                    $id_uso = $select_usos_espacio[$k];
                                }

                                $datos = array();
                                $datos['id_solicitud'] = $id_solicitud;
                                $datos['id_espacio'] = $id_espacio;
                                $datos['id_uso'] = $id_uso;
                                $insert_id = $this->solicitudes_model->insert_auxiliares('solicitudes_espacios_usos', $datos);
                            }
                        }

                        if(isset($select_nuevo_servicio)){
                            foreach($select_nuevo_servicio as $k => $v){
                                $datos = array();
                                $datos['nombre_servicio'] = $data['input_nuevo_servicio'][$k];
                                $datos['id_categoria_servicio'] = $v;
                                $id_servicio = $this->servicios_model->create_servicio('servicios', $datos);

                                $datos = array();
                                $datos['id_servicio'] = $id_servicio;
                                $datos['id_solicitud'] = $id_solicitud;
                                $insert_id = $this->solicitudes_model->insert_auxiliares('solicitudes_servicios', $datos);
                            }
                        }

                        $this->session->set_userdata('mensaje', 'La solicitud fue actualizada satisfactoriamente.');
                        redirect('solicitudes/detalles/' . $id_solicitud);
                    }

                    //Si llegué a este punto es porque no pudo guardar la solicitud
                    $this->session->set_userdata('mensaje', 'No se pudo crear la solicitud, por favor intente nuevamente.');
                    redirect('solicitudes/listar');
                }
            }else{
                $this->session->set_userdata('mensaje', 'La solicitud que intenta actualizar no existe.');
                redirect('solicitudes/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function cerrar($id){

        //Lo primero es ver si es Administrador
        $administrador = $this->session->administrador;
        if($administrador){
            $data['title'] = 'Confirmar cierre de la solicitud #' . $id;

            $solicitud = $this->solicitudes_model->get_solicitud($id);

            if($solicitud){
                $usuario = $this->usuarios_model->get_usuario_by_id($solicitud['id_solicitante']);

                $data['equipos'] = $this->equipos_model->get_equipos_solicitud($id);
                $data['espacios'] = $this->espacios_model->get_espacios_solicitud($id);
                $data['servicios'] = $this->servicios_model->get_servicios_solicitud($id);

                $data = array_merge($data, $usuario);
                $data = array_merge($data, $solicitud);

                $this->form_validation->set_rules('observaciones', 'observaciones', 'trim|required');

                if (!$this->form_validation->run()){

                    //Si no pasa las reglas de validación, mostramos el formulario
                    $this->parser->parse('templates/header', $data);
                    $this->parser->parse('solicitudes/close', $data);
                    $this->parser->parse('templates/footer', $data);
                }else{
                    //Si los datos tienen el formato correcto, debo cerrar la solicitud

                    $datos['id_recibido'] = $this->session->id;
                    $datos['observaciones'] = $this->input->post('observaciones');

                    $was_updated = $this->solicitudes_model->update_solicitud('solicitudes', $solicitud['id'], $datos);

                    //Si lo actualizó correctamente, redirigir con éxito
                    if($was_updated){
                        $this->session->set_userdata('mensaje', 'La solicitud fue cerrada satisfactoriamente.');
                        redirect('solicitudes/recibir');
                    }

                    //Si llegué a este punto es porque no pudo cerrar la solicitud
                    $this->session->set_userdata('mensaje', 'No se pudo cerrar la solicitud, por favor intente nuevamente.');
                    redirect('solicitudes/cerrar/' . $solicitud['id']);
                }

                $this->parser->parse('templates/header', $data);
                $this->parser->parse('solicitudes/confirm', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                $this->session->set_userdata('mensaje', 'La solicitud que intenta cerrar no existe.');
                redirect('solicitudes/recibir');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function borrar($id){

    }

    public function listar(){
        //Lo primero es ver si es Administrador, no?
        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Lista de Solicitudes';

            $data['solicitudes'] = $this->solicitudes_model->get_solicitudes_extended(false);

            $this->parser->parse('templates/header', $data);
            $this->parser->parse('solicitudes/show', $data);
            $this->parser->parse('templates/footer', $data);
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function detalles($id){
        //Lo primero es ver si es Administrador, o si el que intenta ver los detalles es el mismo usuario
        $administrador = $this->session->administrador;
        if($administrador){
            $data['title'] = 'Detalles de la solicitud';

            $solicitud = $this->solicitudes_model->get_solicitud($id);

            if($solicitud){
                $usuario = $this->usuarios_model->get_usuario_by_id($solicitud['id_solicitante']);

                $data['equipos'] = $this->equipos_model->get_equipos_solicitud($id);
                $data['espacios'] = $this->espacios_model->get_espacios_solicitud($id);
                $data['servicios'] = $this->servicios_model->get_servicios_solicitud($id);

                $data = array_merge($data, $usuario);
                $data = array_merge($data, $solicitud);

                $this->parser->parse('templates/header', $data);
                $this->parser->parse('solicitudes/details', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                $this->session->set_userdata('mensaje', 'La solicitud que intenta visualizar no existe.');
                redirect('solicitudes/listar');
            }


        } else {
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function recibir(){
        $administrador = $this->session->administrador;
        if($administrador){
            $data['title'] = 'Cierre de solicitud';
            $data['solicitudes'] = $this->solicitudes_model->get_solicitudes_extended(true);

            $this->parser->parse('templates/header', $data);
            $this->parser->parse('solicitudes/receive', $data);
            $this->parser->parse('templates/footer', $data);

        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function nuevo_equipo(){
        $equipos_disponibles = $this->equipos_model->get_equipos_sistema('equipos');

        echo json_encode($equipos_disponibles);
    }

    public function nuevo_espacio(){
        $usos_espacio = $this->usos_model->get_usos_sistema('usos');
        $espacios = $this->espacios_model->get_espacios_sistema('espacios');

        $data['espacios'] = $espacios;
        $data['usos'] = $usos_espacio;
        
        echo json_encode($data);
    }

    public function nuevo_servicio(){
        $servicios_disponibles = $this->categoria_model->get_categorias('categoria_servicio');

        echo json_encode($servicios_disponibles);
    }

    public function _equipo_ya_reservado($id_equipo){
        $this->form_validation->set_message('_equipo_ya_reservado', 'Este equipo se encuentra reservado por otro usuario.');

        $fecha_uso = $this->input->post('fecha_uso');
        $hora_entrega = $this->input->post('hora_entrega');
        $hora_devolucion = $this->input->post('hora_devolucion');

        $fecha_uso = DateTime::createFromFormat('d/m/Y', $fecha_uso);
        $hora_entrega = DateTime::createFromFormat('h:i A', $hora_entrega);
        $hora_devolucion = DateTime::createFromFormat('h:i A', $hora_devolucion);

        $fecha_uso = $fecha_uso->format('Y-m-d');

        $solicitudes = $this->solicitudes_model->get_solicitudes_by_date('solicitudes', $fecha_uso);

        $ids_equipos_en_uso = array();

        foreach ($solicitudes as $i => $solicitud){
            //start1 <= end2 and start2 <= end1 to see if they intersect
            $inicio_solicitud = DateTime::createFromFormat('H:i:s', $solicitud['hora_entrega']);
            $fin_solicitud = DateTime::createFromFormat('H:i:s', $solicitud['hora_devolucion']);
            if($hora_entrega <= $fin_solicitud and $inicio_solicitud <= $hora_devolucion){
                $equipos = $this->solicitudes_model->get_equipos_by_solicitud('solicitudes_equipos', $solicitud['id']);
                foreach ($equipos as $j => $equipo){
                    $ids_equipos_en_uso[] = $equipo['id_equipo'];
                }
            }
        }

        if(empty($ids_equipos_en_uso)){
            $ids_equipos_en_uso[] = '0';
        }

        $ids_equipos_en_uso = array_unique($ids_equipos_en_uso);

        if(in_array($id_equipo, $ids_equipos_en_uso)){
            return false;
        }

        return true;
    }

    public function _equipo_reservado_actualizar($id_equipo){
        $this->form_validation->set_message('_equipo_reservado_actualizar', 'Este equipo se encuentra reservado por otro usuario.');

        $fecha_uso = $this->input->post('fecha_uso');
        $hora_entrega = $this->input->post('hora_entrega');
        $hora_devolucion = $this->input->post('hora_devolucion');

        $fecha_uso = DateTime::createFromFormat('d/m/Y', $fecha_uso);
        $hora_entrega = DateTime::createFromFormat('h:i A', $hora_entrega);
        $hora_devolucion = DateTime::createFromFormat('h:i A', $hora_devolucion);

        $fecha_uso = $fecha_uso->format('Y-m-d');

        $solicitudes = $this->solicitudes_model->get_solicitudes_by_date('solicitudes', $fecha_uso);

        $ids_equipos_en_uso = array();
        $id_solicitud = $this->uri->segment(3);

        foreach ($solicitudes as $i => $solicitud){
            if($solicitud['id'] != $id_solicitud){
                //start1 <= end2 and start2 <= end1 to see if they intersect
                $inicio_solicitud = DateTime::createFromFormat('H:i:s', $solicitud['hora_entrega']);
                $fin_solicitud = DateTime::createFromFormat('H:i:s', $solicitud['hora_devolucion']);
                if($hora_entrega <= $fin_solicitud and $inicio_solicitud <= $hora_devolucion){
                    $equipos = $this->solicitudes_model->get_equipos_by_solicitud('solicitudes_equipos', $solicitud['id']);
                    foreach ($equipos as $j => $equipo){
                        $ids_equipos_en_uso[] = $equipo['id_equipo'];
                    }
                }
            }
        }

        if(empty($ids_equipos_en_uso)){
            $ids_equipos_en_uso[] = '0';
        }

        $ids_equipos_en_uso = array_unique($ids_equipos_en_uso);

        if(in_array($id_equipo, $ids_equipos_en_uso)){
            return false;
        }

        return true;
    }

    public function _espacio_ya_reservado($id_espacio){
        $this->form_validation->set_message('_espacio_ya_reservado', 'Este espacio se encuentra reservado por otro usuario.');

        $fecha_uso = $this->input->post('fecha_uso');
        $hora_entrega = $this->input->post('hora_entrega');
        $hora_devolucion = $this->input->post('hora_devolucion');

        $fecha_uso = DateTime::createFromFormat('d/m/Y', $fecha_uso);
        $hora_entrega = DateTime::createFromFormat('h:i A', $hora_entrega);
        $hora_devolucion = DateTime::createFromFormat('h:i A', $hora_devolucion);

        $fecha_uso = $fecha_uso->format('Y-m-d');

        $solicitudes = $this->solicitudes_model->get_solicitudes_by_date('solicitudes', $fecha_uso);

        $ids_espacios_en_uso = array();

        foreach ($solicitudes as $i => $solicitud){
            //start1 <= end2 and start2 <= end1 to see if they intersect
            $inicio_solicitud = DateTime::createFromFormat('H:i:s', $solicitud['hora_entrega']);
            $fin_solicitud = DateTime::createFromFormat('H:i:s', $solicitud['hora_devolucion']);
            if($hora_entrega <= $fin_solicitud and $inicio_solicitud <= $hora_devolucion){
                $espacios = $this->solicitudes_model->get_espacios_by_solicitud('solicitudes_espacios_usos', $solicitud['id']);
                foreach ($espacios as $j => $espacio){
                    $ids_espacios_en_uso[] = $espacio['id_espacio'];
                }
            }
        }

        if(empty($ids_espacios_en_uso)){
            $ids_espacios_en_uso[] = '0';
        }

        $ids_espacios_en_uso = array_unique($ids_espacios_en_uso);

        if(in_array($id_espacio, $ids_espacios_en_uso)){
            return false;
        }

        return true;
    }

    public function _espacio_reservado_actualizar($id_espacio){
        $this->form_validation->set_message('_espacio_reservado_actualizar', 'Este espacio se encuentra reservado por otro usuario.');

        $fecha_uso = $this->input->post('fecha_uso');
        $hora_entrega = $this->input->post('hora_entrega');
        $hora_devolucion = $this->input->post('hora_devolucion');

        $fecha_uso = DateTime::createFromFormat('d/m/Y', $fecha_uso);
        $hora_entrega = DateTime::createFromFormat('h:i A', $hora_entrega);
        $hora_devolucion = DateTime::createFromFormat('h:i A', $hora_devolucion);

        $fecha_uso = $fecha_uso->format('Y-m-d');

        $solicitudes = $this->solicitudes_model->get_solicitudes_by_date('solicitudes', $fecha_uso);

        $ids_espacios_en_uso = array();
        $id_solicitud = $this->uri->segment(3);

        foreach ($solicitudes as $i => $solicitud){
            if($id_solicitud != $solicitud['id']){
                //start1 <= end2 and start2 <= end1 to see if they intersect
                $inicio_solicitud = DateTime::createFromFormat('H:i:s', $solicitud['hora_entrega']);
                $fin_solicitud = DateTime::createFromFormat('H:i:s', $solicitud['hora_devolucion']);
                if($hora_entrega <= $fin_solicitud and $inicio_solicitud <= $hora_devolucion){
                    $espacios = $this->solicitudes_model->get_espacios_by_solicitud('solicitudes_espacios_usos', $solicitud['id']);
                    foreach ($espacios as $j => $espacio){
                        $ids_espacios_en_uso[] = $espacio['id_espacio'];
                    }
                }
            }
        }

        if(empty($ids_espacios_en_uso)){
            $ids_espacios_en_uso[] = '0';
        }

        $ids_espacios_en_uso = array_unique($ids_espacios_en_uso);

        if(in_array($id_espacio, $ids_espacios_en_uso)){
            return false;
        }

        return true;
    }
}