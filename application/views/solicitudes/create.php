<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 08:23 AM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('solicitudes/crear', $attributes);
?>

<?= $this->session->mensaje; ?><br><br>

<script>
    base_url = "<?php echo base_url(); ?>";
</script>

<div class="form-group">

    <label for="id_usuario" class="col-sm-5 control-label">Qui&eacute;n realiza la solicitud?</label>
    <div class="col-sm-6 input-group ">
        <select class="form-control" name="id_usuario">
            {usuarios}
            <option value="{id}">{cedula} - {primer_nombre} {primer_apellido}</option>
            {/usuarios}
        </select>
    </div>

    <label for="fecha_uso" class="col-sm-5 control-label">Fecha en la que usar&aacute; los equipos o espacios: </label>
    <div class='col-sm-6 input-group date' id="fecha_uso">
        <input type="text" class="form-control" name="fecha_uso" placeholder="DD/MM/YYYY" />
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>

    <label for="hora_entrega" class="col-sm-5 control-label">Desde qu&eacute; hora usar&aacute; los equipos o espacios: </label>
    <div class='col-sm-6 input-group date' id="hora_entrega">
        <input type="text" class="form-control" name="hora_entrega" placeholder="HH:MM" />
        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
    </div>

    <label for="hora_devolucion" class="col-sm-5 control-label">Hasta qu&eacute; hora usar&aacute; los equipos o espacios: </label>
    <div class='col-sm-6 input-group date' id="hora_devolucion">
        <input type="text" class="form-control" name="hora_devolucion" placeholder="HH:MM" />
        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
    </div>

</div>

<div class="form-group" id="nuevo-equipo">
    <div class="col-sm-offset-2 col-sm-3">
        <button type="submit" class="btn btn-primary nuevo-equipo">A&ntilde;adir equipo</button>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Crear solicitud</button>
    </div>
</div>

</form>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>