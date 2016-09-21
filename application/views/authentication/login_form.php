<?php
$attributes = array();
echo form_open('autenticacion', $attributes);
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Por favor ingrese sus datos para continuar</h3>
                </div>
                <div class="panel-body">
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputCedula" class="control-label">C&eacute;dula</label>
                                <?php echo form_error('cedula'); ?>
                                <input type="text" class="form-control" id="inputCedula" name="cedula" value="<?php echo set_value('cedula'); ?>" placeholder="C&eacute;dula">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="control-label">Contrase&ntilde;a</label>
                                <?php echo form_error('password'); ?>
                                <input type="password" class="form-control" id="inputPassword" name="password" value="<?php echo set_value('password'); ?>" placeholder="Contrase&ntilde;a">
                            </div>
                            <div class="button">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">Ingresar</button>
                            </div>
                            <br>
                            <p class="text-center">Si ha olvidado su contrase&ntilde;a, haga click
                                <a href="<?= base_url('autenticacion/forgot-password') ?>"> aqu&iacute;.</a>
                            </p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>