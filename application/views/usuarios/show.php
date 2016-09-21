<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 03/04/2016
 * Time: 11:08 AM
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
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>C&eacute;dula</th>
            <th>Tel&eacute;fono</th>
            <th>Correo electr&oacute;nico</th>
            <th>Habilitado</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
            <th>Habilitar y Deshabilitar</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($usuarios as $k => $usuario): ?>
            <tr>
                <th scope="row"><?= $usuario['id'] ?></th>
                <td><?= $usuario['primer_nombre'] ?> <?= $usuario['segundo_nombre'] ?></td>
                <td><?= $usuario['primer_apellido'] ?> <?= $usuario['segundo_apellido'] ?></td>
                <td><a href="<?= base_url('usuarios/detalles/' . $usuario['cedula']) ?>"><?= $usuario['cedula'] ?></a></td>
                <td><?= $usuario['telefono'] ?></td>
                <td><?= $usuario['email'] ?></td>
                <td><?= ($usuario['habilitado'])? 'S&iacute': 'No'; ?></td>
                <td><a href="<?= base_url('usuarios/actualizar/' . $usuario['id']) ?>">Actualizar</a></td>
                <td><a href="<?= base_url('usuarios/eliminar/' . $usuario['id']) ?>">Eliminar</a></td>
                <?php if($usuario['habilitado']){ ?>
                    <td><a href="<?= base_url('usuarios/deshabilitar/' . $usuario['id']) ?>">Deshabilitar</a></td>
                <?php }else{ ?>
                    <td><a href="<?= base_url('usuarios/habilitar/' . $usuario['id']) ?>">Habilitar</a></td>
                <?php }; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
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