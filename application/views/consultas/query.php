<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/09/2016
 * Time: 13:57
 */

$attributes = array('class' => '', 'id' => 'consultar-disponibilidad');
echo form_open('consultas/consultar', $attributes);
?>

<div class="form-group">
    <label for="fecha_uso" class="control-label">Fecha en la que usar&aacute; los equipos o espacios: </label>
    <div>
        <?php echo form_error('fecha_uso'); ?>
    </div>
    <div class='input-group date' id="fecha_uso">
        <input type="text" class="form-control" name="fecha_uso" placeholder="DD/MM/YYYY" />
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
    </div>
</div>

<div class="form-group">
    <label for="hora_entrega" class="control-label">Desde qu&eacute; hora usar&aacute; los equipos o espacios: </label>
    <div>
        <?php echo form_error('hora_entrega'); ?>
    </div>
    <div class='input-group date' id="hora_entrega">
        <input type="text" class="form-control" name="hora_entrega" placeholder="HH:MM" value="<?php echo set_value('hora_entrega'); ?>" />
        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
    </div>
</div>

<div class="form-group">
    <label for="hora_devolucion" class="control-label">Hasta qu&eacute; hora usar&aacute; los equipos o espacios: </label>
    <div>
        <?php echo form_error('hora_devolucion'); ?>
    </div>
    <div class='input-group date' id="hora_devolucion">
        <input type="text" class="form-control" name="hora_devolucion" placeholder="HH:MM" value="<?php echo set_value('hora_devolucion'); ?>" />
        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10">
        <button type="submit" class="btn btn-success">Consultar equipos y espacios disponibles</button>
    </div>
</div>

</form>

<script>
    base_url = "<?php echo base_url(); ?>";
</script>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>