<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 08:30 AM
 */
$attributes = array();
echo form_open('equipos/crear', $attributes);
?>
<div class="col-md-5 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <i class="fa fa-laptop fa-5x"></i>
            <h3 class="panel-title">
            <strong>Nombre del nuevo equipo</strong>
            </h3>
        </div>
        <div class="panel-body">
            <form role="form">
                <fieldset>
                    <div class="form-group">
                        <?php echo form_error('nombre_equipo'); ?>
                        <input type="text" class="form-control" id="inputNombreEquipo" name="nombre_equipo" value="<?php echo set_value('nombre_equipo'); ?>" placeholder="Nombre equipo">
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">Categor&iacute;a</span>
                            <select class="form-control" name="id_categoria_equipo" id="selectCategoriasEquipo">
                                {categorias_equipo}
                                <option value="{id}">{categoria}</option>
                                {/categorias_equipo}
                            </select>
                        </div>
                    </div>
                    <div class="button pull-left">
                        <button type="submit" class="btn btn-primary">A&ntilde;adir equipo</button>
                    </div>
                    <div class="button pull-right">
                        <a href="<?= base_url('inicio') ?>">
                            <button type="button" class="btn btn-danger">Cancelar</button>
                        </a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>