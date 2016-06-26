<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 19/04/16
 * Time: 10:54 PM
 */

class Solicitudes extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        echo "Fase de pruebas de solicitudes: crear / actualizar/ borrar";
    }

    function crear(){

        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Nueva solicitud';

            $this->form_validation->set_rules('date', 'Fecha de uso', 'required');

            if(!$this->form_validation->run()){

                //Si no pasa las reglas de validación, mostramos el formulario
                $this->parser->parse('templates/header', $data);
                $this->parser->parse('solicitudes/create', $data);
                $this->parser->parse('templates/footer', $data);
            }else{
                //Si los datos tienen el formato correcto, debo registrar la nueva categoría en la BD
                $datos['fecha_uso'] = $this->input->post('date');


                $insert_id = $this->db->insert('solicitudes', $datos);


                $datos['id_categoria_equipo'] = $this->input->post('id_categoria_equipo');
                $datos['nombre_equipo'] = $this->input->post('nombre_equipo');

                $table = 'equipos';
                $was_inserted = $this->equipos_model->create_equipo($table, $datos);

                //Si lo guardó correctamente, redirigir al inicio con éxito
                if($was_inserted){
                    $this->session->set_userdata('mensaje', 'El equipo fue a&ntilde;adido satisfactoriamente.');
                    redirect('equipos/listar');
                }

                //Si llegué a este punto es porque no pudo guardar el equipo
                $this->session->set_userdata('mensaje', 'No se pudo agregar el equipo, por favor intente nuevamente.');
                redirect('equipos/listar');
            }
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }
    function borrar($id){

        //Comprobacion de que el usuario sea un administrador
        $administrador = $this->session->administrador;
        if($administrador){

            $data['title'] = 'Borrado de solicitudes';
            $table = 'solicitudes';
            $delete_id = $this->db->select($table . $id);
            $equipos = $this->equipos_model->get_equipos($table);
            $data['equipos'] = $equipos;

            $this->parser->parse('templates/header', $data);
            $this->parser->parse('equipos/show', $data);
            $this->parser->parse('templates/footer', $data);
        }else{
            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_userdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }
}