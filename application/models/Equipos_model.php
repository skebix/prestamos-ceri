<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 07:58 AM
 */

class Equipos_model extends CI_Model {

    public function create_equipo($table, $datos){
        $insert_id = $this->db->insert($table, $datos);
        return $insert_id;
    }

    public function get_equipos(){
        $this->db->from('equipos');
        $this->db->join('categoria_equipo', 'equipos.id_categoria_equipo = categoria_equipo.id');
        $query = $this->db->get();

        return $query->result_array();
    }


    public function update_equipo($table, $id, $categoria){
        $this->db->where('id', $id);
        $update_id = $this->db->update($table, $categoria);
        return $update_id;
    }

    public function delete_equipo($table, $id){
        $delete_id = $this->db->delete($table, array('id' => $id));
        return $delete_id;
    }

    public function get_administracion($id_administracion){
        $this->db->from('administracion');
        $this->db->where('id', $id_administracion);

        return $this->db->get()->row_array();
    }
}