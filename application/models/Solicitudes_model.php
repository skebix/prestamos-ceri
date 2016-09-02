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

    public function get_espacios_by_solicitud($table, $id_solicitud){
        $this->db->from($table);
        $this->db->where('id_solicitud', $id_solicitud);
        $query = $this->db->get();

        return $query->result_array();
    }
    
    public function get_servicios($table){
        $this->db->select($table . '.id, ' . $table . '.nombre_servicio, categoria_servicio.categoria');
        $this->db->from($table);
        $this->db->join('categoria_servicio', 'servicios.id_categoria_servicio = categoria_servicio.id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_servicio($id){
        $this->db->from('servicios');
        $this->db->where('id', $id);

        return $this->db->get()->row_array();
    }

    public function update_servicio($table, $id, $categoria){
        $this->db->where('id', $id);
        $update_id = $this->db->update($table, $categoria);
        return $update_id;
    }

    public function delete_servicio($table, $id){
        $delete_id = $this->db->delete($table, array('id' => $id));
        return $delete_id;
    }

    public function get_solicitudes($table){
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function get_solicitudes_extended($table_with_foreign_ids,$table_with_data_of_the_ids){
        $this->db->select('*');
        $this->db->from($table_with_data_of_the_ids);
        $this->db->join($table_with_foreign_ids, $table_with_foreign_ids.'.id_solicitante='.$table_with_data_of_the_ids.'.id');
        $query = $this->db->get();
        return $query->result_array();
    }
}