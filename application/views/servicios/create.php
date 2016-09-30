<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 14/04/2016
 * Time: 03:50 PM
 */

$attributes = array();
echo form_open('servicios/crear', $attributes);

?>
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <i class="fa fa-angellist fa-5x"></i>
                    <h3 class="panel-title">
                    <strong>Nombre del nuevo servicio</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <?php echo form_error('nombre_servicio'); ?>
                                <input type="text" class="form-control" id="inputNombreServicio" name="nombre_servicio" value="<?php echo set_value('nombre_servicio'); ?>" placeholder="Nombre servicio">
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon3">Categor&iacute;a</span>
                                    <select class="form-control" name="id_categoria_servicio" id="selectCategoriasServicio">
                                        {categorias_servicio}
                                        <option value="{id}">{categoria}</option>
                                        {/categorias_servicio}
                                    </select>
                                </div>
                            </div>
                            <div class="button pull-left">
                                <button type="submit" class="btn btn-primary">A&ntilde;adir servicio</button>
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
    </div>
</div>