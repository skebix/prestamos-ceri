<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index(){

		$cedula = $this->session->cedula;

		$data['title'] = 'Inicio';

		if(isset($cedula)){
			$this->session->mensaje = "Bienvenido ";
			$this->parser->parse('templates/header', $data);
			$this->parser->parse('home', $data);
			$this->parser->parse('templates/footer', $data);
		}else{
            //No ha ingresado
			$this->session->mensaje = "Bienvenido usuario anónimo.";
			$this->session->set_flashdata('info', 'Por favor inicie sesión para continuar.');
			$this->parser->parse('templates/header_basic', $data);
			$this->parser->parse('authentication/login_form', $data);
			$this->parser->parse('templates/footer_basic', $data);
		}
	}
}