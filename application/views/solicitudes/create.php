<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 08:23 AM
 */

$attributes = array('class' => '', 'id' => 'nueva-solicitud');
echo form_open('solicitudes/crear', $attributes);
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <i class="fa fa-calendar fa-5x"></i>
                    <h3 class="panel-title">
                    <strong>Creaci&oacute;n de nueva solicitud</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Solicitante</span>
                                    <select class="form-control" name="id_solicitante">
                                        {usuarios}
                                        <option value="{id}">{cedula} - {primer_nombre} {primer_apellido}</option>
                                        {/usuarios}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon2">Fecha a reservar</span>
                                    <div class='input-group date' id="fecha_uso">
                                        <input type="text" class="form-control col-lg-5" name="fecha_uso" placeholder="DD/MM/YYYY" />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon3">Hora de inicio</span>
                                    <div>
                                        <?php echo form_error('hora_entrega'); ?>
                                    </div>
                                    <div class='input-group date' id="hora_entrega">
                                        <input type="text" class="form-control" name="hora_entrega" placeholder="HH:MM" value="<?php echo set_value('hora_entrega'); ?>" />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon3">Hora de finalizaci&oacute;n</span>
                                    <div>
                                        <?php echo form_error('hora_devolucion'); ?>
                                    </div>
                                    <div class='input-group date' id="hora_devolucion">
                                        <input type="text" class="form-control" name="hora_devolucion" placeholder="HH:MM" value="<?php echo set_value('hora_devolucion'); ?>" />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="nuevo-equipo">
                                <div>
                                    <button type="button" class="btn btn-success nuevo-equipo">A&ntilde;adir equipo</button>
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
                                <div>
                                    <button type="button" class="btn btn-success nuevo-espacio">A&ntilde;adir espacio</button>
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
                                <div>
                                    <button type="button" class="btn btn-success nuevo-servicio">A&ntilde;adir servicio</button>
                                </div>

                                <?php if(isset($select_nuevo_servicio)){ ?>
                                    <?php $len = count($select_nuevo_servicio); ?>
                                    <script>
                                        cantidad_clicks_nuevo_servicio = parseInt("<?php echo $len; ?>");
                                    </script>

                                    <?php foreach ($select_nuevo_servicio as $i => $select){ ?>
                                        <div>
                                            <?php echo form_error('input_nuevo_servicio[' . $i . ']'); ?>
                                        </div>

                                        <div id="div-nuevo-servicio-<?= $i; ?>">
                                            <select class="form-control" id="select_nuevo_servicio_<?= $i; ?>" name="select_nuevo_servicio[]">
                                                <option value="<?= $select; ?>"><?= $select; ?></option>
                                            </select>
                                            <input type="text" class="form-control" name="input_nuevo_servicio[]" id="input_nuevo_servicio_<?= $i; ?>" value="<?php echo set_value('input_nuevo_servicio[' . $i . ']'); ?>" />
                                            <button type="button" class="btn btn-danger" id="eliminar-servicio-<?= $i; ?>">Eliminar servicio</button>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="button pull-left">
                                <button type="submit" class="btn btn-primary">Crear nueva solicitud</button>
                            </div>
                            <div class="button pull-right">
                                <a href="<?= base_url('inicio') ?>">
                                    <button type="button" class="btn btn-danger">Cancelar</button>
                                </a>
                            </div>
                        </fieldset>
                    </form>
                    <script>
                        base_url = "<?php echo base_url(); ?>";
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>