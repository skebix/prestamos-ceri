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
            <th>Habilitar y Deshabilitar</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($equipos as $k => $equipo): ?>
        <tr>
            <th scope="row"><?= $equipo['id'] ?></th>
            <td><?= $equipo['nombre_equipo'] ?></td>
            <td><?= $equipo['categoria'] ?></td>
            <td><a href="<?= base_url('equipos/actualizar/' . $equipo['id']) ?>">Actualizar</a></td>
            <td><a href="<?= base_url('equipos/eliminar/' . $equipo['id']) ?>">Eliminar</a></td>
            <?php if($equipo['habilitado']){ ?>
                <td><a href="<?= base_url('equipos/deshabilitar/' . $equipo['id']) ?>">Deshabilitar</a></td>
            <?php }else{ ?>
                <td><a href="<?= base_url('equipos/habilitar/' . $equipo['id']) ?>">Habilitar</a></td>
            <?php }; ?>
        </tr>
        <?php endforeach; ?>
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