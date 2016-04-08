<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 04/04/2016
 * Time: 11:16 AM
 */

class Categoria_model extends CI_Model {

    public function get_categoria($id_categoria){
        $this->db->from('categoria_usuario');
        $this->db->where('id', $id_categoria);

        return $this->db->get()->row_array();
    }

    public function get_usuarios(){
        $query = $this->db->get('categoria_usuario');
        return $query->result_array();
    }

    public function create_categoria($datos){
        $insert_id = $this->db->insert('categoria_usuario', $datos);
        return $insert_id;
    }

    public function update_categoria($id, $categoria){
        $this->db->where('id', $id);
        $update_id = $this->db->update('categoria_usuario', $categoria);
        return $update_id;
    }

    public function delete_categoria($id){
        $delete_id = $this->db->delete('categoria_usuario', array('id' => $id));
        return $delete_id;
    }

    public function get_administracion($id_administracion){
        $this->db->from('administracion');
        $this->db->where('id', $id_administracion);

        return $this->db->get()->row_array();
    }
}