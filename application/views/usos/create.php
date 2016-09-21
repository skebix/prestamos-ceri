<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 09:58 AM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('usos/crear', $attributes);
?>

<br>

<div class="form-group">
    <label for="inputUsos" class="col-sm-2 control-label">Nombre del uso</label>
    <div class="col-sm-10">
        <?php echo form_error('uso'); ?>
        <input type="text" class="form-control" id="inputUsos" name="uso" value="<?php echo set_value('uso'); ?>" placeholder="Nombre uso">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">A&ntilde;adir uso</button>
    </div>
</div>
</form>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>