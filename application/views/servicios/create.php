<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 14/04/2016
 * Time: 03:50 PM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('servicios/crear', $attributes);

?>

<br>

<div class="form-group">
    <label for="inputNombreServicio" class="col-sm-2 control-label">Nombre servicio</label>
    <div class="col-sm-10">
        <?php echo form_error('nombre_servicio'); ?>
        <input type="text" class="form-control" id="inputNombreServicio" name="nombre_servicio" value="<?php echo set_value('nombre_servicio'); ?>" placeholder="Nombre servicio">
    </div>
</div>

<div class="form-group">
    <label for="selectCategoriasServicio" class="col-sm-2 control-label">Categor&iacute;a de servicio</label>

    <select class="form-control col-sm-10" name="id_categoria_servicio" id="selectCategoriasServicio">
        {categorias_servicio}
        <option value="{id}">{categoria}</option>
        {/categorias_servicio}
    </select>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">A&ntilde;adir servicio</button>
    </div>
</div>
</form>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>