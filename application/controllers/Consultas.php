<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/09/2016
 * Time: 15:03
 */
class Consultas extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->consultar();
    }

    public function consultar(){

        $data['title'] = 'Consultar disponibilidad';

        $this->form_validation->set_rules('fecha_uso', 'fecha de uso', 'required|callback__formato_fecha');
        $this->form_validation->set_rules('hora_entrega', 'hora de entrega', 'required|callback__formato_hora');
        $this->form_validation->set_rules('hora_devolucion', 'hora de devoluci&oacute;n', 'required|callback__formato_hora');

        if (!$this->form_validation->run()){

            //Si no pasa las reglas de validación, mostramos el formulario
            $this->parser->parse('templates/header', $data);
            $this->parser->parse('consultas/query', $data);
            $this->parser->parse('templates/footer', $data);
        }else{
            $fecha_uso = $this->input->post('fecha_uso');
            $hora_entrega = $this->input->post('hora_entrega');
            $hora_devolucion = $this->input->post('hora_devolucion');

            $fecha_uso = DateTime::createFromFormat('d/m/Y', $fecha_uso);
            $hora_entrega = DateTime::createFromFormat('h:i A', $hora_entrega);
            $hora_devolucion = DateTime::createFromFormat('h:i A', $hora_devolucion);

            $fecha_uso = $fecha_uso->format('Y-m-d');

            $solicitudes = $this->solicitudes_model->get_solicitudes_by_date('solicitudes', $fecha_uso);

            $ids_equipos_en_uso = array();
            $ids_espacios_en_uso = array();

            foreach ($solicitudes as $i => $solicitud){
                //start1 <= end2 and start2 <= end1 to see if they intersect
                $inicio_solicitud = DateTime::createFromFormat('H:i:s', $solicitud['hora_entrega']);
                $fin_solicitud = DateTime::createFromFormat('H:i:s', $solicitud['hora_devolucion']);
                if($hora_entrega <= $fin_solicitud and $inicio_solicitud <= $hora_devolucion){
                    $equipos = $this->solicitudes_model->get_equipos_by_solicitud('solicitudes_equipos', $solicitud['id']);
                    $espacios = $this->solicitudes_model->get_espacios_by_solicitud('solicitudes_espacios_usos', $solicitud['id']);

                    foreach ($equipos as $j => $equipo){
                        $ids_equipos_en_uso[] = $equipo['id_equipo'];
                    }

                    foreach ($espacios as $j => $espacio){
                        $ids_espacios_en_uso[] = $espacio['id_espacio'];
                    }
                }
            }

            if(empty($ids_equipos_en_uso)){
                $ids_equipos_en_uso[] = '0';
            }

            $otro_espacio = $this->espacios_model->get_espacio_by_name('espacios', 'Otro (especifique)');
            $ids_espacios_en_uso[] = $otro_espacio['id'];

            $ids_equipos_en_uso = array_unique($ids_equipos_en_uso);
            $ids_espacios_en_uso = array_unique($ids_espacios_en_uso);

            $equipos_disponibles = $this->equipos_model->get_equipos_sin_usar($ids_equipos_en_uso);
            $espacios_disponibles = $this->espacios_model->get_espacios_sin_usar($ids_espacios_en_uso);

            $data['equipos'] = $equipos_disponibles;
            $data['espacios'] = $espacios_disponibles;

            $this->parser->parse('templates/header', $data);
            $this->parser->parse('consultas/available', $data);
            $this->parser->parse('templates/footer', $data);
        }
    }

    public function _formato_fecha($str){
        $this->form_validation->set_message('_formato_fecha', 'El campo {field} no contiene una fecha en el formato DD/MM/AAAA.');

        return DateTime::createFromFormat('d/m/Y', $str)? true: false;
    }

    public function _formato_hora($str){
        $this->form_validation->set_message('_formato_hora', 'El campo {field} no contiene una hora en el formato HH:MM AM.');

        return DateTime::createFromFormat('h:i A', $str)? true: false;
    }
}

