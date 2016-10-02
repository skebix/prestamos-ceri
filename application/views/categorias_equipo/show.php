<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 08/04/2016
 * Time: 09:57 AM
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
                        <th class="text-center">Categor&iacute;a de equipo</th>
                        <th class="text-center">Habilitado</th>
                        <th class="text-center">Modificar</th>
                        <th class="text-center">Eliminar</th>
                        <th class="text-center">Habilitar / Deshabilitar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categorias as $k => $categoria): ?>
                    <tr class="odd gradeX">
                        <th scope="row" class="text-center"><?= $categoria['id']; ?></th>
                        <td class="text-center"><?= $categoria['categoria']; ?></td>
                        <td class="text-center"><?= ($categoria['habilitado'])? 'S&iacute': 'No'; ?></td>
                        <td class="text-center"><a href="<?= base_url('categorias-equipo/actualizar/' . $categoria['id']) ?>"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
                        <td class="text-center"><a href="<?= base_url('categorias-equipo/eliminar/' . $categoria['id']) ?>"><i class="fa fa-times fa-2x"></i></a></td>
                        <td class="text-center">
                            <?php if($categoria['habilitado']){ ?>
                                <a href="<?= base_url('categorias-equipo/deshabilitar/' . $categoria['id']) ?>"><i class="fa fa-lock fa-2x"></i></a>
                            <?php }else{ ?>
                                <a href="<?= base_url('categorias-equipo/habilitar/' . $categoria['id']) ?>"><i class="fa fa-unlock fa-2x"></i></a>
                            <?php }; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <label>
        <a class="logout-button" href="<?= base_url('categorias-equipo/crear') ?>">
            <button type="button" class="btn btn-success">
                Agregar categor&iacute;a
            </button>
        </a>
        <a class="logout-button" href="<?= base_url() ?>">
            <button type="button" class="btn btn-warning">
                Volver al inicio
            </button>
        </a>
        </label>
    </div>
</div>