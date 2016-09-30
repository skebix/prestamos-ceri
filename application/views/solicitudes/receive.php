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
    <div class="panel-heading">Lista de solicitudes</div>
    <div class="panel-body">
        <p>En esta sección podrá recibir los equipos y espacios prestados, así como
            confirmar que los servicios solicitados hayan sido provistos exitosamente.
        </p>
    </div>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="datatable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Solicitante</th>
                <th>Fecha de solicitud</th>
                <th>Fecha de uso</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            {solicitudes}
            <tr>
                <th scope="row">{id}</th>
                <td>{primer_nombre} {segundo_nombre} {primer_apellido} {segundo_apellido}</td>
                <td>{fecha_solicitud}</td>
                <td>{fecha_uso}</td>
                <td>
                    <a href="<?= base_url('solicitudes/cerrar/{id}') ?>">
                        <span class="glyphicon glyphicon-file"></span>
                        Cerrar solicitud
                    </a>
                </td>
            </tr>
            {/solicitudes}
            </tbody>
        </table>
    </div>
</div>
<a href="<?= base_url('') ?>">Volver</a>