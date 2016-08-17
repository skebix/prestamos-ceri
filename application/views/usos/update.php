<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 10:55 AM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('usos/actualizar/{id}', $attributes);

?>

<div class="form-group">
    <label for="inputUso" class="col-sm-2 control-label">Nombre uso</label>
    <div class="col-sm-10">
        <?php echo form_error('uso'); ?>
        <input type="text" class="form-control" id="inputUso" name="uso" value="<?php echo set_value('uso', $uso); ?>" placeholder="Nombre uso">
    </div>
</div>

<div class="form-group">
    <label for="otro_uso" class="col-sm-2 control-label">Otro uso?</label>
    <?= form_checkbox('otro_uso', '1', $otro_uso, $atributos_otro_uso); ?>
</div>

<br>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Actualizar uso</button>
    </div>
</div>
</form>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>