<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 08:23 AM
 */

$attributes = array('class' => 'form-horizontal');
echo form_open('solicitudes/crear', $attributes);
?>

<?= $this->session->mensaje; ?><br><br>

<div class='col-xs-4 input-group date'>
    <input type="text" class="form-control datepicker" name="date" />
    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
    </span>
</div><br>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Crear solicitud</button>
    </div>
</div>

</form>