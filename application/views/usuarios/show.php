<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 03/04/2016
 * Time: 11:08 AM
 */
?>

<?= $this->session->mensaje; ?><br><br>

<div class="panel panel-default">
    <div class="panel-heading">Lista de Usuarios</div>
    <div class="panel-body">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at cum cumque, cupiditate dignissimos
            dolor earum facere ipsa ipsam laborum officia, perferendis provident qui rem sit tempore unde veritatis? Nam.
        </p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>C&eacute;dula</th>
                <th>Tel&eacute;fono</th>
                <th>Correo electr&oacute;nico</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            {usuarios}
            <tr>
                <th scope="row">{id}</th>
                <td>{primer_nombre} {segundo_nombre}</td>
                <td>{primer_apellido} {segundo_apellido}</td>
                <td><a href="<?= base_url('usuarios/detalles/{cedula}') ?>">{cedula}</a></td>
                <td>{telefono}</td>
                <td>{email}</td>
                <td><a href="<?= base_url('usuarios/eliminar/{cedula}') ?>">Eliminar usuario</a></td>
            </tr>
            {/usuarios}
        </tbody>
    </table>
</div>
<br>
<a class="logout-button" href="<?= base_url('usuarios/registro') ?>">
    <button type="button" class="btn btn-primary">
        Agregar usuario
    </button>
</a>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>