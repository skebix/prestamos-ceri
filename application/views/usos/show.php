<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 10:54 AM
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
            <th>Nombre uso</th>
            <th>Otro uso?</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($usos as $uso): ?>
            <tr>
                <th scope="row"><?= $uso['id'] ?></th>
                <td><?= $uso['uso'] ?></td>
                <td><?= ($uso['otro_uso'])? "S&iacute;": "No"; ?></td>
                <td><a href="<?= base_url('usos/actualizar/' . $uso['id']) ?>">Actualizar uso</a></td>
                <td><a href="<?= base_url('usos/eliminar/' . $uso['id']) ?>">Eliminar uso</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<br>
<a class="logout-button" href="<?= base_url('usos/crear') ?>">
    <button type="button" class="btn btn-primary">
        Agregar uso
    </button>
</a>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>