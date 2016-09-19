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
            <th>Nombre del Servicio</th>
            <th>Categor&iacute;a del Servicio</th>
            <th>Habilitado</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
            <th>Habilitar y Deshabilitar</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($servicios as $k => $servicio): ?>
            <tr>
                <th scope="row"><?= $servicio['id'] ?></th>
                <td><?= $servicio['nombre_servicio'] ?></td>
                <td><?= $servicio['categoria'] ?></td>
                <td><?= ($servicio['habilitado'])? 'S&iacute': 'No'; ?></td>
                <td><a href="<?= base_url('servicios/actualizar/' . $servicio['id']) ?>">Actualizar</a></td>
                <td><a href="<?= base_url('servicios/eliminar/' . $servicio['id']) ?>">Eliminar</a></td>
                <?php if($servicio['habilitado']){ ?>
                    <td><a href="<?= base_url('servicios/deshabilitar/' . $servicio['id']) ?>">Deshabilitar</a></td>
                <?php }else{ ?>
                    <td><a href="<?= base_url('servicios/habilitar/' . $servicio['id']) ?>">Habilitar</a></td>
                <?php }; ?>
            </tr>
        <?php endforeach; ?>
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