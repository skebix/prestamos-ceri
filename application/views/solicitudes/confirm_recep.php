<div class="panel panel-default">
    <div class="panel-heading">Cierre de solicitud</div>
    <div class="panel-body">
        <p>Por favor confirme los datos del prestamo #{id} que será cerrado.</p>
        <p>Confirme que el solicitante ha devuelto todos los equipos utilizados
            y desocupado los espacios prestados.
            Indique en el campo de observaciones el nivel de satisfacción del
            usuario con el servicio así como cualquier inquietud o eventualidad
            que haya ocurrido.
        </p>
        <hr>
    </div>
    <div class="container">
        <p><strong>Solicitante:</strong></p>
        {usuario}
        {primer_nombre} {segundo_nombre} {primer_apellido} {segundo_apellido}
        {/usuario}
        <hr>
        <p><strong>Fecha de solicitud:</strong></p>
        {solicitud}
        {fecha_solicitud}
        {/solicitud}
        <hr>
        <p><strong>Fecha de uso:</strong></p>
        {solicitud}
        {fecha_uso}
        {/solicitud}
        <hr>
        <p><strong>Equipos reservados:</strong></p>
        {equipos}
        nombre_equipo}
        {/equipos}
        <hr>
        <p><strong>Espacios reservados:</strong></p>
        {espacios}
        {nombre_espacio}
        {/espacios}
        <hr>
        <p><strong>Servicios reservado:</strong></p>
        {servicios}
        {nombre_servicio}
        {/servicios}
        <hr>
        <div class="form-group">
        <form action="<?= base_url('solicitudes/cerrado/{id}') ?>" method="post">
            <input class="label" type="hidden" value={id} id="solsid" name="solsid">
            <label for="obs">Observaciones</label>
            <input class="form-control" type="text" maxlength="455" id="obs" name="obs">
            <input class="bg-primary" type="submit" value="Confirmar" id="confirm-btn">
        </form>
        </div>
    </div>
</div>
<button class="btn-default"><a href="<?= base_url('') ?>">Volver</a></button>