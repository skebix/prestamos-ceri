<?php
$attributes = array();
echo form_open('categorias-equipo/crear', $attributes);
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Escriba la nueva categor&iacute;a</h3>
                </div>
                <div class="panel-body">
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputCategoriasEquipo" class="control-label">Categor&iacute;a de equipo</label>
                                <?php echo form_error('categoria_equipo'); ?>
                                <input type="text" class="form-control" id="inputCategoriasEquipo" name="categoria_equipo" value="<?php echo set_value('categoria_equipo'); ?>" placeholder="Categor&iacute;a equipo">
                            </div>
                            <div class="button">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">A&ntilde;adir categor&iacute;a</button>
                            </div>
                            <br>
                        </fieldset>
                    </form>
                    <a class="logout-button" href="<?= base_url() ?>">
                        <button type="button" class="btn btn-lg btn-primary btn-block">
                            Volver al home
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>