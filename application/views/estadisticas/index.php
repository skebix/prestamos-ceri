<div>
    <form class="form-inline" role="form" action="<?= base_url('estadisticas/ver') ?>" method="post">
        <div class="form-group">
            Seleccione el mes y el año que desea visualizar:
            </br>
            A&ntilde;o:
            <select class="form-control" name="stats_year">
                <option>2015</option>
                <option>2016</option>
            </select>
            </br>
            Mes:
            <select class="form-control" name="stats_month">
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            </br>
            <button type="submit" class="btn btn-default">Mostrar</button>
        </div>
    </form>
</div>