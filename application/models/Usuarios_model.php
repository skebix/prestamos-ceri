<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 31/03/2016
 * Time: 07:59 AM
 */

class Usuarios_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function get_usuarios(){
        $query = $this->db->get('usuarios');
        return $query->result_array();
    }

    public function get_news($slug = FALSE){
        if(!$slug){
            $query = $this->db->get('news');
            return $query->result_array();
        }

        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
    }

    public function set_news(){
        $this->load->helper('url');

        $slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text')
        );

        return $this->db->insert('news', $data);
    }
}