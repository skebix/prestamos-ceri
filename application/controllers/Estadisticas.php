<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Estadisticas extends CI_Controller {

    public function index(){

        $administrador = $this->session->administrador;

        $data['title'] = 'Secci&oacute;n de Estadisticas';
        if($administrador){
            $this->parser->parse('templates/header', $data);
            $this->parser->parse('estadisticas/index', $data);
            $this->parser->parse('templates/footer', $data);
        }else{

            //Si llegué a este punto es porque no ha ingresado, o no es Administrador
            $this->session->set_flashdata('mensaje', 'S&oacute;lo los administradores pueden ver esa secci&oacute;n.');
            redirect('inicio');
        }
    }
    public function ver(){
        $ano = $this->input->post('stats_year');
        $mes = $this->input->post('stats_month');
        if ($mes == '01'){$mes_title='Enero';}
        if ($mes == '02'){$mes_title='Febrero';}
        if ($mes == '03'){$mes_title='Marzo';}
        if ($mes == '04'){$mes_title='Abril';}
        if ($mes == '05'){$mes_title='Mayo';}
        if ($mes == '06'){$mes_title='Junio';}
        if ($mes == '07'){$mes_title='Julio';}
        if ($mes == '08'){$mes_title='Agosto';}
        if ($mes == '09'){$mes_title='Septiembre';}
        if ($mes == '10'){$mes_title='Octubre';}
        if ($mes == '11'){$mes_title='Noviembre';}
        if ($mes == '12'){$mes_title='Diciembre';}
        $data['title'] = 'Estadisticas de '.$mes_title.' de '.$ano.'.';
        // inicio de la consulta de generacion de estadisticas //

        // Consultas de categorias, usuarios y solicitudes existentes //

        $categorias = $this->categoria_model->get_categorias('categoria_usuario');
        $usuarios = $this->db->get('usuarios')->result_array();
        $this->db->select('*');
        $this->db->from('solicitudes');
        $this->db->where('year(fecha_uso)='.$ano.' and month(fecha_uso)='.$mes);
        $solicitudes = $this->db->get()->result_array();

        // Creacion del contenedor de las estadísticas en las variables Sresult y $total //

        $result = array(array("categoria","cantidad","tiempo"));
        $total = array( "cantidad_total" => 0, "tiempo_total" => '0:00');
        $ttt = new DateTime('0:00');
        // Copiado de datos en $result y totales

        $N_categorias = count($categorias);
        $N_solicitudes = count($solicitudes);
        $N_usuarios = count($usuarios);

        //Seccion de llenado de estadisticas por categoria

        for ($x = 0; $x < $N_categorias; $x++)
        {
            $result[$x]['categoria'] = $categorias[$x]['categoria'];
            $result[$x]['cantidad'] = 0;
            $result[$x]['tiempo'] = new DateTime('0:00');
            $n = 0;
            while ($n < $N_solicitudes) //Recorrido del numero de solicitudes
            {
                $m = 0;
                while ($m < $N_usuarios) //Recorrido del numero de usuarios
                {
                    if (($solicitudes[$n]['id_solicitante'] == $usuarios[$m]['id'])
                        and
                        ($usuarios[$m]['id_categoria_usuario'] == $categorias[$x]['id']))
                    {
                        $a = new DateTime($solicitudes[$n]['hora_entrega']);
                        $b = new DateTime($solicitudes[$n]['hora_devolucion']);
                        if ($a == $b and $b == '0:00')
                        {
                            $time = '0:00';
                            $result[$x]['tiempo'] = $time;
                        } else {
                            $time = $a->diff($b);
                            $result[$x]['tiempo']->add($time);
                        }
                        $result[$x]['cantidad']++;
                        $ttt->add($time);
                    }
                    $m++;
                }
                $n++;
            }
            $result[$x]['tiempo'] = $result[$x]['tiempo']->format('H:i');
            $total['cantidad_total'] = $total['cantidad_total'] + $result[$x]['cantidad'];
        }
        $total['tiempo_total'] = $ttt->format('H:i');


        // Seccion de llenado de estadisticas por salas y espacios
        // Inicializacion de las variables requeridas

        $result2 = array(array("espacio","cantidad_prestamo","tiempo_prestamo"));
        $total2 = array( "cantidad_total" => 0, "tiempo_total" => '0:00');
        $espacios = $this->db->get('espacios')->result_array();
        $sols_espacios = $this->db->get('solicitudes_espacios')->result_array();
        $N_espacios = count($espacios);
        $N_sols_espacios = count($sols_espacios);
        $ttt2 = new DateTime('0:00');

        for ($x = 0; $x < $N_espacios; $x++) // inicio de la exploracion por espacio
        {
            $result2[$x]['espacio'] = $espacios[$x]['nombre_espacio'];
            $result2[$x]['cantidad_prestamo'] = 0;
            $result2[$x]['tiempo_prestamo'] = new DateTime('0:00');
            $n = 0;
            while($n < $N_solicitudes)
            {
                $m = 0;
                while($m < $N_sols_espacios)
                {
                    if (($solicitudes[$n]['id'] == $sols_espacios[$m]['id_solicitud'])
                        and ($sols_espacios[$m]['id_espacio'] == $espacios[$x]['id']))
                    {
                        $a = new DateTime($solicitudes[$n]['hora_entrega']);
                        $b = new DateTime($solicitudes[$n]['hora_devolucion']);
                        if ($a == $b and $b == '0:00')
                        {
                            $time = '0:00';
                            $result2[$x]['tiempo_prestamo'] = $time;
                        } else {
                            $time = $a->diff($b);
                            $result2[$x]['tiempo_prestamo']->add($time);
                        }
                        $result2[$x]['cantidad_prestamo']++;
                        $ttt2->add($time);
                    }
                    $m++;
                }
                $n++;
            }
            $result2[$x]['tiempo_prestamo'] = $result2[$x]['tiempo_prestamo']->format('H:i');
            $total2['cantidad_total'] = $total2['cantidad_total'] + $result2[$x]['cantidad_prestamo'];
        }
        $total2['tiempo_total'] = $ttt2->format('H:i');

        // Seccion de llenado de estadisticas de uso de salas
        // Inicializacion de las variables requeridas

        $result3 = array(array("uso_espacio","cantidad_prestamo","tiempo_prestamo"));
        $total3 = array( "cantidad_total" => 0,
            "tiempo_total" => '0:00'
        );
        $usos_espacios = $this->db->get('usos_espacios')->result_array();
        $usos = $this->db->get('usos')->result_array();
        $N_usos_espacios = count($usos_espacios);
        $N_usos = count($usos);
        $ttt3 = new DateTime('0:00');

        for ($x = 0; $x < $N_usos; $x++) // inicio de la exploracion por espacio
        {
            $result3[$x]['uso_espacio'] = $usos[$x]['uso'];
            $result3[$x]['cantidad_prestamo'] = 0;
            $result3[$x]['tiempo_prestamo'] = new DateTime('0:00');
            $n = 0;
            while($n < $N_solicitudes)
            {
                $m = 0;
                while($m < $N_usos_espacios)
                {
                    if (($solicitudes[$n]['id'] == $usos_espacios[$m]['id_solicitud'])
                        and ($usos_espacios[$m]['id_uso'] == $usos[$x]['id']))
                    {
                        $a = new DateTime($solicitudes[$n]['hora_entrega']);
                        $b = new DateTime($solicitudes[$n]['hora_devolucion']);
                        if ($a == $b and $b == '0:00')
                        {
                            $time = '0:00';
                            $result3[$x]['tiempo_prestamo'] = $time;
                        } else {
                            $time = $a->diff($b);
                            $result3[$x]['tiempo_prestamo']->add($time);
                        }
                        $result3[$x]['cantidad_prestamo']++;
                        $ttt3->add($time);
                    }
                    $m++;
                }
                $n++;
            }
            $result3[$x]['tiempo_prestamo'] = $result3[$x]['tiempo_prestamo']->format('H:i'); //Conversion de hora a string
            $total3['cantidad_total'] = $total3['cantidad_total'] + $result3[$x]['cantidad_prestamo']; //Adicion de cantidad total
        }
        $total3['tiempo_total'] = $ttt3->format('H:i');

        // Seccion de llenado de estadisticas de equipos usados
        // Inicializacion de las variables requeridas

        $result4 = array(array("equipos","cantidad_prestamo","tiempo_prestamo"));
        $total4 = array( "cantidad_total" => 0,
            "tiempo_total" => '0:00'
        );
        $equipos = $this->db->get('equipos')->result_array();
        $sols_equipos = $this->db->get('solicitudes_equipos')->result_array();
        $N_equipos = count($equipos);
        $N_sols_equipos = count($sols_equipos);
        $ttt4 = new DateTime('0:00');

        for ($x = 0; $x < $N_equipos; $x++) // inicio de la exploracion por espacio
        {
            $result4[$x]['equipos'] = $equipos[$x]['nombre_equipo'];
            $result4[$x]['cantidad_prestamo'] = 0;
            $result4[$x]['tiempo_prestamo'] = new DateTime('0:00');
            $n = 0;
            while($n < $N_solicitudes)
            {
                $m = 0;
                while($m < $N_sols_equipos)
                {
                    if (($solicitudes[$n]['id'] == $sols_equipos[$m]['id_solicitud'])
                        and ($sols_equipos[$m]['id_equipo'] == $equipos[$x]['id']))
                    {
                        $a = new DateTime($solicitudes[$n]['hora_entrega']);
                        $b = new DateTime($solicitudes[$n]['hora_devolucion']);
                        if ($a == $b and $b == '0:00')
                        {
                            $time = '0:00';
                            $result4[$x]['tiempo_prestamo'] = $time;
                        } else {
                            $time = $a->diff($b);
                            $result4[$x]['tiempo_prestamo']->add($time);
                        }
                        $result4[$x]['cantidad_prestamo']++;
                        $ttt4->add($time);
                    }
                    $m++;
                }
                $n++;
            }
            $result4[$x]['tiempo_prestamo'] = $result4[$x]['tiempo_prestamo']->format('H:i'); //Conversion de hora a string
            $total4['cantidad_total'] = $total4['cantidad_total'] + $result4[$x]['cantidad_prestamo']; //Adicion de cantidad total
        }
        $total4['tiempo_total'] = $ttt4->format('H:i');

        /* ENTREGA DE TODOS LOS RESULTADOS A LA VARIABLE $DATA */
        $data['category_stats'] = $result;
        $data['materials_stats'] = $result2;
        $data['use_stats'] = $result3;
        $data['stuff_stats'] = $result4;
        $data['summary'] = $total; //Totales por categorias
        $data['summary2'] = $total2; //Totales por salas y espacios
        $data['summary3'] = $total3; //Totales por usos de espacios
        $data['summary4'] = $total4; //Totales por usos de equipos
        $this->parser->parse('templates/header', $data);
        $this->parser->parse('estadisticas/show', $data);
        $this->parser->parse('templates/footer', $data);


    }
}