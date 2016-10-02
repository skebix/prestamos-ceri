<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 09:22 AM
 */
$attributes = array();
echo form_open('espacios/actualizar/{id}', $attributes);
?>
<div class="col-md-5 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <i class="fa fa-refresh fa-3x"></i>
            <h3 class="panel-title">
            <strong>Modificar espacio</strong>
            </h3>
        </div>
        <div class="panel-body">
            <form role="form">
                <fieldset>
                    <div class="form-group">
                        <?php echo form_error('espacio'); ?>
                        <input type="text" class="form-control" id="inputEspacio" name="espacio" value="<?php echo set_value('espacio', $nombre_espacio); ?>" placeholder="Nombre del espacio">
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <?= form_checkbox('otro_espacio', '1', $otro_espacio, $atributos_otro_espacio); ?>
                                <strong>Es otro espacio.</strong>
                            </label>
                        </div>
                    </div>
                    <div class="button pull-left">
                        <button type="submit" class="btn btn-primary">Actualizar espacio</button>
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