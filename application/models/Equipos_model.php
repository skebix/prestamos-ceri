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
    
    public function get_equipos_sistema($table){
        $this->db->from($table);
        $this->db->where('habilitado', TRUE);
        $query = $this->db->get();

        return $query->result_array();
    }
    
    public function get_equipos($table){
        $this->db->select($table . '.id, ' . $table . '.nombre_equipo, ' . $table . '.habilitado, categoria_equipo.categoria');
        $this->db->from($table);
        $this->db->join('categoria_equipo', 'equipos.id_categoria_equipo = categoria_equipo.id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_equipo($id){
        $this->db->from('equipos');
        $this->db->where('id', $id);

        return $this->db->get()->row_array();
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

    public function get_equipos_sin_usar($ids_equipos_en_uso){
        $this->db->from('equipos');
        $this->db->where_not_in('equipos.id', $ids_equipos_en_uso);
        $this->db->join('categoria_equipo', 'equipos.id_categoria_equipo = categoria_equipo.id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_equipos_solicitud($id){
        $this->db->from('solicitudes_equipos');
        $this->db->where('id_solicitud =' . $id);
        $this->db->join('equipos', 'equipos.id = solicitudes_equipos.id_equipo');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_amount_equipos_by_categoria($id_categoria_equipo){
        $this->db->from('equipos');
        $this->db->where('id_categoria_equipo', $id_categoria_equipo);

        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function get_equipos_by_categoria($id_categoria_equipo){
        $this->db->from('equipos');
        $this->db->where('id_categoria_equipo', $id_categoria_equipo);

        $query = $this->db->get();
        return $query->result_array();
    }
}