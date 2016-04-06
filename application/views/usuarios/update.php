<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 04/04/2016
 * Time: 11:48 AM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('usuarios/actualizar/{id}', $attributes);

?>

<div class="form-group">
    <label for="inputPrimerNombre" class="col-sm-2 control-label">Primer nombre</label>
    <div class="col-sm-10">
        <?php echo form_error('primer_nombre'); ?>
        <input type="text" class="form-control" id="inputPrimerNombre" name="primer_nombre" value="<?php echo set_value('primer_nombre', $primer_nombre); ?>" placeholder="Primer nombre">
    </div>
</div>

<div class="form-group">
    <label for="inputSegundoNombre" class="col-sm-2 control-label">Segundo nombre</label>
    <div class="col-sm-10">
        <?php echo form_error('segundo_nombre'); ?>
        <input type="text" class="form-control" id="inputSegundoNombre" name="segundo_nombre" value="<?php echo set_value('segundo_nombre', $segundo_nombre); ?>" placeholder="Segundo nombre">
    </div>
</div>

<div class="form-group">
    <label for="inputPrimerApellido" class="col-sm-2 control-label">Primer apellido</label>
    <div class="col-sm-10">
        <?php echo form_error('primer_apellido'); ?>
        <input type="text" class="form-control" id="inputPrimerApellido" name="primer_apellido" value="<?php echo set_value('primer_apellido', $primer_apellido); ?>" placeholder="Primer apellido">
    </div>
</div>

<div class="form-group">
    <label for="inputSegundoApellido" class="col-sm-2 control-label">Segundo apellido</label>
    <div class="col-sm-10">
        <?php echo form_error('segundo_apellido'); ?>
        <input type="text" class="form-control" id="inputSegundoApellido" name="segundo_apellido" value="<?php echo set_value('segundo_apellido', $segundo_apellido); ?>" placeholder="Segundo apelido">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail" class="col-sm-2 control-label">Correo electr&oacute;nico</label>
    <div class="col-sm-10">
        <?php echo form_error('email'); ?>
        <input type="text" class="form-control" id="inputEmail" name="email" value="<?php echo set_value('email', $email); ?>" placeholder="Correo electr&oacute;nico">
    </div>
</div>

<div class="form-group">
    <label for="inputTelefono" class="col-sm-2 control-label">Tel&eacute;fono</label>

    <?= form_dropdown('codigo_area', $codigo_area, $codigo_area_selected, $atributos_codigo_area); ?>

    <div class="col-sm-8">
        <?php echo form_error('telefono'); ?>
        <input type="text" class="form-control" id="inputTelefono" name="telefono" value="<?php echo set_value('telefono', $telefono); ?>" placeholder="Tel&eacute;fono">
    </div>
</div>

<div class="form-group">
    <label for="inputCedula" class="col-sm-2 control-label">C&eacute;dula</label>
    <div class="col-sm-10">
        <?php echo form_error('cedula'); ?>
        <input type="text" class="form-control" id="inputCedula" name="cedula" value="<?php echo set_value('cedula', $cedula); ?>" placeholder="C&eacute;dula">
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

    <select class="form-control col-sm-10" name="id_categoria_usuario">
        {categorias_usuario}
        <option value="{id}">{categoria}</option>
        {/categorias_usuario}
    </select>
</div>

<?php if($administrador): ?>
    <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="id_administracion">
            El usuario ser&aacute; administrador?
        </label>
    </div>
<?php endif; ?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Actualizar usuario</button>
    </div>
</div>
</form>