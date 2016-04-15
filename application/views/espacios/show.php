<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 08:25 AM
 */
?>

<?= $this->session->mensaje; ?><br><br>

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
            <th>Nombre espacio</th>
            <th>Otro espacio?</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        {espacios}
        <tr>
            <th scope="row">{id}</th>
            <td>{nombre_espacio}</td>
            <td><?= ('{otro_espacio}')? "Sí": "No"; ?></td>
            <td><a href="<?= base_url('espacios/actualizar/{id}') ?>">Actualizar espacio</a></td>
            <td><a href="<?= base_url('espacios/eliminar/{id}') ?>">Eliminar espacio</a></td>
        </tr>
        {/espacios}
        </tbody>
    </table>
</div>
<br>
<a class="logout-button" href="<?= base_url('espacios/crear') ?>">
    <button type="button" class="btn btn-primary">
        Agregar espacio
    </button>
</a>