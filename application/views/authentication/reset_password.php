<?php
$attributes = array('class' => 'form-horizontal');
echo form_open('autenticacion/reset_password', $attributes);
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Ingrese y confirme su nueva contrase&ntilde;a</h3>
                </div>
                <div class="panel-body">
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputPassword" class="col-sm-2 control-label">Contrase&ntilde;a</label>
                                <?php echo form_error('password'); ?>
                                <input type="password" class="form-control" id="inputPassword" name="password" value="<?php echo set_value('password'); ?>" placeholder="Contrase&ntilde;a">
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordConfirmation" class="col-sm-2 control-label">Confirmar contrase&ntilde;a</label>
                                <?php echo form_error('password_confirmation'); ?>
                                <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" value="<?php echo set_value('password_confirmation'); ?>" placeholder="Confirmar contrase&ntilde;a">
                            </div>
                            <div class="button">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">Cambiar contrase&ntilde;a</button>
                            </div>
                            <br>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>