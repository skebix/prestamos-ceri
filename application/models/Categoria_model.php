<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 04/04/2016
 * Time: 11:16 AM
 */

class Categoria_model extends CI_Model {

    public function get_categoria($table, $id_categoria){
        $this->db->from($table);
        $this->db->where('id', $id_categoria);

        return $this->db->get()->row_array();
    }

    public function get_categorias($table){
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function create_categoria($table, $datos){
        $insert_id = $this->db->insert($table, $datos);
        return $insert_id;
    }

    public function update_categoria($table, $id, $categoria){
        $this->db->where('id', $id);
        $update_id = $this->db->update($table, $categoria);
        return $update_id;
    }

    public function delete_categoria($table, $id){
        $delete_id = $this->db->delete($table, array('id' => $id));
        return $delete_id;
    }

}