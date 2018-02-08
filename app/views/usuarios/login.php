<div style="text-align:center" >
    <div class="aviso">
        <h2>IMPORTANTE!</h2>
        <br>
        <p> DEBE ESTAR LOGUEADO PARA ACCEDER A ESTA SECCIÓN</p>
        <br>
        <p>
        <span class="ingresar"><a href="<?= BASE_LINK;?><?= $seccion;?>/login#formLogin"><i class="fa fa-sign-in"></i>INGRESAR</a></span>
        </p>
    </div>    
</div>
  
<div id="formLogin" class="modal">
  <div class="modal-contenido col-30">
    <div class="cerrar-modal2"><a href="<?= BASE_LINK;?>"><i class="fa fa-times-circle"></i></a></div>  
        <div class="form-title">
            <h5>INGRESAR a BOLSA DE TRABAJO</h5>
        </div>

        <div class="mbody">
            <div id="mensajes" class="msg-error col-100"><?php if(!empty($error)&&!is_array($error)){echo $error;}?></div>

            <form action="<?= $seccion;?>/login#formLogin" method="post" id="form_login" >
                <fieldset>
                    <legend>Login</legend>
                    <div class="form-grupo col-100">
                        <label for="usuario"><i class="fa fa-user"></i>Usuario:</label><br>
                        <input type="text" name="usuario" id="usuario" class="" require placeholder="Usuario" value="@frro.utn.edu.ar" />@frro.utn.edu.ar
                        <div class="msg-error"><?php echo $error['usuario']??'';?></div>
                    </div>
                    <div class="form-grupo col-100">
                        <label for="password"><i class="fa fa-lock"></i>Contraseña: </label><br>
                        <input type="password" name="password" id="password" class="col-80" require placeholder="Contraseña" />
                        <div class="msg-error"><?php echo $error['password']??'';?></div>
                    </div>        
                </fieldset>
                <fieldset>
                    <div class="form-grupo col-95">
                        <input type="submit" value=" INGRESAR " name="ingresar" class="btn col-90" />
                    </div>
                </fieldset>
                <div class="form-footer">
                    <span><a href="<?= BASE_LINK;?><?= $seccion;?>/recuperarPass#formRecupass">Olvidé mi contraseña</a></span>
                    <span><a href="<?= BASE_LINK;?><?= $seccion;?>/login#apostillaEmailFrro">No tengo una cuenta frro</a></span>
                </div>
            </form>

        </div><!-- /mbody -->
        <div class="mfooter"></div>
    </div>  
</div>

<div id="formRecupass" class="modal2">
    <div class="modal2-contenido col-30">
        <div class="cerrar-modal2"><a href="#"><i class="fa fa-times-circle"></i></a></div>  
            <div class="form-title">
                <h5>Reestablecer contraseña</h5>
            </div>
            <div class="mbody">
            <div id="mensajes" class="msg-error col-100"><?php if(!empty($error)&&!is_array($error)){echo $error;}?></div>
            <div class="col-80" style="margin:0 auto;">Ingresá tu email y te enviaremos los pasos para reestablecer tu contraseña.</div>
            <form action="<?= $seccion;?>/recuperar#formRecupass" method="post" id="form_recupass" >
                <fieldset>
                    <legend>Reestablecer</legend>
                    <div class="form-grupo col-100">
                        <label for="email"><i class="fa fa-user"></i>EMAIL:</label><br>
                        <input type="text" name="email" id="email" class="" require placeholder="Usuario" />
                        @frro.utn.edu.ar
                        <div class="msg-error"><?php echo $error['email']??'';?></div>
                    </div>       
                </fieldset>
                <fieldset>
                    <div class="form-grupo col-95">
                        <input type="submit" value=" ENVIAR " name="recuperar" class="btn2 col-90" />
                    </div>
                </fieldset>
                <div class="form-footer">
                    <span><a href="<?= BASE_LINK;?><?= $seccion;?>/login#apostillaEmailFrro">No tengo una cuenta frro</a></span>
                </div>
            </form>

        </div><!-- /mbody -->
        <div class="mfooter"></div>
    </div>  
</div>


<div id="apostillaEmailFrro" class="modal3">
    <div class="modal3-contenido col-30">
        <div class="cerrar-modal3"><a href="#"><i class="fa fa-times-circle"></i></a></div>  
            <div class="form-title">
                <h5>Obtener el E-mail institucional</h5>
            </div>
            <div class="mbody">
               <p class="apostilla col-90">Para obtener una cuenta de correo <br> <strong>usuario@frro.utn.edu.ar </strong><br> es necesario que te acerques a 
                        la Secretaría de Asuntos Universitarios.<br>
                </p>
                <p style="text-align:center; padding-bottom:20px;" class="col-90">    
                    El horario de la Secretaría es Lunes a Viernes de 9:00 a 13:00 y de 17:00 a 21:00hs.
                </p>

            </div><!-- /mbody -->
        <div class="mfooter"></div>
    </div>  
</div>