<button type="button" class="btn btn-danger">
    <a class="logout-button" href="<?= base_url('autenticacion/salir') ?>">Cerrar sesi&oacute;n</a>
</button>

<br><br><br><br><br>

<?php if($this->session->cedula): ?>
    Bienvenido, <?= $this->session->primer_nombre . ' ' . $this->session->primer_apellido; ?>
<?php endif; ?>