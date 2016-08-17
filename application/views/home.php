<span class="glyphicon glyphicon-envelope"></span> <?= $this->session->mensaje; ?>
<br><br>

<?php if($this->session->cedula): ?>
    <div class="alert alert-dismissible alert-success" ><strong>Bienvenido,</strong> <?= $this->session->primer_nombre . ' ' . $this->session->primer_apellido; ?>
    </div>
    <br>
    <?php if($this->session->administrador):?>
        <div class="btn-group-vertical">
            <a href="<?= base_url('categorias-usuario/listar') ?>" class="btn btn-default"><span class="glyphicon glyphicon-list-alt"></span> Categor&iacute;as de Usuario</a>
            <a href="<?= base_url('categorias-equipo/listar') ?>" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> Categor&iacute;as de Equipos</a>
            <a href="<?= base_url('categorias-servicio/listar') ?>" class="btn btn-default"><span class="glyphicon glyphicon-briefcase"></span> Categor&iacute;as de Servicios</a>
            <a href="<?= base_url('usuarios/listar') ?>" class="btn btn-default"><span class="glyphicon glyphicon-user"></span> Usuarios</a>
            <a href="<?= base_url('equipos/listar') ?>" class="btn btn-default"><span class="glyphicon glyphicon-cd"></span> Equipos</a>
            <a href="<?= base_url('servicios/listar') ?>" class="btn btn-default"><span class="glyphicon glyphicon-blackboard"></span> Servicios</a>
            <a href="<?= base_url('espacios/listar') ?>" class="btn btn-default"><span class="glyphicon glyphicon-calendar"></span> Espacios</a>
            <a href="<?= base_url('usos/listar') ?>" class="btn btn-default"><span class="glyphicon glyphicon-wrench"></span> Usos</a>
            <li><a href="<?= base_url('solicitudes/listar') ?>">Usos</a></li>
            <a href="<?= base_url('estadisticas') ?>" class="btn btn-default"><span class="glyphicon glyphicon-equalizer"></span> Estad&iacutesticas de uso</a>
        </div>
    <?php endif; ?>
    <br><br>
    <a class="logout-button" href="<?= base_url('autenticacion/salir') ?>">
        <button type="button" class="btn btn-success">
            Cerrar sesi&oacute;n
        </button>
    </a>
<?php else: ?>
    <a class="login-button" href="<?= base_url('autenticacion') ?>">
        <button type="button" class="btn btn-primary">
            Ingresar
        </button>
    </a>
    <br><br>
    <a class="login-button" href="<?= base_url('usuarios/registro') ?>">
        <button type="button" class="btn btn-primary">
            Registrarse
        </button>
    </a>
<?php endif; ?>