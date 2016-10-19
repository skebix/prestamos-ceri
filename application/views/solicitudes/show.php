<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 10:44 AM
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
                    <th class="text-center">#</th>
                    <th class="text-center">Solicitante</th>
                    <th class="text-center">Fecha de solicitud</th>
                    <th class="text-center">Fecha de uso</th>
                    <th class="text-center">Habilitado</th>
                    <th class="text-center">Ver detalles</th>
                    <th class="text-center">Modificar</th>
                    <th class="text-center">Eliminar</th>
                    <th class="text-center">Habilitar / Deshabilitar</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($solicitudes as $k => $solicitud): ?>
                    <tr>
                        <th scope="row" class="text-center"><?= $solicitud['id'] ?></th>
                        <td class="text-center"><?= $solicitud['primer_nombre'] ?> <?= $solicitud['primer_apellido'] ?> </td>
                        <td class="text-center"><?= $solicitud['fecha_solicitud'] ?></td>
                        <td class="text-center"><?= $solicitud['fecha_uso'] ?></td>
                        <td class="text-center"><?= ($solicitud['habilitado'])? 'S&iacute': 'No'; ?></td>
                        <td class="text-center"><a href="<?= base_url('solicitudes/detalles/' . $solicitud['id']) ?>"><i class="fa fa-file-text fa-2x"></i></a></td>
                        <td class="text-center"><a href="<?= base_url('solicitudes/actualizar/' . $solicitud['id']) ?>"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
                        <td class="text-center"><a class="confirmar-borrado" href="<?= base_url('solicitudes/eliminar/' . $solicitud['id']) ?>"><i class="fa fa-times fa-2x"></i></a></td>
                        <?php if($solicitud['habilitado']){ ?>
                            <td class="text-center"><a href="<?= base_url('solicitudes/deshabilitar/' . $solicitud['id']) ?>"><i class="fa fa-lock fa-2x"></i></a></td>
                        <?php }else{ ?>
                            <td class="text-center"><a href="<?= base_url('solicitudes/habilitar/' . $solicitud['id']) ?>"><i class="fa fa-unlock fa-2x"></i></a></td>
                        <?php }; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <a class="logout-button" href="<?= base_url('solicitudes/crear') ?>">
            <button type="button" class="btn btn-primary">
                <strong>Nueva solicitud</strong>
            </button>
        </a>
        <a class="logout-button pull-right" href="<?= base_url() ?>">
            <button type="button" class="btn btn-default">
                <strong>Volver al inicio</strong>
            </button>
        </a>

    </div>
</div>
