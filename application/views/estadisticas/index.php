<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <i class="fa fa-bar-chart fa-5x"></i>
                    <h3 class="panel-title">
                    <strong>Estad&iacute;sticas generales.</strong>
                    </h3>
                    <p>Seleccione el mes y el año que desea visualizar:</p>
                </div>
                <div class="panel-body">
                    <form role="form" action="<?= base_url('estadisticas/ver') ?>" method="post">
                        <fieldset>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon3">A&ntilde;o:</span>
                                    <select class="form-control" name="stats_year">
                                        <option>2015</option>
                                        <option>2016</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon6">Mes:</span>
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
                                </div>
                            </div>
                            <div class="button pull-left">
                                <button type="submit" class="btn btn-primary">Mostrar</button>
                            </div>
                            <div class="button pull-right">
                                <a href="<?= base_url('inicio') ?>">
                                    <button type="button" class="btn btn-danger">Cancelar</button>
                                </a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>