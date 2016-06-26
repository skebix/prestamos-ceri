<span class="glyphicon glyphicon-envelope"></span> <?= $this->session->mensaje; ?>
<br><br>

<?php if($this->session->cedula): ?>
    <div class="alert alert-dismissible alert-success" ><strong>Bienvenido,</strong> <?= $this->session->primer_nombre . ' ' . $this->session->primer_apellido; ?>
    </div>
    <br><br>
    <?php if($this->session->administrador): ?>
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">Links de administraci&oacute;n:</li>
                <li><a href="<?= base_url('categorias-usuario/listar') ?>">Categor&iacute;as de Usuario</a></li>
                <li><a href="<?= base_url('categorias-equipo/listar') ?>">Categor&iacute;as de Equipos</a></li>
                <li><a href="<?= base_url('categorias-servicio/listar') ?>">Categor&iacute;as de Servicios</a></li>
                <li><a href="<?= base_url('usuarios/listar') ?>">Usuarios</a></li>
                <li><a href="<?= base_url('equipos/listar') ?>">Equipos</a></li>
                <li><a href="<?= base_url('servicios/listar') ?>">Servicios</a></li>
                <li><a href="<?= base_url('espacios/listar') ?>">Espacios</a></li>
                <li><a href="<?= base_url('usos/listar') ?>">Usos</a></li>
            </ul>
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