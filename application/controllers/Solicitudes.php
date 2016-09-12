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

    function crear(){

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
            $otro_servicio = $this->servicios_model->get_servicio_by_name('servicios', 'Otro (especifique)');

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

                    $this->session->set_userdata('mensaje', 'El equipo fue a&ntilde;adido satisfactoriamente.');
                    redirect('solicitudes/listar');
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
    
    function borrar($id){

        //Comprobacion de que el usuario sea un administrador
        $administrador = $this->session->administrador;
        if($administrador){
            $data['title'] = 'Borrado de solicitudes';
            $table = 'solicitudes_equipos';
            $this->db->from($table);
            $this->db->where('id_solicitud', $id);
            $delete_id = $this->db->get()->row_array();
            if ($delete_id){
                $this->db->delete($table, array('id_solicitud' => $id));
            }
            $table = 'solicitudes_espacios';
            $this->db->from($table);
            $this->db->where('id_solicitud', $id);
            $delete_id = $this->db->get()->row_array();
            if ($delete_id){
                $this->db->delete($table, array('id_solicitud' => $id));
            }
            $table = 'solicitudes_servicios';
            $this->db->from($table);
            $this->db->where('id_solicitud', $id);
            $delete_id = $this->db->get()->row_array();
            if ($delete_id){
                $this->db->delete($table, array('id_solicitud' => $id));
            }
            $table = 'usos_espacios';
            $this->db->from($table);
            $this->db->where('id_solicitud', $id);
            $delete_id = $this->db->get()->row_array();
            if ($delete_id){
                $this->db->delete($table, array('id_solicitud' => $id));
            }
            $table = 'solicitudes';
            $this->db->from($table);
            $this->db->where('id', $id);
            $delete_id = $this->db->get()->row_array();
            if ($delete_id){
                $this->db->delete($table, array('id' => $id));
            }
            $this->parser->parse('templates/header', $data);
            $this->parser->parse('templates/footer', $data);
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

            $data['title'] = 'Solicitudes activas';
            $table_solicitudes = 'solicitudes';
            $table_usuarios = 'usuarios';
            $data['solicitudes'] = $this->solicitudes_model->get_solicitudes_extended($table_solicitudes,$table_usuarios);
            $this->parser->parse('templates/header', $data);
            $this->parser->parse('solicitudes/show', $data);
            $this->parser->parse('templates/footer', $data);
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }
    public function detalles($id)
    {
        //Lo primero es ver si es Administrador, o si el que intenta ver los detalles es el mismo usuario
        $administrador = $this->session->administrador;
        if ($administrador) {
            $data['title'] = 'Detalles de la solicitud';
            $detalles = $this->solicitudes_model->get_detalles($id);
            $data['title'] = 'Detalles de la solicitud';
            $data['equipos'] = $detalles[0];
            $data['espacios'] = $detalles[1];
            $data['servicios'] = $detalles[2];
            $data['usuario'] = $detalles[3];
            $data['solicitud'] = $detalles[4];
            $this->parser->parse('templates/header', $data);
            $this->parser->parse('solicitudes/details', $data);
            $this->parser->parse('templates/footer', $data);
        } else {
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function recibir($id = null){
        $administrador = $this->session->administrador;
        if ($administrador) {
            if (!$id) { //Mostrar todos los prestamos existentes
                $data['title'] = 'Cierre de solicitud';
                $table_solicitudes = 'solicitudes';
                $table_usuarios = 'usuarios';
                $data['solicitudes'] = $this->solicitudes_model->get_solicitudes_extended($table_solicitudes, $table_usuarios);
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('solicitudes/receive', $data);
                $this->parser->parse('templates/footer', $data);
            } else { //Mostrar el prestamo a cerrar.
                $data['title'] = 'Confirmar cierre de la solicitud # '.$id;
                $data['id'] = $id;
                $detalles = $this->solicitudes_model->get_detalles($id);
                $data['equipos'] = $detalles[0];
                $data['espacios'] = $detalles[1];
                $data['servicios'] = $detalles[2];
                $data['usuario'] = $detalles[3];
                $data['solicitud'] = $detalles[4];
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('solicitudes/confirm_recep', $data);
                $this->parser->parse('templates/footer', $data);
            }
        } else {
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function cerrado($id){
        $administrador = $this->session->administrador;
        if ($administrador){
            $data['title'] = 'Cierre de solicitud';
            $id_sol = $this->input->post('solsid');
            $id_admin = $this->session->id;
            $close = $this->solicitudes_model->recibir_prestamo($id_sol,$id_admin);
            $this->parser->parse('templates/header', $data);
            $this->parser->parse('solicitudes/closed', $data);
            $this->parser->parse('templates/footer', $data);
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }

    public function nuevo_equipo(){
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

        $equipos_disponibles = $this->equipos_model->get_equipos_sin_usar($ids_equipos_en_uso);

        echo json_encode($equipos_disponibles);
    }

    public function nuevo_espacio(){
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

        $espacios_disponibles = $this->espacios_model->get_espacios_sin_usar($ids_espacios_en_uso);

        $usos_espacio = $this->usos_model->get_usos_sistema('usos');

        $data['espacios'] = $espacios_disponibles;
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
}