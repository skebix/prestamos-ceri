<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 05/04/2016
 * Time: 08:21 AM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('autenticacion/forgot-password', $attributes);

?>

<div class="form-group">
    <label for="inputEmail" class="col-sm-2 control-label">Correo electr&oacute;nico</label>
    <div class="col-sm-10">
        <?php echo form_error('email'); ?>
        <input type="text" class="form-control" id="inputEmail" name="email" value="<?php echo set_value('email'); ?>" placeholder="Correo electr&oacute;nico">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Enviar contraseña</button>
    </div>
</div>
</form>