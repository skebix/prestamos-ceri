<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 08/04/2016
 * Time: 08:08 AM
 */
?>

<span class="glyphicon glyphicon-envelope"></span><?= $this->session->mensaje; ?>
<br>

<div class="panel panel-default">
    <div class="panel-heading">{title}</div>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="datatable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Categor&iacute;a de Usuario</th>
                <th>Habilitado</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
                <th>Habilitar y Deshabilitar</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($categorias as $k => $categoria): ?>
                <tr class="odd gradeX">
                    <th scope="row"><?= $categoria['id']; ?></th>
                    <td><?= $categoria['categoria']; ?></td>
                    <td><?= ($categoria['habilitado'])? 'S&iacute': 'No'; ?></td>
                    <td><a href="<?= base_url('categorias-usuario/actualizar/' . $categoria['id']) ?>">Actualizar categor&iacute;a</a></td>
                    <td><a href="<?= base_url('categorias-usuario/eliminar/' . $categoria['id']) ?>">Eliminar categor&iacute;a</a></td>
                    <td>
                        <?php if($categoria['habilitado']){ ?>
                            <a href="<?= base_url('categorias-usuario/deshabilitar/' . $categoria['id']) ?>">Deshabilitar categor&iacute;a</a>
                        <?php }else{ ?>
                            <a href="<?= base_url('categorias-usuario/habilitar/' . $categoria['id']) ?>">Habilitar categor&iacute;a</a>
                        <?php }; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<a class="logout-button" href="<?= base_url('categorias-usuario/crear') ?>">
    <button type="button" class="btn btn-primary">
        Agregar categor&iacute;a
    </button>
</a>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>