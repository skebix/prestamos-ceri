<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 07/04/2016
 * Time: 03:54 PM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('categorias-usuario/crear', $attributes);
?>

    <div class="form-group">
        <label for="inputCategoriasUsuario" class="col-sm-2 control-label">Categor&iacute;a usuario</label>
        <div class="col-sm-10">
            <?php echo form_error('categoria_usuario'); ?>
            <input type="text" class="form-control" id="inputCategoriasUsuario" name="categoria_usuario" value="<?php echo set_value('categoria_usuario'); ?>" placeholder="Categor&iacute;a usuario">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">A&ntilde;adir categor&iacute;a</button>
        </div>
    </div>
</form>