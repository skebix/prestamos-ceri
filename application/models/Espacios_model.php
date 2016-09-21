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

    public function get_espacio_by_name($table, $name){
        $this->db->from($table);
        $this->db->where('nombre_espacio', $name);

        return $this->db->get()->row_array();
    }

    public function get_espacios($table){
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function get_espacios_sistema($table){
        $this->db->from($table);
        $this->db->where('otro_espacio', FALSE);
        $this->db->where('habilitado', TRUE);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function create_espacio($table, $datos){
        $this->db->insert($table, $datos);
        $insert_id = $this->db->insert_id();

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

    public function get_espacios_sin_usar($ids_espacios_en_uso){
        $this->db->from('espacios');
        $this->db->where('otro_espacio', FALSE);
        $this->db->where_not_in('id', $ids_espacios_en_uso);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_espacios_solicitud($id){
        $this->db->from('solicitudes_espacios_usos');
        $this->db->where('id_solicitud ='.$id);
        $this->db->join('espacios', 'espacios.id = solicitudes_espacios_usos.id_espacio');

        $query = $this->db->get();
        return $query->result_array();
    }
}