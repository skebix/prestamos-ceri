<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 07/04/2016
 * Time: 03:54 PM
 */

$attributes = array();
echo form_open('categorias-usuario/crear', $attributes);
?>
<div class="col-md-5 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <i class="fa fa-list-alt fa-5x"></i>
            <h3 class="panel-title">
            <strong>Nombre de nueva categor&iacute;a de usuario</strong>
            </h3>
        </div>
        <div class="panel-body">
            <form role="form">
                <fieldset>
                    <div class="form-group">
                        <?php echo form_error('categoria_usuario'); ?>
                        <input type="text" class="form-control" id="inputCategoriasUsuario" name="categoria_usuario" value="<?php echo set_value('categoria_usuario'); ?>" placeholder="Categor&iacute;a usuario">
                    </div>
                    <div class="button pull-left">
                        <button type="submit" class="btn btn-primary">A&ntilde;adir categor&iacute;a</button>
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