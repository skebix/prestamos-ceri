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
<br>

<div class="panel panel-default">
    <div class="panel-heading text-center"><strong>{title}</strong></div>
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="datatable">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Solicitante</th>
                    <th class="text-center">Fecha de solicitud</th>
                    <th class="text-center">Fecha de uso</th>
                    <th class="text-center">Finalizar y cerrar</th>
                </tr>
                </thead>
                <tbody>
                {solicitudes}
                <tr>
                    <th scope="row" class="text-center">{id}</th>
                    <td class="text-center">{primer_nombre} {segundo_nombre} {primer_apellido} {segundo_apellido}</td>
                    <td class="text-center">{fecha_solicitud}</td>
                    <td class="text-center">{fecha_uso}</td>
                    <td class="text-center">
                        <a href="<?= base_url('solicitudes/cerrar/{id}') ?>">
                            <i class="fa fa-check-circle-o fa-2x"></i>
                        </a>
                    </td>
                </tr>
                {/solicitudes}
                </tbody>
            </table>
        </div>

        <a class="logout-button pull-right" href="<?= base_url() ?>">
            <button type="button" class="btn btn-primary">
                Volver al inicio
            </button>
        </a>

    </div>
</div>