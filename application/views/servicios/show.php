<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 14/04/2016
 * Time: 03:52 PM
 */
?>

<?= $this->session->mensaje; ?><br><br>

<div class="panel panel-default">
    <div class="panel-heading">Lista de Servicios</div>
    <div class="panel-body">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at cum cumque, cupiditate dignissimos
            dolor earum facere ipsa ipsam laborum officia, perferendis provident qui rem sit tempore unde veritatis? Nam.
        </p>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre de Servicio</th>
            <th>Categor&iacute;a de Servicio</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        {servicios}
        <tr>
            <th scope="row">{id}</th>
            <td>{nombre_servicio}</td>
            <td>{categoria}</td>
            <td><a href="<?= base_url('servicios/actualizar/{id}') ?>">Actualizar</a></td>
            <td><a href="<?= base_url('servicios/eliminar/{id}') ?>">Eliminar</a></td>
        </tr>
        {/servicios}
        </tbody>
    </table>
</div>
<a class="logout-button" href="<?= base_url('servicios/crear') ?>">
    <button type="button" class="btn btn-primary">
        Agregar servicio
    </button>
</a>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>