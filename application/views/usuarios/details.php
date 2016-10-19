<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 04/04/2016
 * Time: 10:50 AM
 */
?>
<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('success'); ?></strong>
    </div>
<?php endif;  ?>

<?php if($this->session->flashdata('info')): ?>
    <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('info'); ?></strong>
    </div>
<?php endif;  ?>

<?php if($this->session->flashdata('warning')): ?>
    <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('warning'); ?></strong>
    </div>
<?php endif;  ?>

<?php if($this->session->flashdata('danger')): ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('danger'); ?></strong>
    </div>
<?php endif;  ?>
<br>
<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><strong>{title}</strong></div>
        <div class="panel-body">
            <ul class="list-group">
                <li class="list-group-item">Primer nombre:   <strong>{primer_nombre}</strong></li>
                <li class="list-group-item">Segundo nombre:   <strong>{segundo_nombre}</strong></li>
                <li class="list-group-item">Primer apellido:   <strong>{primer_apellido}</strong></li>
                <li class="list-group-item">Segundo apellido:  <strong>{segundo_apellido}</strong></li>
                <li class="list-group-item">C&eacute;dula:   <strong>{cedula}</strong></li>
                <li class="list-group-item">Tel&eacute;fono:   <strong>{telefono}</strong></li>
                <li class="list-group-item">Correo electr&oacute;nico:   <strong>{email}</strong></li>
                <li class="list-group-item">Correo institucional:   <strong>{correo_institucional}</strong></li>
                <li class="list-group-item">Tipo de usuario:   <strong>{tipo_usuario}</strong></li>
                <li class="list-group-item">Categor&iacute;a:  <strong>{categoria}</strong></li>
                <li class="list-group-item">Facebook:   <strong>{facebook}</strong></li>
                <li class="list-group-item">Instagram:   <strong>{instagram}</strong></li>
                <li class="list-group-item">Twitter:   <strong>{twitter}</strong></li>
            </ul>

            <div class="button pull-left">
                <a class="logout-button btn btn-primary" href="<?= base_url('usuarios/actualizar/{id}') ?>">Editar usuario</a>
            </div>
            <div class="button pull-right">
                <a href="<?= base_url('inicio') ?>">
                    <button type="button" class="btn btn-default">Volver</button>
                </a>
            </div>
        </div>
    </div>
</div>