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

            $data['title'] = 'Nueva solicitud';

            $table = 'usuarios';
            $usuarios = $this->usuarios_model->get_usuarios();
            $data['usuarios'] = $usuarios;

            $this->form_validation->set_rules('fecha_uso', 'Fecha de uso', 'required');

            if(!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('solicitudes/create', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar la nueva categoría en la BD
                $datos['id_reservado'] = $this->session->id;
                $datos['id_usuario'] = $this->input->post('id_usuario');
                $datos['fecha_solicitud'] = date('Y-m-d');

                $fecha_uso = DateTime::createFromFormat('d/m/Y', $this->input->post('fecha_uso'));
                $datos['fecha_uso'] = $fecha_uso->format('Y-m-d');

                $hora_entrega = DateTime::createFromFormat('h:i A', $this->input->post('hora_entrega'));
                $datos['hora_entrega'] = $hora_entrega->format('H:i:s');

                $hora_devolucion = DateTime::createFromFormat('h:i A', $this->input->post('hora_devolucion'));
                $datos['hora_devolucion'] = $hora_devolucion->format('H:i:s');

                $table = 'solicitudes';
                $was_inserted = $this->db->insert($table, $datos);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_inserted){
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
}