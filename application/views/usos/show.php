<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 10:54 AM
 */
?>

<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('success'); ?></strong>
    </div>
<?php endif;  ?>

<?php if($this->session->flashdata('info')): ?>
    <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('info'); ?></strong>
    </div>
<?php endif;  ?>

<?php if($this->session->flashdata('warning')): ?>
    <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('warning'); ?></strong>
    </div>
<?php endif;  ?>

<?php if($this->session->flashdata('danger')): ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('danger'); ?></strong>
    </div>
<?php endif;  ?>
<br>

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
            <th>Habilitado</th>
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
                <td><?= ($uso['habilitado'])? "S&iacute;": "No"; ?></td>
                <td><a href="<?= base_url('usos/actualizar/' . $uso['id']) ?>">Actualizar uso</a></td>
                <td><a href="<?= base_url('usos/eliminar/' . $uso['id']) ?>">Eliminar uso</a></td>
                <?php if($uso['habilitado']){ ?>
                    <td><a href="<?= base_url('usos/deshabilitar/' . $uso['id']) ?>">Deshabilitar</a></td>
                <?php }else{ ?>
                    <td><a href="<?= base_url('usos/habilitar/' . $uso['id']) ?>">Habilitar</a></td>
                <?php }; ?>
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