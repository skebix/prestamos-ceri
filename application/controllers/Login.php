<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 31/03/2016
 * Time: 09:30 AM
 */

class Login extends CI_Controller {

    function index(){
        $data['title'] = 'Ingreso a prestamos-ceri';

        $this->load->view('templates/header');
        $this->load->view('templates/login/login_form', $data);
        $this->load->view('templates/footer');
    }

}