<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 08/04/2016
 * Time: 09:55 AM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('categorias-equipo/crear', $attributes);
?>

<div class="form-group">
    <label for="inputCategoriasEquipo" class="col-sm-2 control-label">Categor&iacute;a de equipo</label>
    <div class="col-sm-10">
        <?php echo form_error('categoria_equipo'); ?>
        <input type="text" class="form-control" id="inputCategoriasEquipo" name="categoria_equipo" value="<?php echo set_value('categoria_equipo'); ?>" placeholder="Categor&iacute;a equipo">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">A&ntilde;adir categor&iacute;a</button>
    </div>
</div>
</form>