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

    public function create_categoria($datos){
        $insert_id = $this->db->insert('categoria_usuario', $datos);
        return $insert_id;
    }

    public function get_administracion($id_administracion){
        $this->db->from('administracion');
        $this->db->where('id', $id_administracion);

        return $this->db->get()->row_array();
    }
}