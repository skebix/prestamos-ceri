<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 08:23 AM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('espacios/crear', $attributes);

?>

<div class="form-group">
    <label for="inputEspacio" class="col-sm-2 control-label">Nombre espacio</label>
    <div class="col-sm-10">
        <?php echo form_error('espacio'); ?>
        <input type="text" class="form-control" id="inputEspacio" name="espacio" placeholder="Nombre espacio">
    </div>
</div>

<div class="form-group">
    <label for="otro_espacio" class="col-sm-2 control-label">Otro espacio?</label>
    <?= form_checkbox('otro_espacio', '1', FALSE,  array('class' => 'checkbox')); ?>
</div>

<br>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">A&ntilde;adir espacio</button>
    </div>
</div>
</form>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>