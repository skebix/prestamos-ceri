<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 05/04/2016
 * Time: 03:15 PM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('authentication/reset_password', $attributes);

?>

    <div class="form-group">
        <label for="inputPassword" class="col-sm-2 control-label">Contrase&ntilde;a</label>
        <div class="col-sm-10">
            <?php echo form_error('password'); ?>
            <input type="password" class="form-control" id="inputPassword" name="password" value="<?php echo set_value('password'); ?>" placeholder="Contrase&ntilde;a">
        </div>
    </div>

    <div class="form-group">
        <label for="inputPasswordConfirmation" class="col-sm-2 control-label">Confirmar contrase&ntilde;a</label>
        <div class="col-sm-10">
            <?php echo form_error('password_confirmation'); ?>
            <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" value="<?php echo set_value('password_confirmation'); ?>" placeholder="Confirmar contrase&ntilde;a">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Cambiar contrase&ntilde;a</button>
        </div>
    </div>
</form>
