<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index(){

		$administrador = $this->session->administrador;

		$data['title'] = 'Inicio';

		if($administrador){
			$this->parser->parse('templates/header', $data);
			$this->parser->parse('home', $data);
			$this->parser->parse('templates/footer', $data);
		}else{
			//No ha ingresado
			$this->session->set_flashdata('info', 'Por favor inicie sesión para continuar'); // Si cambias info por success, warning o danger, cambia el color del cuadro.

			$this->parser->parse('templates/header_basic', $data);
			$this->parser->parse('authentication/login_form', $data);
			$this->parser->parse('templates/footer_basic', $data);
		}
	}
}