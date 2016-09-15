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
        {primer_nombre} {segundo_nombre} {primer_apellido} {segundo_apellido}
        <hr>
        <p><strong>Fecha de solicitud:</strong></p>
        {fecha_solicitud}
        <hr>
        <p><strong>Fecha de uso:</strong></p>
        {fecha_uso}
        <hr>

        <?php if(!empty($equipos)): ?>
            <p><strong>Equipos reservados:</strong></p>
            <ul>
                {equipos}
                <li>{nombre_equipo}</li>
                {/equipos}
            </ul>
            <hr>
        <?php endif; ?>

        <?php if(!empty($espacios)): ?>
            <p><strong>Espacios reservados:</strong></p>
            <ul>
                {espacios}
                <li>{nombre_espacio}</li>
                {/espacios}
            </ul>
            <hr>
        <?php endif; ?>

        <?php if(!empty($servicios)): ?>
            <p><strong>Servicios reservados:</strong></p>
            <ul>
                {servicios}
                <li>{nombre_servicio}</li>
                {/servicios}
            </ul>
        <?php endif; ?>

        <div class="form-group">
            <form action="<?= base_url('solicitudes/cerrar/{id}') ?>" method="post">
                <label for="observaciones">Observaciones</label>
                <textarea class="form-control" rows="3" id="observaciones" name="observaciones"></textarea>
                <button type="submit" class="btn btn-danger">Confirmar cierre</button>
            </form>
        </div>
    </div>
</div>

<button class="btn-default"><a href="<?= base_url('') ?>">Volver</a></button>