<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 08:23 AM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('espacios/crear', $attributes);
?>

<?= $this->session->mensaje; ?><br><br>

    <div class="form-group">
        <label for="inputEspacios" class="col-sm-2 control-label">Nombre del espacio</label>
        <div class="col-sm-10">
            <?php echo form_error('espacio'); ?>
            <input type="text" class="form-control" id="inputEspacios" name="espacio" value="<?php echo set_value('espacio'); ?>" placeholder="Nombre espacio">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">A&ntilde;adir espacio</button>
        </div>
    </div>
</form>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>