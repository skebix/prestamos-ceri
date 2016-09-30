<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 09:58 AM
 */

$attributes = array();
echo form_open('usos/crear', $attributes);
?>
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <i class="fa fa-gamepad fa-5x"></i>
                    <h3 class="panel-title">
                    <strong>Nombre del nuevo uso</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <?php echo form_error('uso'); ?>
                                <input type="text" class="form-control" id="inputUsos" name="uso" value="<?php echo set_value('uso'); ?>" placeholder="Nombre uso">
                            </div>
                            <div class="button pull-left">
                                <button type="submit" class="btn btn-primary">A&ntilde;adir uso</button>
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