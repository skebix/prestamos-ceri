<?php
$attributes = array();
echo form_open('autenticacion/forgot-password', $attributes);
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Ingrese el correo con el cual esta registrado</h3>
                </div>
                <div class="panel-body">
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputEmail" class="control-label">Correo electr&oacute;nico</label>
                                <?php echo form_error('email'); ?>
                                <input type="text" class="form-control" id="inputEmail" name="email" value="<?php echo set_value('email'); ?>" placeholder="Correo electr&oacute;nico">
                            </div>
                            <div class="button">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">Enviar</button>
                            </div>
                            <br>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>