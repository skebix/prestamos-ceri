<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 08:30 AM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('equipos/crear', $attributes);

?>

    <div class="form-group">
        <label for="inputNombreEquipo" class="col-sm-2 control-label">Nombre equipo</label>
        <div class="col-sm-10">
            <?php echo form_error('nombre_equipo'); ?>
            <input type="text" class="form-control" id="inputNombreEquipo" name="nombre_equipo" value="<?php echo set_value('nombre_equipo'); ?>" placeholder="Nombre equipo">
        </div>
    </div>

    <div class="form-group">
        <label for="selectCategoriasEquipo" class="col-sm-2 control-label">Categor&iacute;a de equipo</label>

        <select class="form-control col-sm-10" name="id_categoria_equipo" id="selectCategoriasEquipo">
            {categorias_equipo}
            <option value="{id}">{categoria}</option>
            {/categorias_equipo}
        </select>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">A&ntilde;adir equipo</button>
        </div>
    </div>
</form>