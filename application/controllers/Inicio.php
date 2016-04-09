<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index(){

        $data['title'] = 'Inicio';

		$this->parser->parse('templates/header', $data);
        $this->parser->parse('home', $data);
		$this->parser->parse('templates/footer', $data);
	}
}