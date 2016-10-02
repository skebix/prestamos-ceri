<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 11:09 AM
 */
$attributes = array();
echo form_open('equipos/actualizar/{id}', $attributes);
?>
<div class="col-md-5 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <i class="fa fa-refresh fa-3x"></i>
            <h3 class="panel-title">
            <strong>Modificar nombre de equipo</strong>
            </h3>
        </div>
        <div class="panel-body">
            <form role="form">
                <fieldset>
                    <div class="form-group">
                        <?php echo form_error('nombre_equipo'); ?>
                        <input type="text" class="form-control" id="inputNombreEquipo" name="nombre_equipo" value="<?php echo set_value('nombre_equipo', $nombre_equipo); ?>" placeholder="Nombre de equipo">
                    </div>
                    <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon" id="label-addon1">Categor&iacute;a</span>
                            <?= form_dropdown('categoria_equipo', $categorias_equipo, $categoria_equipo_selected, $atributos_categoria_equipo); ?>
                        </div>
                    </div>
                    <div class="button pull-left">
                        <button type="submit" class="btn btn-primary">Actualizar equipo</button>
                    </div>
                    <div class="button pull-right">
                        <a href="<?= base_url('inicio') ?>">
                            <button type="button" class="btn btn-danger">Cancelar</button>
                        </a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>