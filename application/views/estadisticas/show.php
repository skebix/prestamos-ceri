<?php
/**
 * Created by PhpStorm.
 * User: SkyDaddy
 * Date: 26/6/2016
 * Time: 5:15 PM
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">Estad&iacutesticas de uso</div>

    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>Tipo de usuario</th>
            <th>Cantidad de usuarios</th>
            <th>Tiempo de pr&eacutestamos</th>
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