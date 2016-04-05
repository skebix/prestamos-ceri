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
        $this->db->from('usuarios');
        $this->db->where('cedula', $cedula);

        return $this->db->get()->row_array();
    }

    public function get_usuario_by_email($email){
        $this->db->from('usuarios');
        $this->db->where('email', $email);

        return $this->db->get()->row_array();
    }

    public function get_categorias_usuario(){
        $query = $this->db->get('categoria_usuario');
        return $query->result_array();
    }

    public function create_user($usuario){
        $insert_id = $this->db->insert('usuarios', $usuario);
        return $insert_id;
    }

    public function delete_user($cedula){
        $delete_id = $this->db->delete('usuarios', array('cedula' => $cedula));
        return $delete_id;
    }

    public function update_token($cedula, $hashed_token){
        $this->db->where('cedula', $cedula);
        $update_id = $this->db->update('usuarios', $hashed_token);
        return $update_id;
    }

    public function update_password($cedula, $hashed_password){
        $this->db->where('cedula', $cedula);
        $update_id = $this->db->update('usuarios', $hashed_password);
        return $update_id;
    }
}