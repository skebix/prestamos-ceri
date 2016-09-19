<?php if($this->session->cedula): ?>
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