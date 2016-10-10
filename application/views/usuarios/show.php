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
    <div class="panel-heading text-center"><strong>{title}</strong></div>
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="datatable">
                <thead>
                <tr>
                    <th class="text-center">C&eacute;dula</th>
                    <th class="text-center">Nombres</th>
                    <th class="text-center">Apellidos</th>
                    <th class="text-center">Correo electr&oacute;nico</th>
                    <th class="text-center">Habilitado</th>
                    <th class="text-center">Ver detalles</th>
                    <th class="text-center">Modificar</th>
                    <th class="text-center">Eliminar</th>
                    <th class="text-center">Habilitar / Deshabilitar</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($usuarios as $k => $usuario): ?>
                    <tr>
                        <th class="text-center"><?= $usuario['cedula'] ?></th>
                        <td class="text-center"><?= $usuario['primer_nombre'] ?> <?= $usuario['segundo_nombre'] ?></td>
                        <td class="text-center"><?= $usuario['primer_apellido'] ?> <?= $usuario['segundo_apellido'] ?></td>
                        <td class="text-center"><?= $usuario['email'] ?></td>
                        <td class="text-center"><?= ($usuario['habilitado'])? 'S&iacute': 'No'; ?></td>
                        <td class="text-center"><a href="<?= base_url('usuarios/detalles/' . $usuario['cedula']) ?>"><i class="fa fa-file-text fa-2x"></i></a></td>
                        <td class="text-center"><a href="<?= base_url('usuarios/actualizar/' . $usuario['id']) ?>"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
                        <td class="text-center"><a href="<?= base_url('usuarios/eliminar/' . $usuario['id']) ?>"><i class="fa fa-times fa-2x"></i></a></td>
                        <?php if($usuario['habilitado']){ ?>
                            <td class="text-center"><a href="<?= base_url('usuarios/deshabilitar/' . $usuario['id']) ?>"><i class="fa fa-lock fa-2x"></i></a></td>
                        <?php }else{ ?>
                            <td class="text-center"><a href="<?= base_url('usuarios/habilitar/' . $usuario['id']) ?>"><i class="fa fa-unlock fa-2x"></i></a></td>
                        <?php }; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <br>
        <label>
            <a class="logout-button" href="<?= base_url('usuarios/registro') ?>">
                <button type="button" class="btn btn-default">
                    <strong>Agregar usuario</strong>
                </button>
            </a>
            <a class="logout-button" href="<?= base_url() ?>">
                <button type="button" class="btn btn-primary">
                    <strong>Volver al inicio</strong>
                </button>
            </a>
        </label>
    </div>
</div>