<?php
$attributes = array();
echo form_open('usuarios/registro', $attributes);
?>
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center panel-title">
                    <i class="fa fa-arrow-right"></i>
                    Registro de nuevo usuario
                    <i class="fa fa-arrow-left"></i>
                    </h3>
                </div>
                <div class="panel-body">

                    <form method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputPrimerNombre" class="control-label">Primer nombre</label>
                                <?php echo form_error('primer_nombre'); ?>
                                <input type="text" class="form-control" id="inputPrimerNombre" name="primer_nombre" value="<?php echo set_value('primer_nombre'); ?>" placeholder="Primer nombre">
                            </div>
                            <div class="form-group">
                                <label for="inputSegundoNombre" class="control-label">Segundo nombre</label>
                                <?php echo form_error('segundo_nombre'); ?>
                                <input type="text" class="form-control" id="inputSegundoNombre" name="segundo_nombre" value="<?php echo set_value('segundo_nombre'); ?>" placeholder="Segundo nombre">
                            </div>
                            <div class="form-group">
                                <label for="inputPrimerApellido" class="control-label">Primer apellido</label>
                                <?php echo form_error('primer_apellido'); ?>
                                <input type="text" class="form-control" id="inputPrimerApellido" name="primer_apellido" value="<?php echo set_value('primer_apellido'); ?>" placeholder="Primer apellido">
                            </div>
                            <div class="form-group">
                                <label for="inputSegundoApellido" class="control-label">Segundo apellido</label>
                                <?php echo form_error('segundo_apellido'); ?>
                                <input type="text" class="form-control" id="inputSegundoApellido" name="segundo_apellido" value="<?php echo set_value('segundo_apellido'); ?>" placeholder="Segundo apelido">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="control-label">Correo electr&oacute;nico</label>
                                <?php echo form_error('email'); ?>
                                <input type="text" class="form-control" id="inputEmail" name="email" value="<?php echo set_value('email'); ?>" placeholder="Correo electr&oacute;nico">
                            </div>
                            <div class="form-group">
                                <label for="inputCorreoInstitucional" class="control-label">Correo institucional</label>
                                <?php echo form_error('correo_institucional'); ?>
                                <input type="text" class="form-control" id="inputCorreoInstitucional" name="correo_institucional" value="<?php echo set_value('correo_institucional'); ?>" placeholder="Correo institucional">
                            </div>
                            <div class="form-group">
                                <label for="inputTelefono" class="control-label">Tel&eacute;fono</label>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <select title="codigo-area" type="button" class="btn btn-secondary active dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="codigo_area">
                                            <option class="dropdown-item" value="0212">0212</option>
                                            <option class="dropdown-item" value="0412">0412</option>
                                            <option class="dropdown-item" value="0414">0414</option>
                                            <option class="dropdown-item" value="0416">0416</option>
                                            <option class="dropdown-item" value="0424">0424</option>
                                            <option class="dropdown-item" value="0426">0426</option>
                                        </select>
                                    </div>
                                    <?php echo form_error('telefono'); ?>
                                    <input type="text" id="inputTelefono" class="form-control" name="telefono" value="<?php echo set_value('telefono'); ?>" placeholder="Tel&eacute;fono">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCedula" class="control-label">C&eacute;dula</label>
                                <?php echo form_error('cedula'); ?>
                                <input type="text" class="form-control" id="inputCedula" name="cedula" value="<?php echo set_value('cedula'); ?>" placeholder="C&eacute;dula">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="control-label">Contrase&ntilde;a</label>
                                <?php echo form_error('password'); ?>
                                <input type="password" class="form-control" id="inputPassword" name="password" value="<?php echo set_value('password'); ?>" placeholder="Contrase&ntilde;a">
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordConfirmation" class="control-label">Confirmar contrase&ntilde;a</label>
                                <?php echo form_error('password_confirmation'); ?>
                                <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" value="<?php echo set_value('password_confirmation'); ?>" placeholder="Confirmar contrase&ntilde;a">
                            </div>
                            <div class="form-group">
                                <label for="categoriasUsuario" class="control-label">Tipo de usuario</label>
                                <select class="form-control" name="id_categoria_usuario">
                                    {categorias_usuario}
                                        <option value="{id}">{categoria}</option>
                                    {/categorias_usuario}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputTwitter" class="control-label">Twitter</label>
                                <?php echo form_error('twitter'); ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon-tw">@</span>
                                    <input type="text" class="form-control" id="inputTwitter" name="twitter" value="<?php echo set_value('twitter'); ?>" placeholder="Twitter" aria-describedby="sizing-addon-tw">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFacebook" class="control-label">Facebook</label>
                                <?php echo form_error('facebook'); ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon-fb">@</span>
                                    <input type="text" class="form-control" id="inputFacebook" name="facebook" value="<?php echo set_value('facebook'); ?>" placeholder="Facebook" aria-describedby="sizing-addon-fb">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputInstagram" class="control-label">Instagram</label>
                                <?php echo form_error('instagram'); ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon-ig">@</span>
                                    <input type="text" class="form-control" id="inputInstagram" name="instagram" value="<?php echo set_value('instagram'); ?>" placeholder="Instagram" aria-describedby="sizing-addon-ig">
                                </div>
                            </div>
                            <?php if($administrador): ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="administrador">
                                        <strong>Hacer este usuario administrador.</strong>
                                    </label>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">Registrar</button>
                            </div>
                            <p class="text-center small">
                                <a href="<?= base_url('inicio') ?>"> 
                                <i class="fa fa-times"></i>
                                Cancelar registro </a>
                            </p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>