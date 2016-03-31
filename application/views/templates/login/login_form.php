<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 31/03/2016
 * Time: 09:34 AM
 */

$attributes = array('class' => 'form-horizontal');

echo validation_errors();
echo form_open('login', $attributes);

?>

    <div class="form-group">
        <label for="inputCedula" class="col-sm-2 control-label">C&eacute;dula</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputCedula" name="cedula" placeholder="C&eacute;dula">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword" class="col-sm-2 control-label">Contrase&ntilde;a</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Contrase&ntilde;a">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Ingresar</button>
        </div>
    </div>
</form>