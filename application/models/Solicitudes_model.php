<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 26/06/16
 * Time: 01:57 PM
 */

class Solicitudes_model extends CI_Model {

    public function create_solicitud($table, $datos){
        $this->db->insert($table, $datos);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function insert_auxiliares($table, $datos){
        $this->db->insert($table, $datos);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function delete_auxiliares($table, $id_solicitud){
        $deleted = $this->db->delete($table, array('id_solicitud' => $id_solicitud));
        return $deleted;
    }

    public function delete_solicitud($table, $id){
        $delete_id = $this->db->delete($table, array('id' => $id));
        return $delete_id;
    }

    public function get_solicitudes_by_date($table, $date){
        $this->db->from($table);
        $this->db->where('fecha_uso', $date);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_equipos_by_solicitud($table, $id_solicitud){
        $this->db->from($table);
        $this->db->where('id_solicitud', $id_solicitud);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_servicios_by_solicitud($table, $id_solicitud){
        $this->db->from($table);
        $this->db->where('id_solicitud', $id_solicitud);
        $this->db->join('servicios', 'solicitudes_servicios.id_servicio = servicios.id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_espacios_by_solicitud($table, $id_solicitud){
        $this->db->from($table);
        $this->db->where('id_solicitud', $id_solicitud);
        $this->db->join('espacios', 'solicitudes_espacios_usos.id_espacio = espacios.id');
        $this->db->join('usos', 'solicitudes_espacios_usos.id_uso = usos.id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_espacios_solicitud($id){
        $this->db->select('*');
        $this->db->from('solicitudes_espacios');
        $this->db->where('id_solicitud ='.$id);
        $this->db->join('espacios','espacios.id = solicitudes_espacios_usos.id_espacio');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_solicitud($id){
        $this->db->from('solicitudes');
        $this->db->where('id', $id);

        return $this->db->get()->row_array();
    }

    public function update_solicitud($table, $id, $datos){
        $this->db->where('id', $id);
        $was_updated = $this->db->update($table, $datos);

        return $was_updated;
    }

    public function get_solicitudes($table){
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function get_solicitudes_extended($active){
        $this->db->from('usuarios');
        $this->db->join('solicitudes', 'solicitudes.id_solicitante = usuarios.id');

        if($active){
            $this->db->having('id_recibido', null);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function recibir_prestamo($id_sol, $id_admin, $obs){
        $data = array(
            'id_recibido' => $id_admin,
            'observaciones' => $obs
        );

        $this->db->where('id', $id_sol);
        $was_updated = $this->db->update('solicitudes', $data);

        return $was_updated;
    }

    public function get_solicitudes_by_equipo($id_equipo){
        $this->db->from('solicitudes_equipos');
        $this->db->where('id_equipo', $id_equipo);

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_solicitudes_by_servicio($id_servicio){
        $this->db->from('solicitudes_servicios');
        $this->db->where('id_equipo', $id_servicio);

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_solicitudes_by_espacio($id_servicio){
        $this->db->from('solicitudes_espacios_usos');
        $this->db->where('id_espacio', $id_servicio);

        $query = $this->db->get();
        return $query->num_rows();
    }
}