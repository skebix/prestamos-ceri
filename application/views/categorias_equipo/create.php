<?php
$attributes = array();
echo form_open('categorias-equipo/crear', $attributes);
?>

<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <i class="fa fa-print fa-5x"></i>
                    <h3 class="panel-title">
                    <strong>Nombre de nueva categor&iacute;a de equipo</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <?php echo form_error('categoria_equipo'); ?>
                                <input type="text" class="form-control" id="inputCategoriasEquipo" name="categoria_equipo" value="<?php echo set_value('categoria_equipo'); ?>" placeholder="Categor&iacute;a equipo">
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
    </div>
</div>