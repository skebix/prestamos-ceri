<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 13/04/2016
 * Time: 04:20 PM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('categorias-servicio/actualizar/{id}', $attributes);

?>

<?= $this->session->mensaje; ?><br><br>

<div class="form-group">
    <label for="inputCategoriasServicio" class="col-sm-2 control-label">Categor&iacute;a de servicio</label>
    <div class="col-sm-10">
        <?php echo form_error('categoria_servicio'); ?>
        <input type="text" class="form-control" id="inputCategoriasServicio" name="categoria_servicio" value="<?php echo set_value('categoria_servicio', $categoria); ?>" placeholder="Categor&iacute;a servicio">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Actualizar categor&iacute;a</button>
    </div>
</div>
</form>