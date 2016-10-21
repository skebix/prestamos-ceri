<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 08:23 AM
 */

$attributes = array();
echo form_open('espacios/crear', $attributes);

?>
<div class="col-md-5 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <i class="fa fa-bank fa-5x"></i>
            <h3 class="panel-title">
            <strong>Nombre del nuevo espacio</strong>
            </h3>
        </div>
        <div class="panel-body">
            <form role="form">
                <fieldset>
                    <div class="form-group">
                        <?php echo form_error('espacio'); ?>
                        <input type="text" class="form-control" id="inputEspacio" name="espacio" placeholder="Nombre espacio">
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                            <?= form_checkbox('otro_espacio', '1', FALSE,  array('class' => 'checkbox')); ?>
                            </span>
                            <input type="text" class="form-control" aria-label="Text input with checkbox" name="otro_espacio" disabled="true" value="¿Otro espacio?">
                        </div>
                    </div>
                    <div class="button pull-left">
                        <button type="submit" class="btn btn-primary">A&ntilde;adir espacio</button>
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