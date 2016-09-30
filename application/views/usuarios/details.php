<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 04/04/2016
 * Time: 10:50 AM
 */
?>

<ul class="list-group">
    <li class="list-group-item">ID Base de datos:   <strong>{id}</strong></li>
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

<a class="logout-button btn btn-success" href="<?= base_url('usuarios/actualizar/{id}') ?>">Editar usuario</a>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>