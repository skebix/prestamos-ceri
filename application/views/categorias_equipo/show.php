<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 08/04/2016
 * Time: 09:57 AM
 */
?>

<div class="panel panel-default">
    <div class="panel-heading">{title}</div>
    <div class="panel-body">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at cum cumque, cupiditate dignissimos
            dolor earum facere ipsa ipsam laborum officia, perferendis provident qui rem sit tempore unde veritatis? Nam.
        </p>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Categor&iacute;a de equipo</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        {categorias}
        <tr>
            <th scope="row">{id}</th>
            <td>{categoria}</td>
            <td><a href="<?= base_url('categorias-equipo/actualizar/{id}') ?>">Actualizar categor&iacute;a</a></td>
            <td><a href="<?= base_url('categorias-equipo/eliminar/{id}') ?>">Eliminar categor&iacute;a</a></td>
        </tr>
        {/categorias}
        </tbody>
    </table>
</div>
<br>
<a class="logout-button" href="<?= base_url('categorias-equipo/crear') ?>">
    <button type="button" class="btn btn-primary">
        Agregar categor&iacute;a
    </button>
</a>