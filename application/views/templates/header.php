<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>{title}</title>

        <!-- Bootstrap -->
        <link href="<?= assets_url(); ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" rel="stylesheet">
        <link href="<?= css_url(); ?>bootstrap-datetimepicker-build.css" rel="stylesheet">
        <!-- DataTables CSS -->
        <link href="<?= assets_url(); ?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="<?= assets_url(); ?>bower_components/datatables-responsive/css/responsive.dataTables.scss" rel="stylesheet">
        <!-- Google Hosted Fonts and homemade styles -->
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- MetisMenu CSS -->
        <link href="<?= assets_url(); ?>bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="<?= assets_url(); ?>dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= assets_url(); ?>dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="<?= assets_url(); ?>css/style.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="<?= assets_url(); ?>bower_components/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?= assets_url(); ?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <!-- Navigation -->
    <div id="wrapper">

        <!-- Navigation -->
        <div class="text-center">
            <img src="<?= assets_url(); ?>img/banner.png">
        </div>
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Iniciar navegaci&oacute;n</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url('inicio') ?>">CERI-PRES</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right"> <!-- Messages-top-bar -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <?php $cedula = $this->session->cedula;
                                if (isset($cedula)):
                                ?>
                                    <div>
                                        <?= $this->session->mensaje; ?>
                                        <strong><?= $this->session->primer_nombre;?></strong>
                                        <strong><?= $this->session->primer_apellido;?></strong>,
                                        recuerda cerrar sesi&oacute;n al terminar.
                                    </div>
                                <?php else:?>
                                    <div>
                                        <?= $this->session->mensaje; ?>
                                        Puedes registrarte o consultar fechas disponibles para reservas aqu&iacute;.
                                    </div>
                                <?php endif;?>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <?php $id = $this->session->id;
                        $cedula = $this->session->cedula;
                        if (isset($cedula)):
                            ?>
                            <li><a href="<?= base_url('usuarios/detalles/'.$cedula) ?>"><i class="fa fa-user fa-fw"></i> Perfil de usuario</a>
                            </li>
                            <li><a href="<?= base_url('usuarios/actualizar/'.$id) ?>"><i class="fa fa-gear fa-fw"></i> Configuraci&oacuten</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?= base_url('autenticacion/salir') ?>"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                            </li>
                        <?php else: ?>
                            <li><a href="<?= base_url('autenticacion') ?>"><i class="fa fa-sign-in fa-fw"></i> Iniciar sesión</a>
                            </li>
                        <?php endif;?>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php $administrador = $this->session->administrador;
                        if ($administrador):
                            ?>
                            <li>
                                <a href="<?= base_url('') ?>"><i class="fa fa-dashboard fa-fw"></i> Panel de Control</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-calendar fa-fw"></i> Solicitudes<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?= base_url('solicitudes/crear') ?>"><i class="fa fa-edit fa-fw"></i> Crear</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('solicitudes/listar') ?>"><i class="fa fa-th-list fa-fw"></i> Listar</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('solicitudes/recibir') ?>"><span class="glyphicon glyphicon-erase"></span> Recepción de préstamos</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="<?= base_url('usuarios/listar') ?>"><span class="glyphicon glyphicon-user"></span> Usuarios<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?= base_url('usuarios/registro') ?>"><i class="fa fa-edit fa-fw"></i> Agregar</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('usuarios/listar') ?>"><i class="fa fa-th-list fa-fw"></i> Listar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="<?= base_url('categorias-usuario/listar') ?>"><span class="glyphicon glyphicon-list-alt"></span> Categor&iacute;as de Usuario<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?= base_url('categorias-usuario/crear') ?>"><i class="fa fa-edit fa-fw"></i> Agregar</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('categorias-usuario/listar') ?>"><i class="fa fa-th-list fa-fw"></i> Listar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="<?= base_url('categorias-equipo/listar') ?>"><span class="glyphicon glyphicon-print"></span> Categor&iacute;as de Equipos<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?= base_url('categorias-equipo/crear') ?>"><i class="fa fa-edit fa-fw"></i> Agregar</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('categorias-equipo/listar') ?>"><i class="fa fa-th-list fa-fw"></i> Listar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="<?= base_url('categorias-servicio/listar') ?>"><span class="glyphicon glyphicon-briefcase"></span> Categor&iacute;as de Servicios<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?= base_url('categorias-servicio/crear') ?>"><i class="fa fa-edit fa-fw"></i> Agregar</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('categorias-servicio/listar') ?>"><i class="fa fa-th-list fa-fw"></i> Listar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="<?= base_url('equipos/listar') ?>"><i class="fa fa-laptop fa-fw"></i> Equipos<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?= base_url('equipos/crear') ?>"><i class="fa fa-edit fa-fw"></i> Agregar</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('equipos/listar') ?>"><i class="fa fa-th-list fa-fw"></i> Listar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="<?= base_url('servicios/listar') ?>"><i class="fa fa-angellist fa-fw"></i> Servicios<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?= base_url('servicios/crear') ?>"><i class="fa fa-edit fa-fw"></i> Agregar</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('servicios/listar') ?>"><i class="fa fa-th-list fa-fw"></i> Listar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="<?= base_url('espacios/listar') ?>"><i class="fa fa-bank fa-fw"></i> Espacios<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?= base_url('espacios/crear') ?>"><i class="fa fa-edit fa-fw"></i> Agregar</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('espacios/listar') ?>"><i class="fa fa-th-list fa-fw"></i> Listar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="<?= base_url('usos/listar') ?>"><i class="fa fa-gamepad fa-fw"></i> Usos<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?= base_url('usos/crear') ?>"><i class="fa fa-edit fa-fw"></i> Agregar</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('usos/listar') ?>"><i class="fa fa-th-list fa-fw"></i> Listar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="<?= base_url('estadisticas') ?>"><i class="fa fa-bar-chart fa-fw"></i> Estad&iacutesticas generales</a>
                            </li>
                        <?php elseif(isset($cedula)): ?>
                            <li>
                                <a href="<?= base_url('consultas/consultar') ?>"><i class="fa fa-columns fa-fw"></i> Consultar fechas disponibles</a>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?= base_url('usuarios/registro') ?>"><i class="fa fa-user fa-fw"></i> Registrarse</a>
                            </li>
                            <li>
                                <a href="<?= base_url('consultas/consultar') ?>"><i class="fa fa-columns fa-fw"></i> Consultar fechas disponibles</a>
                            </li>
                        <?php endif;?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <br>
            <!-- /.row -->
            <div class="row">