<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Ingrese y confirme su nueva contrase&ntilde;a</h3>
                </div>
                <div class="panel-body">

                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong><?php echo $this->session->flashdata('success'); ?></strong>
                        </div>
                    <?php endif;  ?>

                    <?php if($this->session->flashdata('info')): ?>
                        <div class="alert alert-info">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong><?php echo $this->session->flashdata('info'); ?></strong>
                        </div>
                    <?php endif;  ?>

                    <?php if($this->session->flashdata('warning')): ?>
                        <div class="alert alert-warning">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong><?php echo $this->session->flashdata('warning'); ?></strong>
                        </div>
                    <?php endif;  ?>

                    <?php if($this->session->flashdata('danger')): ?>
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong><?php echo $this->session->flashdata('danger'); ?></strong>
                        </div>
                    <?php endif;  ?>

                    <form role="form" action="<?= base_url('autenticacion/reset-password') ?>" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputPassword" class="control-label">Contrase&ntilde;a</label>
                                <?php echo form_error('password'); ?>
                                <input type="password" class="form-control" id="inputPassword" name="password" value="<?php echo set_value('password'); ?>" placeholder="Contrase&ntilde;a">
                            </div>

                            <div class="form-group">
                                <label for="inputPasswordConfirmation" class="control-label">Confirmar contrase&ntilde;a</label>
                                <?php echo form_error('password_confirmation'); ?>
                                <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" value="<?php echo set_value('password_confirmation'); ?>" placeholder="Confirmar contrase&ntilde;a">
                            </div>

                            <div class="button">
                                <button type="submit" class="btn btn-lg btn-primary col-lg-7">Cambiar contrase&ntilde;a</button>
                                <a class="logout-button" href="<?= base_url() ?>">
                                    <button type="button" class="btn btn-lg btn-danger col-lg-4 pull-right">
                                        Volver
                                    </button>
                                </a>
                            </div>
                            <br>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>