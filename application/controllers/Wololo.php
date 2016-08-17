<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 26/06/16
 * Time: 01:34 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Wololo extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    // Show view Page
    public function index(){
        $this->load->view("ajax_post_view");
    }

    // This function call from AJAX
    public function user_data_submit() {
        $data = array(
            'username' => $this->input->post('name'),
            'pwd'=>$this->input->post('pwd')
        );

        //Either you can print value or you can send value to database
        echo json_encode($data);
    }
}