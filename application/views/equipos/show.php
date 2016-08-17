<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 10:44 AM
 */
?>

<?= $this->session->mensaje; ?><br><br>

<div class="panel panel-default">
    <div class="panel-heading">Lista de Equipos</div>
    <div class="panel-body">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at cum cumque, cupiditate dignissimos
            dolor earum facere ipsa ipsam laborum officia, perferendis provident qui rem sit tempore unde veritatis? Nam.
        </p>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre de Equipo</th>
            <th>Categor&iacute;a de Equipo</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        {equipos}
        <tr>
            <th scope="row">{id}</th>
            <td>{nombre_equipo}</td>
            <td>{categoria}</td>
            <td><a href="<?= base_url('equipos/actualizar/{id}') ?>">Actualizar</a></td>
            <td><a href="<?= base_url('equipos/eliminar/{id}') ?>">Eliminar</a></td>
        </tr>
        {/equipos}
        </tbody>
    </table>
</div>
<a class="logout-button" href="<?= base_url('equipos/crear') ?>">
    <button type="button" class="btn btn-primary">
        Agregar equipo
    </button>
</a>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>