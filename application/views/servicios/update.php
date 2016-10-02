<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 14/04/2016
 * Time: 03:54 PM
 */
$attributes = array();
echo form_open('servicios/actualizar/{id}', $attributes);
?>
<div class="col-md-5 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <i class="fa fa-refresh fa-3x"></i>
            <h3 class="panel-title">
            <strong>Modificar nombre de servicio</strong>
            </h3>
        </div>
        <div class="panel-body">
            <form role="form">
                <fieldset>
                    <div class="form-group">
                        <?php echo form_error('nombre_servicio'); ?>
                        <input type="text" class="form-control" id="inputNombreServicio" name="nombre_servicio" value="<?php echo set_value('nombre_servicio', $nombre_servicio); ?>" placeholder="Nombre del servicio">
                    </div>
                    <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon" id="label-addon1">Categor&iacute;a</span>
                            <?= form_dropdown('categoria_servicio', $categorias_servicio, $categoria_servicio_selected, $atributos_categoria_servicio); ?>
                        </div>
                    </div>
                    <div class="button pull-left">
                        <button type="submit" class="btn btn-primary">Actualizar servicio</button>
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