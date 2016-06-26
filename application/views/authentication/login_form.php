<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 31/03/2016
 * Time: 09:34 AM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('autenticacion', $attributes);
?>

    <div class="form-group">
        <label for="inputCedula" class="col-sm-2 control-label">C&eacute;dula</label>
        <div class="col-sm-10">
            <?php echo form_error('cedula'); ?>
            <input type="text" class="form-control" id="inputCedula" name="cedula" value="<?php echo set_value('cedula'); ?>" placeholder="C&eacute;dula">
        </div>
    </div>

    <div class="form-group">
        <label for="inputPassword" class="col-sm-2 control-label">Contrase&ntilde;a</label>
        <div class="col-sm-10">
            <?php echo form_error('password'); ?>
            <input type="password" class="form-control" id="inputPassword" name="password" value="<?php echo set_value('password'); ?>" placeholder="Contrase&ntilde;a">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </div>
        </form>
    </div>
    <div class="col-sm-offset-2 col-sm-10">
        <a href="<?= base_url('autenticacion/forgot-password') ?>">
            <button type="submit" class="btn btn-primary">Olvid&oacute; su contrase&ntilde;a</button>
        </a>
    </div>
