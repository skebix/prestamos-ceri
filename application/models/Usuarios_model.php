<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 31/03/2016
 * Time: 07:59 AM
 */

class Usuarios_model extends CI_Model {

    public function get_usuarios(){
        $query = $this->db->get('usuarios');
        return $query->result_array();
    }

    public function get_usuario($cedula){
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('cedula', $cedula);

        return $this->db->get()->row_array();
    }
}