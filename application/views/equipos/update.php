<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 11:09 AM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('equipos/actualizar/{id}', $attributes);

?>

<?= $this->session->mensaje; ?><br><br>

    <div class="form-group">
        <label for="inputNombreEquipo" class="col-sm-2 control-label">Nombre equipo</label>
        <div class="col-sm-10">
            <?php echo form_error('nombre_equipo'); ?>
            <input type="text" class="form-control" id="inputNombreEquipo" name="nombre_equipo" value="<?php echo set_value('nombre_equipo', $nombre_equipo); ?>" placeholder="Nombre equipo">
        </div>
    </div>

    <div class="form-group">
        <label for="inputCategoriaEquipo" class="col-sm-2 control-label">Categor&iacute;a del equipo</label>

        <?= form_dropdown('categoria_equipo', $categorias_equipo, $categoria_equipo_selected, $atributos_categoria_equipo); ?>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Actualizar equipo</button>
        </div>
    </div>
</form>