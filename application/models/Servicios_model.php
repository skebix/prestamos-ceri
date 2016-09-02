<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 14/04/2016
 * Time: 03:55 PM
 */

class Servicios_model extends CI_Model {

    public function create_servicio($table, $datos){
        $this->db->insert($table, $datos);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function get_servicios($table){
        $this->db->select($table . '.id, ' . $table . '.nombre_servicio, categoria_servicio.categoria');
        $this->db->from($table);
        $this->db->join('categoria_servicio', 'servicios.id_categoria_servicio = categoria_servicio.id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_servicio($id){
        $this->db->from('servicios');
        $this->db->where('id', $id);

        return $this->db->get()->row_array();
    }

    public function get_servicio_by_name($table, $name){
        $this->db->from($table);
        $this->db->where('nombre_servicio', $name);

        return $this->db->get()->row_array();
    }

    public function update_servicio($table, $id, $categoria){
        $this->db->where('id', $id);
        $update_id = $this->db->update($table, $categoria);
        return $update_id;
    }

    public function delete_servicio($table, $id){
        $delete_id = $this->db->delete($table, array('id' => $id));
        return $delete_id;
    }

}