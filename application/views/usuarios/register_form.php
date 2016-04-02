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

<div class="form-group">
    <label for="inputPrimerNombre" class="col-sm-2 control-label">Primer nombre</label>
    <div class="col-sm-10">
        <?php echo form_error('primer_nombre'); ?>
        <input type="text" class="form-control" id="inputPrimerNombre" name="primer_nombre" value="<?php echo set_value('primer_nombre'); ?>" placeholder="Primer nombre">
    </div>
</div>

<div class="form-group">
    <label for="inputSegundoNombre" class="col-sm-2 control-label">Segundo nombre</label>
    <div class="col-sm-10">
        <?php echo form_error('segundo_nombre'); ?>
        <input type="text" class="form-control" id="inputSegundoNombre" name="segundo_nombre" value="<?php echo set_value('segundo_nombre'); ?>" placeholder="Segundo nombre">
    </div>
</div>

<div class="form-group">
    <label for="inputPrimerApellido" class="col-sm-2 control-label">Primer apellido</label>
    <div class="col-sm-10">
        <?php echo form_error('primer_apellido'); ?>
        <input type="text" class="form-control" id="inputPrimerApellido" name="primer_apellido" value="<?php echo set_value('primer_apellido'); ?>" placeholder="Primer apellido">
    </div>
</div>

<div class="form-group">
    <label for="inputSegundoApellido" class="col-sm-2 control-label">Segundo apellido</label>
    <div class="col-sm-10">
        <?php echo form_error('segundo_apellido'); ?>
        <input type="text" class="form-control" id="inputSegundoApellido" name="segundo_apellido" value="<?php echo set_value('segundo_apellido'); ?>" placeholder="Segundo apelido">
    </div>
</div>

<div class="form-group">
    <label for="inputCedula" class="col-sm-2 control-label">C&eacute;dula</label>
    <div class="col-sm-10">
        <?php echo form_error('cedula'); ?>
        <input type="text" class="form-control" id="inputCedula" name="cedula" value="<?php echo set_value('cedula'); ?>" placeholder="C&eacute;dula">
    </div>
</div>

<div class="form-group">
    <label for="inputTelefono" class="col-sm-2 control-label">Tel&eacute;fono</label>

    <select class="form-control col-sm-2" name="codigo-area">
        <option>0212</option>
        <option>0412</option>
        <option>0414</option>
        <option>0416</option>
        <option>0424</option>
        <option>0426</option>
    </select>

    <div class="col-sm-8">
        <?php echo form_error('telefono'); ?>
        <input type="text" class="form-control" id="inputTelefono" name="telefono" value="<?php echo set_value('telefono'); ?>" placeholder="Tel&eacute;fono">
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
    <label for="inputPasswordConfirmation" class="col-sm-2 control-label">Confirmar contrase&ntilde;a</label>
    <div class="col-sm-10">
        <?php echo form_error('password_confirmation'); ?>
        <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" value="<?php echo set_value('password_confirmation'); ?>" placeholder="Confirmar contrase&ntilde;a">
    </div>
</div>

<div class="form-group">
    <label for="categoriasUsuario" class="col-sm-2 control-label">Tipo de usuario</label>

    <select class="form-control col-sm-10" name="categoriasUsuario">
        {categorias_usuario}
            <option value="{id}">{categoria}</option>
        {/categorias_usuario}
    </select>

</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
</div>
</form>