<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 14/04/2016
 * Time: 03:54 PM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('servicios/actualizar/{id}', $attributes);

?>

<?= $this->session->mensaje; ?><br><br>

    <div class="form-group">
        <label for="inputNombreServicio" class="col-sm-2 control-label">Nombre servicio</label>
        <div class="col-sm-10">
            <?php echo form_error('nombre_servicio'); ?>
            <input type="text" class="form-control" id="inputNombreServicio" name="nombre_servicio" value="<?php echo set_value('nombre_servicio', $nombre_servicio); ?>" placeholder="Nombre servicio">
        </div>
    </div>

    <div class="form-group">
        <label for="inputCategoriaservicio" class="col-sm-2 control-label">Categor&iacute;a del servicio</label>

        <?= form_dropdown('categoria_servicio', $categorias_servicio, $categoria_servicio_selected, $atributos_categoria_servicio); ?>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Actualizar servicio</button>
        </div>
    </div>
</form>