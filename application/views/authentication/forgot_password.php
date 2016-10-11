<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Ingrese el correo con el cual est&aacute; registrado</h3>
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

                    <form role="form" action="<?= base_url('autenticacion/forgot-password') ?>" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputEmail" class="control-label">Correo electr&oacute;nico</label>
                                <?php echo form_error('email'); ?>
                                <input type="text" class="form-control" id="inputEmail" name="email" value="<?php echo set_value('email'); ?>" placeholder="Correo electr&oacute;nico">
                            </div>
                            <div class="button">
                                <button type="submit" class="btn btn-lg btn-primary col-lg-5">Enviar</button>
                                <a class="logout-button" href="<?= base_url() ?>">
                                    <button type="button" class="btn btn-lg btn-danger col-lg-6 pull-right">
                                        Cancelar
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