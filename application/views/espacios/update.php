<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 09:22 AM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('espacios/actualizar/{id}', $attributes);

?>

    <div class="form-group">
        <label for="inputEspacio" class="col-sm-2 control-label">Nombre espacio</label>
        <div class="col-sm-10">
            <?php echo form_error('espacio'); ?>
            <input type="text" class="form-control" id="inputEspacio" name="espacio" value="<?php echo set_value('espacio', $nombre_espacio); ?>" placeholder="Nombre espacio">
        </div>
    </div>

    <div class="form-group">
        <label for="otro_espacio" class="col-sm-2 control-label">Otro espacio?</label>
        <?= form_checkbox('otro_espacio', '1', $otro_espacio, $atributos_otro_espacio); ?>
    </div>

    <br>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Actualizar espacio</button>
        </div>
    </div>
</form>