<div class="mhead">
<h2>Registro de Usuario</h2>
</div>
<div class="mbody">
<div id="mensajes"><?php if(!empty($error)){echo "Por favor corregir los errores encontrados";}?></div>
<form action="" method="post" name="registrar" id="registrar" >
    <fieldset>
        <legend>Formulario de Registro</legend>
        <div>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" placeholder="usuario" required  value="<?php echo $datos['usuario']['value']??'';?>" />
            <div class="msg-error"><?php echo $error['usuario']??'';?></div>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="E-mail" required  value="<?php echo $datos['email']['value']??'';?>"  />
            <div class="msg-error"><?php echo $error['email']??'';?></div>
        </div>
        <div>
            <label for="password">Contraseña</label>
            <input type="text" name="password" id="password" placeholder="password"  />
            <div class="msg-error"><?php echo $error['password']??'';?></div>
        </div>
        <div>
            <label for="repassword">Confirmar Contraseña</label>
            <input type="text" name="repassword" id="repassword" placeholder="Repite el password" required />
            <div class="msg-error"><?php echo $error['repassword']??'';?></div>
        </div>
        <div>
            <input type="submit" name="registro" id="registro" value="Registrar Usuario" />
            <input type="hidden" name="alta" value="1" />
        </div>

    </fieldset>

</form>
</div><!-- /mbody -->
<div class="mfooter"></div>
