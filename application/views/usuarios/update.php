<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 04/04/2016
 * Time: 11:48 AM
 */

$attributes = array();
echo form_open('usuarios/actualizar/{id}', $attributes);

?>
<div class="col-md-5 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <i class="fa fa-user fa-5x"></i>
            <h3 class="panel-title">
            <strong>Configuraci&oacute;n del usuario</strong>
            </h3>
        </div>
        <div class="panel-body">
            <form role="form">
                <fieldset>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Primer nombre</span>
                            <?php echo form_error('primer_nombre'); ?>
                            <input type="text" class="form-control" id="inputPrimerNombre" name="primer_nombre" value="<?php echo set_value('primer_nombre', $primer_nombre); ?>" placeholder="Primer nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2">Segundo nombre</span>
                            <?php echo form_error('segundo_nombre'); ?>
                            <input type="text" class="form-control" id="inputSegundoNombre" name="segundo_nombre" value="<?php echo set_value('segundo_nombre', $segundo_nombre); ?>" placeholder="Segundo nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">Primer apellido</span>
                            <?php echo form_error('primer_apellido'); ?>
                            <input type="text" class="form-control" id="inputPrimerApellido" name="primer_apellido" value="<?php echo set_value('primer_apellido', $primer_apellido); ?>" placeholder="Primer apellido">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                                <span class="input-group-addon" id="basic-addon4">Segundo apellido</span>
                                <?php echo form_error('segundo_apellido'); ?>
                                <input type="text" class="form-control" id="inputSegundoApellido" name="segundo_apellido" value="<?php echo set_value('segundo_apellido', $segundo_apellido); ?>" placeholder="Segundo apelido">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon4">Correo electr&oacute;nico</span>
                            <?php echo form_error('email'); ?>
                            <input type="text" class="form-control" id="inputEmail" name="email" value="<?php echo set_value('email', $email); ?>" placeholder="Correo electr&oacute;nico">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon5">Correo institucional</span>
                            <?php echo form_error('correo_institucional'); ?>
                            <input type="text" class="form-control" id="inputCorreoInstitucional" name="correo_institucional" value="<?php echo set_value('correo_institucional', $correo_institucional); ?>" placeholder="Correo institucional">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon6">Tel&eacute;fono</span>
                            <?= form_dropdown('codigo_area', $codigo_area, $codigo_area_selected, $atributos_codigo_area); ?>
                            <?php echo form_error('telefono'); ?>
                            <input type="text" class="form-control" id="inputTelefono" name="telefono" value="<?php echo set_value('telefono', $telefono); ?>" placeholder="Tel&eacute;fono">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon7">C&eacute;dula</span>
                            <?php echo form_error('cedula'); ?>
                            <input type="text" class="form-control" id="inputCedula" name="cedula" value="<?php echo set_value('cedula', $cedula); ?>" placeholder="C&eacute;dula">
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_error('password'); ?>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon8">Contrase&ntilde;a</span>
                            <input type="password" class="form-control" id="inputPassword" name="password" value="<?php echo set_value('password'); ?>" placeholder="Contrase&ntilde;a">
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_error('password_confirmation'); ?>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon9">Confirmar contrase&ntilde;a</span>
                            <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" value="<?php echo set_value('password_confirmation'); ?>" placeholder="Confirmar contrase&ntilde;a">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon10">Tipo de usuario</span>
                            <?= form_dropdown('id_categoria_usuario', $categorias_usuario, $categoria_usuario_selected, $atributos_categorias_usuario); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_error('twitter'); ?>
                        <div class="input-group">

                            <span class="input-group-addon" id="basic-addon11">Twitter</span>
                            <input type="text" class="form-control" id="inputTwitter" name="twitter" value="<?php echo set_value('twitter', $twitter); ?>" placeholder="Twitter">
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_error('facebook'); ?>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon12">Facebook</span>
                            <input type="text" class="form-control" id="inputFacebook" name="facebook" value="<?php echo set_value('facebook',$facebook); ?>" placeholder="Facebook">
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_error('instagram'); ?>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon13">Instagram</span>
                            <input type="text" class="form-control" id="inputInstagram" name="instagram" value="<?php echo set_value('instagram', $instagram); ?>" placeholder="Instagram">
                        </div>
                    </div>
                    <?php if($administrador): ?>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <?= form_checkbox('administrador', '1', $administrador_actualizar, $atributos_administrador); ?>
                                <strong>Hacer este usuario administrador.</strong>
                            </label>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="button pull-left">
                        <button type="submit" class="btn btn-primary">Actualizar datos</button>
                    </div>
                    <div class="button pull-right">
                        <a href="<?= base_url('usuarios/listar') ?>">
                            <button type="button" class="btn btn-danger">Cancelar</button>
                        </a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>