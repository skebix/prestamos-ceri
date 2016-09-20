<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 10:44 AM
 */
?>


<span class="glyphicon glyphicon-envelope"></span> <?= $this->session->mensaje; ?><br><br>

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
            <th>Solicitante</th>
            <th>Fecha de solicitud</th>
            <th>Fecha de uso</th>
            <th>Habilitado</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
            <th>Habilitar y Deshabilitar</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($solicitudes as $k => $solicitud): ?>
            <tr>
                <th scope="row"><?= $solicitud['id'] ?></th>
                <td><?= $solicitud['primer_nombre'] ?> <?= $solicitud['segundo_nombre'] ?> <?= $solicitud['primer_apellido'] ?> <?= $solicitud['segundo_apellido'] ?></td>
                <td><?= $solicitud['fecha_solicitud'] ?></td>
                <td><?= $solicitud['fecha_uso'] ?></td>
                <td><?= ($solicitud['habilitado'])? 'S&iacute': 'No'; ?></td>
                <td><a href="<?= base_url('solicitudes/actualizar/' . $solicitud['id']) ?>">Actualizar</a></td>
                <td><a href="<?= base_url('solicitudes/eliminar/' . $solicitud['id']) ?>">Eliminar</a></td>
                <?php if($solicitud['habilitado']){ ?>
                    <td><a href="<?= base_url('solicitudes/deshabilitar/' . $solicitud['id']) ?>">Deshabilitar</a></td>
                <?php }else{ ?>
                    <td><a href="<?= base_url('solicitudes/habilitar/' . $solicitud['id']) ?>">Habilitar</a></td>
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
