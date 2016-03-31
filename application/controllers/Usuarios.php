<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 31/03/2016
 * Time: 07:45 AM
 */

class Usuarios extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('usuarios_model');
        $this->load->helper('url_helper');
        $this->load->helper('text');
    }

    public function index(){
        echo "Por diseñar";

    }

    public function mostrar($cedula = NULL){

        //Vamos a la BD con la cédula que recibimos como parámetro
        $usuario = $this->usuarios_model->get_usuario($cedula);
        if($usuario){

        }
    }

    public function registro(){

    }
}