<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Estadisticas extends CI_Controller {

    public function index(){
        //Lo primero es ver si es Administrador, no?
        $administrador = $this->session->administrador;


        if($administrador){


            $data['title'] = 'Estadisticas';
            // inicio de la consulta de generacion de estadisticas //

            // Consultas de categorias, usuarios y solicitudes existentes //

            $categorias = $this->categoria_model->get_categorias('categoria_usuario');
            $usuarios = $this->db->get('usuarios')->result_array();
            $solicitudes = $this->db->get('solicitudes')->result_array();

            // Creacion del contenedor de las estadísticas en las variables Sresult y $total //

            $result = array(array("categoria","cantidad","tiempo"));
            $total = array( "cantidad_total" => 0,
                            "tiempo_total" => '0:00'
                            );
            $ttt = new DateTime('0:00');
            // Copiado de datos en $result y totales

            $N_categorias = count($categorias);
            $N_solicitudes = count($solicitudes);
            $N_usuarios = count($usuarios);
            for ($x = 0; $x < $N_categorias; $x++)
            {
                $result[$x]['categoria'] = $categorias[$x]['categoria'];
                $result[$x]['cantidad'] = 0;
                $result[$x]['tiempo'] = new DateTime('0:00');
                $n = 0;
                while ($n < $N_solicitudes)
                {
                    $m = 0;
                    while ($m < $N_usuarios)
                    {
                        if (($solicitudes[$n]['id_reservado'] == $usuarios[$m]['id'])
                            and ($usuarios[$m]['id_categoria_usuario'] == $categorias[$x]['id']))
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
            $data['category_stats'] = $result;
            $data['summary'] = $total;
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