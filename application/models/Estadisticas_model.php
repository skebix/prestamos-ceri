<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 12/10/2016
 * Time: 8:53
 */


class Estadisticas_model extends CI_Model {


    public function get_solicitudes_by_year_and_month($ano, $mes){
        $this->db->from('solicitudes');
        $this->db->where('year(fecha_uso)=' . $ano . ' and month(fecha_uso)=' . $mes);

        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_solicitudes_espacios_usos(){
        $this->db->from('solicitudes_espacios_usos');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_espacios_solicitud($id){
        $this->db->from('solicitudes_espacios_usos');
        $this->db->where('id_solicitud ='.$id);
        $this->db->join('espacios', 'espacios.id = solicitudes_espacios_usos.id_espacio');

        $query = $this->db->get();
        return $query->result_array();
    }
}