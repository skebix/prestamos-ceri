<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 13/04/2016
 * Time: 04:19 PM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('categorias-servicio/crear', $attributes);
?>

<div class="form-group">
    <label for="inputCategoriasServicio" class="col-sm-2 control-label">Categor&iacute;a de servicio</label>
    <div class="col-sm-10">
        <?php echo form_error('categoria_servicio'); ?>
        <input type="text" class="form-control" id="inputCategoriasServicio" name="categoria_servicio" value="<?php echo set_value('categoria_servicio'); ?>" placeholder="Categor&iacute;a servicio">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">A&ntilde;adir categor&iacute;a</button>
    </div>
</div>
</form>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>