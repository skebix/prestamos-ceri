<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 01/04/2016
 * Time: 06:09 PM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('usuarios/registro', $attributes);

?>

<br>

<form class="form-horizontal">
    <fieldset>
        <div class="form-group">
            <label for="inputPrimerNombre" class="col-sm-2 control-label">Primer nombre</label>
            <div class="col-sm-8">
                <?php echo form_error('primer_nombre'); ?>
                <input type="text" class="form-control" id="inputPrimerNombre" name="primer_nombre" value="<?php echo set_value('primer_nombre'); ?>" placeholder="Primer nombre">
            </div>
        </div>
        <div class="form-group">
            <label for="inputSegundoNombre" class="col-sm-2 control-label">Segundo nombre</label>
            <div class="col-sm-8">
                <?php echo form_error('segundo_nombre'); ?>
                <input type="text" class="form-control" id="inputSegundoNombre" name="segundo_nombre" value="<?php echo set_value('segundo_nombre'); ?>" placeholder="Segundo nombre">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPrimerApellido" class="col-sm-2 control-label">Primer apellido</label>
            <div class="col-sm-8">
                <?php echo form_error('primer_apellido'); ?>
                <input type="text" class="form-control" id="inputPrimerApellido" name="primer_apellido" value="<?php echo set_value('primer_apellido'); ?>" placeholder="Primer apellido">
            </div>
        </div>
        <div class="form-group">
            <label for="inputSegundoApellido" class="col-sm-2 control-label">Segundo apellido</label>
            <div class="col-sm-8">
                <?php echo form_error('segundo_apellido'); ?>
                <input type="text" class="form-control" id="inputSegundoApellido" name="segundo_apellido" value="<?php echo set_value('segundo_apellido'); ?>" placeholder="Segundo apelido">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Correo electr&oacute;nico</label>
            <div class="col-sm-8">
                <?php echo form_error('email'); ?>
                <input type="text" class="form-control" id="inputEmail" name="email" value="<?php echo set_value('email'); ?>" placeholder="Correo electr&oacute;nico">
            </div>
        </div>
        <div class="form-group">
            <label for="inputCorreoInstitucional" class="col-sm-2 control-label">Correo institucional</label>
            <div class="col-sm-8">
                <?php echo form_error('correo_institucional'); ?>
                <input type="text" class="form-control" id="inputCorreoInstitucional" name="correo_institucional" value="<?php echo set_value('correo_institucional'); ?>" placeholder="Correo institucional">
            </div>
        </div>
        <div class="form-group">
            <label for="inputTelefono" class="col-sm-2 control-label">Tel&eacute;fono</label>
            <div class="col-xs-2">
                <select title="codigo-area" class="form-control" name="codigo_area">
                    <option value="0212">0212</option>
                    <option value="0412">0412</option>
                    <option value="0414">0414</option>
                    <option value="0416">0416</option>
                    <option value="0424">0424</option>
                    <option value="0426">0426</option>
                </select>
            </div>
            <div class="col-sm-6">
                <?php echo form_error('telefono'); ?>
                <input type="text" class="form-control" id="inputTelefono" name="telefono" value="<?php echo set_value('telefono'); ?>" placeholder="Tel&eacute;fono">
            </div>
        </div>
        <div class="form-group">
            <label for="inputCedula" class="col-sm-2 control-label">C&eacute;dula</label>
            <div class="col-sm-8">
                <?php echo form_error('cedula'); ?>
                <input type="text" class="form-control" id="inputCedula" name="cedula" value="<?php echo set_value('cedula'); ?>" placeholder="C&eacute;dula">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">Contrase&ntilde;a</label>
            <div class="col-sm-8">
                <?php echo form_error('password'); ?>
                <input type="password" class="form-control" id="inputPassword" name="password" value="<?php echo set_value('password'); ?>" placeholder="Contrase&ntilde;a">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPasswordConfirmation" class="col-sm-2 control-label">Confirmar contrase&ntilde;a</label>
            <div class="col-sm-8">
                <?php echo form_error('password_confirmation'); ?>
                <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" value="<?php echo set_value('password_confirmation'); ?>" placeholder="Confirmar contrase&ntilde;a">
            </div>
        </div>
        <div class="form-group">
            <label for="categoriasUsuario" class="col-sm-2 control-label">Tipo de usuario</label>
            <div class="col-sm-8">
                <select class="form-control" name="id_categoria_usuario">
                    {categorias_usuario}
                        <option value="{id}">{categoria}</option>
                    {/categorias_usuario}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputTwitter" class="col-sm-2 control-label">Twitter</label>
            <div class="col-sm-8">
                <?php echo form_error('twitter'); ?>
                <input type="text" class="form-control" id="inputTwitter" name="twitter" value="<?php echo set_value('twitter'); ?>" placeholder="Twitter">
            </div>
        </div>
        <div class="form-group">
            <label for="inputFacebook" class="col-sm-2 control-label">Facebook</label>
            <div class="col-sm-8">
                <?php echo form_error('facebook'); ?>
                <input type="text" class="form-control" id="inputFacebook" name="facebook" value="<?php echo set_value('facebook'); ?>" placeholder="Facebook">
            </div>
        </div>
        <div class="form-group">
            <label for="inputInstagram" class="col-sm-2 control-label">Instagram</label>
            <div class="col-sm-8">
                <?php echo form_error('instagram'); ?>
                <input type="text" class="form-control" id="inputInstagram" name="instagram" value="<?php echo set_value('instagram'); ?>" placeholder="Instagram">
            </div>
        </div>
        <?php if($administrador): ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="administrador">
                    El usuario ser&aacute; administrador?
                </label>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </fieldset>
</form>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>
<br><br>