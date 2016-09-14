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

    public function get_solicitudes_extended($table_with_foreign_ids,$table_with_data_of_the_ids,$only_active_sols){
        if ($only_active_sols){
            $this->db->select('*');
            $this->db->from($table_with_data_of_the_ids);
            $this->db->join($table_with_foreign_ids, $table_with_foreign_ids.'.id_solicitante='.$table_with_data_of_the_ids.'.id');
            $this->db->having('id_recibido', null);
            $query = $this->db->get();
            return $query->result_array();
        }else{
            $this->db->select('*');
            $this->db->from($table_with_data_of_the_ids);
            $this->db->join($table_with_foreign_ids, $table_with_foreign_ids.'.id_solicitante='.$table_with_data_of_the_ids.'.id');
            $query = $this->db->get();
            return $query->result_array();
        }

    }

    public function get_detalles($id){
        $table_solicitudes = 'solicitudes';
        $table_usuarios = 'usuarios';
        $equipos_reservados = $this->equipos_model->get_equipos_solicitud($id);
        $espacios_reservados = $this->espacios_model->get_espacios_solicitud($id);
        $servicios_reservados = $this->servicios_model->get_servicios_solicitud($id);
        $this->db->select('id_solicitante, fecha_solicitud, fecha_uso');
        $this->db->from($table_solicitudes);
        $this->db->where($table_solicitudes.'.id ='.$id);
        $solicitud_unica = $this->db->get()->result_array();
        $idsol = $solicitud_unica[0]['id_solicitante'];
        $this->db->select('primer_nombre, segundo_nombre, primer_apellido, segundo_apellido');
        $this->db->from($table_usuarios);
        $this->db->where($table_usuarios.'.id ='.$idsol);
        $usuario = $this->db->get()->result_array();
        $data_array = array(
            0 => $equipos_reservados,
            1 => $espacios_reservados,
            2 => $servicios_reservados,
            3 => $usuario,
            4 => $solicitud_unica);
        return $data_array;
    }
    public function recibir_prestamo($id_sol, $id_admin, $obs){
        $table_solicitudes = 'solicitudes';
        $data = array(
            'id_recibido' => $id_admin,
            'observaciones' => $obs
        );
        $this->db->where('id', $id_sol);
        $this->db->update($table_solicitudes, $data);
        return true;
    }
}