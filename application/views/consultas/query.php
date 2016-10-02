<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/09/2016
 * Time: 13:57
 */
$attributes = array('id' => 'consultar-disponibilidad');
echo form_open('consultas/consultar', $attributes);
?>
<div class="col-md-5 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <i class="fa fa-weixin fa-3x"></i>
            <h3 class="panel-title">
            <strong>Consultar disponibilidad de espacios y equipos</strong>
            </h3>
        </div>
        <div class="panel-body">
            <form role="form">
                <fieldset>
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
                    <div class="button pull-left">
                        <button type="submit" class="btn btn-primary">Consultar</button>
                    </div>
                    <div class="button pull-right">
                        <a href="<?= base_url('inicio') ?>">
                            <button type="button" class="btn btn-danger">Cancelar</button>
                        </a>
                    </div>
                </fieldset>
            </form>
            <script>base_url = "<?php echo base_url(); ?>";</script>
        </div>
    </div>
</div>