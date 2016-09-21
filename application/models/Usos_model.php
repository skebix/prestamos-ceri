<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 09:55 AM
 */

class Usos_model extends CI_Model {

    public function get_uso($table, $id_uso){
        $this->db->from($table);
        $this->db->where('id', $id_uso);

        return $this->db->get()->row_array();
    }

    public function get_uso_by_name($table, $name){
        $this->db->from($table);
        $this->db->where('uso', $name);

        return $this->db->get()->row_array();
    }

    public function get_usos($table){
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function get_usos_sistema($table){
        $this->db->from($table);
        $this->db->where('otro_uso', FALSE);
        $this->db->where('habilitado', TRUE);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function create_uso($table, $datos){
        $this->db->insert($table, $datos);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function update_uso($table, $id, $categoria){
        $this->db->where('id', $id);
        $update_id = $this->db->update($table, $categoria);
        return $update_id;
    }

    public function delete_uso($table, $id){
        $delete_id = $this->db->delete($table, array('id' => $id));
        return $delete_id;
    }
}