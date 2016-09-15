<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/09/2016
 * Time: 14:31
 */
?>

<?php if(!empty($equipos)): ?>
    <p>Los equipos disponibles en la fecha y horas seleccionadas son los siguientes:</p>
    <table class="table">
        <thead>
        <tr>
            <th>Nombre de Equipo</th>
            <th>Categor&iacute;a de Equipo</th>
        </tr>
        </thead>
        <tbody>
        {equipos}
        <tr>
            <td>{nombre_equipo}</td>
            <td>{categoria}</td>
        </tr>
        {/equipos}
        </tbody>
    </table>
<?php else: ?>
<p>No hay equipos disponibles en la fecha y las horas seleccionadas.</p>
<?php endif; ?>

<?php if(!empty($espacios)): ?>
    <p>Los espacios disponibles en la fecha y horas seleccionadas son los siguientes:</p>
    <table class="table">
        <thead>
        <tr>
            <th>Nombre espacio</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($espacios as $espacio): ?>
            <tr>
                <td><?= $espacio['nombre_espacio'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay equipos disponibles en la fecha y las horas seleccionadas.</p>
<?php endif; ?>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>