<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 08:17 AM
 */

class Espacios_model extends CI_Model {

    public function get_espacio($table, $id_espacio){
        $this->db->from($table);
        $this->db->where('id', $id_espacio);

        return $this->db->get()->row_array();
    }

    public function get_espacios($table){
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function create_espacio($table, $datos){
        $insert_id = $this->db->insert($table, $datos);
        return $insert_id;
    }

    public function update_espacio($table, $id, $categoria){
        $this->db->where('id', $id);
        $update_id = $this->db->update($table, $categoria);
        return $update_id;
    }

    public function delete_espacio($table, $id){
        $delete_id = $this->db->delete($table, array('id' => $id));
        return $delete_id;
    }

    public function get_espacios_solicitud($id){
        $this->db->select('*');
        $this->db->from('solicitudes_espacios');
        $this->db->where('id_solicitud ='.$id);
        $this->db->join('espacios','espacios.id = solicitudes_espacios.id_espacio');
        $query = $this->db->get();
        return $query->result_array();
    }
}