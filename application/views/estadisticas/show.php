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
        {categorias_usuario}
        <tr>
            <td scope="row">{categoria}</td>
            <td>{cantidad}</td>
            <td>{tiempo}</td>
        </tr>
        {/categorias_usuario}
        <tr>
            <th scope="row">TOTALES</th>
            <th>{cantidad}</th>
            <th>{tiempo}</th>
        </tr>
        </tbody>
    </table>
</div>