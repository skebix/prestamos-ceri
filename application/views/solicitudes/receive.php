<div class="panel panel-default">
    <div class="panel-heading">Lista de solicitudes</div>
    <div class="panel-body">
        <p>En esta sección podrá recibir los equipos y espacios prestados, así como
            confirmar que los servicios solicitados hayan sido provistos exitosamente.
        </p>
    </div>
    <table class="table">
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
                <a href="<?= base_url('solicitudes/recibir/{id}') ?>">
                    <span class="glyphicon glyphicon-file"></span>
                    Cerrar solicitud
                </a>
            </td>
        </tr>
        {/solicitudes}
        </tbody>
    </table>
</div>
<a href="<?= base_url('') ?>">Volver</a>