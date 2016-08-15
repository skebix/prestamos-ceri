<?php
/**
 * Created by PhpStorm.
 * User: SkyDaddy
 * Date: 26/6/2016
 * Time: 5:15 PM
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">Estad&iacute;sticas del servicio de pr&eacute;stamos</div>

    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>Tipo de usuario</th>
            <th>Cantidad de usuarios</th>
            <th>Tiempo de pr&eacute;stamos</th>
        </tr>
        </thead>
        <tbody>
        {category_stats}
        <tr>
            <td scope="row">{categoria}</td>
            <td>{cantidad}</td>
            <td>{tiempo}</td>
        </tr>
        {/category_stats}
        <tr>
            <th scope="row">TOTALES</th>
            <th><?php echo $summary['cantidad_total']; ?></th>
            <th><?php echo $summary['tiempo_total']; ?></th>
        </tr>
        </tbody>
    </table>
</div>
<div class="panel panel-default">

    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>Salas y espacios</th>
            <th>Cantidad de prestamos</th>
            <th>Tiempo de uso</th>
        </tr>
        </thead>
        <tbody>
        {materials_stats}
        <tr>
            <td scope="row">{espacio}</td>
            <td>{cantidad_prestamos}</td>
            <td>{tiempo_prestamos}</td>
        </tr>
        {/materials_stats}
        <tr>
            <th scope="row">TOTALES</th>
            <th><?php //echo $summary2['cantidad_total']; ?></th>
            <th><?php //echo $summary2['tiempo_total']; ?></th>
        </tr>
        </tbody>
    </table>
</div>