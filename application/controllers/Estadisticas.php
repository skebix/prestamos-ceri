<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Estadisticas extends CI_Controller {

    public function index(){
        //Lo primero es ver si es Administrador, no?
        $administrador = $this->session->administrador;


        if($administrador){


            $data['title'] = 'Estadisticas';
            $table = 'categoria_usuario';
            $categorias_usuario = $this->categoria_model->get_categorias($table);
            $data['categorias_usuario'] = $categorias_usuario;
            $this->parser->parse('templates/header', $data);
            $this->parser->parse('estadisticas/show', $data);
            $this->parser->parse('templates/footer', $data);

        }else{

            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }
}