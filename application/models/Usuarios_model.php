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

    public function get_usuarios_habilitados(){
        $this->db->from('usuarios');
        $this->db->where('habilitado', TRUE);

        return $this->db->get()->result_array();
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

    public function get_usuario_by_id($id){
        $this->db->from('usuarios');
        $this->db->where('id', $id);

        return $this->db->get()->row_array();
    }

    public function create_user($usuario){
        $insert_id = $this->db->insert('usuarios', $usuario);
        return $insert_id;
    }

    public function delete_user($id){
        $delete_id = $this->db->delete('usuarios', array('id' => $id));
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

    public function update_by_cedula($table, $cedula, $datos){
        $this->db->where('cedula', $cedula);
        $was_updated = $this->db->update($table, $datos);

        return $was_updated;
    }
    
    public function update_user($id, $usuario){
        $this->db->where('id', $id);
        $update_id = $this->db->update('usuarios', $usuario);
        return $update_id;
    }

    public function get_amount_usuarios_by_categoria($id_categoria_usuario){
        $this->db->from('usuarios');
        $this->db->where('id_categoria_usuario', $id_categoria_usuario);

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_usuarios_by_categoria($id_categoria_usuario){
        $this->db->from('usuarios');
        $this->db->where('id_categoria_usuario', $id_categoria_usuario);

        $query = $this->db->get();
        return $query->result_array();
    }
}