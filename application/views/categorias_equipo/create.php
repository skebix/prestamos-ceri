<?php
$attributes = array();
echo form_open('categorias-equipo/crear', $attributes);
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center panel-title">
                    <i class="fa fa-certificate"></i>
                    Nombre de nueva categor&iacute;a
                    <i class="fa fa-certificate"></i>
                    </h3>
                </div>
                <div class="panel-body">
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <?php echo form_error('categoria_equipo'); ?>
                                <input type="text" class="form-control" id="inputCategoriasEquipo" name="categoria_equipo" value="<?php echo set_value('categoria_equipo'); ?>" placeholder="Categor&iacute;a equipo">
                            </div>
                            <div class="button">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">A&ntilde;adir categor&iacute;a</button>
                            </div>
                            <br>
                        </fieldset>
                    </form>
                    <p class="text-center small">
                                <a href="<?= base_url('inicio') ?>"> 
                                <i class="fa fa-times"></i>
                                Cancelar</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>