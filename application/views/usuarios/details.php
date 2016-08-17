<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 04/04/2016
 * Time: 10:50 AM
 */
?>

<ul>
    <li>ID Base de datos: {id}</li>
    <li>Primer nombre: {primer_nombre}</li>
    <li>Segundo nombre: {segundo_nombre}</li>
    <li>Primer apellido {primer_apellido}</li>
    <li>Segundo apellido: {segundo_apellido}</li>
    <li>C&eacute;dula: {cedula}</li>
    <li>Tel&eacute;fono: {telefono}</li>
    <li>Correo electr&oacute;nico: {email}</li>
    <li>Correo institucional: {correo_institucional}</li>
    <li>Contrase&ntilde;a hasheada: {hashed_password}</li>
    <li>Tipo de usuario: {tipo_usuario}</li>
    <li>Categor&iacute;a: {categoria}</li>
    <li>Facebook: {facebook}</li>
    <li>Instagram: {instagram}</li>
    <li>Twitter: {twitter}</li>
</ul>

<a class="logout-button btn btn-success" href="<?= base_url('usuarios/actualizar/{id}') ?>">Editar usuario</a>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>