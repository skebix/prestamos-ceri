<script>
    flag_update = true;
    fu = "<?php echo $fecha_uso; ?>";
    he = "<?php echo $hora_entrega; ?>";
    hd = "<?php echo $hora_devolucion; ?>";
</script>

<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 05/09/2016
 * Time: 9:37
 */

$attributes = array('class' => '', 'id' => 'nueva-solicitud');
echo form_open('solicitudes/actualizar/{id_solicitud}', $attributes);
?>

<div class="form-group">
    <label for="id_solicitante" class="control-label">Qui&eacute;n realiza la solicitud?</label>
    <div class="col-sm-6 input-group ">
        <select class="form-control" name="id_solicitante">
            {usuarios}
            <option value="{id}">{cedula} - {primer_nombre} {primer_apellido}</option>
            {/usuarios}
        </select>
    </div>
</div>

<div class="form-group">
    <label for="fecha_uso" class="control-label">Fecha en la que usar&aacute; los equipos o espacios: </label>
    <div class='input-group date' id="fecha_uso">
        <input type="text" class="form-control" name="fecha_uso" />
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
    </div>
</div>

<div class="form-group">
    <label for="hora_entrega" class="control-label">Desde qu&eacute; hora usar&aacute; los equipos o espacios: </label>
    <div>
        <?php echo form_error('hora_entrega'); ?>
    </div>
    <div class='input-group date' id="hora_entrega">
        <input type="text" class="form-control" name="hora_entrega" placeholder="HH:MM"  />
        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
    </div>
</div>

<div class="form-group">
    <label for="hora_devolucion" class="control-label">Hasta qu&eacute; hora usar&aacute; los equipos o espacios: </label>
    <div>
        <?php echo form_error('hora_devolucion'); ?>
    </div>
    <div class='input-group date' id="hora_devolucion">
        <input type="text" class="form-control" name="hora_devolucion" placeholder="HH:MM" />
        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
    </div>
</div>


<div class="form-group" id="nuevo-equipo">
    <div class="col-sm-offset-2 col-sm-3">
        <button type="button" class="btn btn-primary nuevo-equipo">A&ntilde;adir equipo</button>
    </div>
    <?php if(isset($select_nuevo_equipo)){ ?>
        <?php $len = count($select_nuevo_equipo); ?>
        <script>
            cantidad_clicks_nuevo_equipo = parseInt("<?php echo $len; ?>");
        </script>
        <?php foreach ($select_nuevo_equipo as $i => $select){ ?>
            <div id="div-nuevo-equipo-<?= $i; ?>">
                <div>
                    <?php echo form_error('select_nuevo_equipo[' . $i . ']'); ?>
                </div>
                <select class="form-control" id="select_nuevo_equipo_<?= $i; ?>" name="select_nuevo_equipo[]">
                    <option value="<?= $select; ?>"><?= $select; ?></option>
                </select>
                <button type="button" class="btn btn-danger" id="eliminar-equipo-<?= $i; ?>">Eliminar equipo</button>
            </div>
        <?php } ?>
    <?php } ?>

</div>

<div class="form-group" id="nuevo-espacio">
    <div class="col-sm-offset-2 col-sm-3">
        <button type="button" class="btn btn-primary nuevo-espacio">A&ntilde;adir espacio</button>
    </div>

    <?php if(isset($select_nuevo_espacio)){ ?>
        <?php $len = count($select_nuevo_espacio); ?>
        <script>
            cantidad_clicks_nuevo_espacio = parseInt("<?php echo $len; ?>");
        </script>

    <?php foreach ($select_nuevo_espacio as $i => $select){ ?>
        <div id="div-nuevo-espacio-<?= $i; ?>">
            <div>
                <?php echo form_error('select_nuevo_espacio[' . $i . ']'); ?>
                <?php echo form_error('input_nuevo_espacio[' . $i . ']'); ?>
                <?php echo form_error('input_otro_uso[' . $i . ']'); ?>
            </div>
            <select class="form-control" id="select_nuevo_espacio_<?= $i; ?>" name="select_nuevo_espacio[]">
                <option value="<?= $select; ?>"><?= $select; ?></option>
            </select>

            <?php if(isset(${"input_nuevo_espacio_" . $i})){ ?>
                <input type="text" class="form-control" name="input_nuevo_espacio[]" id="input_nuevo_espacio_<?= $i; ?>" value="<?php echo ${"input_nuevo_espacio_" . $i}; ?>" />
            <?php } ?>

            <label for="select_usos_espacio[]" class="control-label">Qu&eacute; uso le dar&aacute; al espacio?</label>
            <select class="form-control" id="select_usos_espacio_<?= $i; ?>" name="select_usos_espacio[]">
                <option value="<?= $select_usos_espacio[$i]; ?>"><?= $select_usos_espacio[$i]; ?></option>
            </select>

            <?php if(isset(${"input_otro_uso_" . $i})){ ?>
                <input type="text" class="form-control" name="input_otro_uso[]" id="input_otro_uso_<?= $i; ?>" value="<?php echo ${"input_otro_uso_" . $i}; ?>" />
            <?php } ?>

            <button type="button" class="btn btn-danger" id="eliminar-espacio-<?= $i; ?>">Eliminar espacio</button>
        </div>
    <?php } ?>
    <?php } ?>

</div>

<div class="form-group" id="nuevo-servicio">
    <div class="col-sm-offset-2 col-sm-3">
        <button type="button" class="btn btn-primary nuevo-servicio">A&ntilde;adir servicio</button>
    </div>

    <?php if(isset($select_nuevo_servicio)){ ?>
        <?php $len = count($select_nuevo_servicio); ?>
        <script>
            cantidad_clicks_nuevo_servicio = parseInt("<?php echo $len; ?>");
        </script>

    <?php foreach ($select_nuevo_servicio as $i => $select){ ?>
        <div id="div-nuevo-servicio-<?= $i; ?>">
            <div>
                <?php echo form_error('input_nuevo_servicio[' . $i . ']'); ?>
            </div>

            <select class="form-control" id="select_nuevo_servicio_<?= $i; ?>" name="select_nuevo_servicio[]">
                <option value="<?= $select; ?>"><?= $select; ?></option>
            </select>
            <input type="text" class="form-control" name="input_nuevo_servicio[]" id="input_nuevo_servicio_<?= $i; ?>" value="<?php echo set_value('input_nuevo_servicio[' . $i . ']', $input_nuevo_servicio[$i]); ?>" />
            <button type="button" class="btn btn-danger" id="eliminar-servicio-<?= $i; ?>">Eliminar servicio</button>
        </div>
    <?php } ?>
    <?php } ?>
</div>



<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Actualizar solicitud</button>
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