<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index(){

        $data['title'] = 'Inicio';

		$this->parser->parse('templates/header', $data);
        $this->load->view('home');
		$this->load->view('templates/footer');
	}
}