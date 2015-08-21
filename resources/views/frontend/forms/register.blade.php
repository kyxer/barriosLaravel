@section('registerForm')
    <!--<a href="{{ URL::route('loginWithProvider', ['povider'=>'facebook'])  }}">
        <button class="btn btn-block btn-facebook">
            <i class="ion-social-facebook"></i> Ingresa con Facebook
        </button>
    </a> -->
    <!--<form class="form-horizontal">
                    <div class="form-group">
                      <label for="inputName" class="col-sm-3 control-label hidepola">Nombre</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputName" placeholder="Nombre">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputCP" class="col-sm-3 control-label hidepola">Código Postal</label>
                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="inputCP" placeholder="Código Postal">
                      </div>
                    </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label hidepola">Email</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail4" class="col-sm-3 control-label hidepola">Repite tu Email</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label hidepola">Contraseña</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="Contraseña">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">Registro</button>
                    </div>
                  </div>
                </form> -->
    
    {!! Form::open(['route'=>'register', 'data-toggle' => 'validator',  'role'=>'form', 'id'=>'registerForm', 'class'=>'form-horizontal']) !!}

        <div class="form-group has-feedback">
          <label for="first_name" class="col-sm-3 control-label hidepola">Nombre</label>
          <div class="col-sm-9">
            <input class="form-control" type="text" id="first_name" name="first_name" data-minlength-error="Longitud minima requerida 3" data-minlength="3" maxlength="30" placeholder="Nombre de Pila" required>
            <div class="help-block with-errors">Nombre debe estar entre 3 y 30</div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label for="postal_code" class="col-sm-3 control-label hidepola">Código Postal</label>
          <div class="col-sm-9">
            <input class="form-control" type="text" id="postal_code" data-pattern-error="Formato incorrecto solo números" data-minlength-error="Longitud minima requerida 5" data-minlength="5"  maxlength="5" pattern="^\d+$" name="postal_code" placeholder="Código Postal" required>
            <div class="help-block with-errors">Exactamente 5 números </div>
          </div>
        </div>
        <div class="form-group has-feedback">
            <label for="email" class="col-sm-3 control-label hidepola">Correo</label>
            <div class="col-sm-9">
                <input class="form-control" type="email" id="email" name="email" maxlength="50" placeholder="Correo" data-error="El correo de seguir esta forma ejemplo.correo@dominio.com" pattern="^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$"  required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="email_confirmation" class="col-sm-3 control-label hidepola">Repita Correo</label>
            <div class="col-sm-9">
                <input class="form-control" type="email" id="email_confirmation" name="email_confirmation" data-match="#email" data-match-error="Correos no coinciden" placeholder="Repita Correo" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="password" class="col-sm-3 control-label hidepola">Contraseña</label>
            <div class="col-sm-9">
                <input class="form-control" type="password" id="password" data-minleght-error="Longitud mínima requerida 6" data-minlength="6" maxlength="16" name="password" placeholder="Contraseña" required>
                <div class="help-block with-errors" >Contraseña debe estar entre 6 y 16</div>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="password_confirmation" class="col-sm-3 control-label hidepola">Repita Contraseña</label>
            <div class="col-sm-9">
                <input class="form-control" type="password" id="password_confirmation" data-match="#password" data-match-error="Contraseñas no coinciden" name="password_confirmation" placeholder="Repita Contraseña" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 col-xs-12">
                Al hacer click en Registrarse, aceptas los <a href="">términos y condiciones</a> y la <a href="">política de privacidad</a>   
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              {!! Form::submit('Registrarse',['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        <!--
        <div class="form-group has-feedback">
            <input class="form-control input-lg" type="text" id="first_name" name="first_name" data-minlength-error="Longitud minima requerida 3" data-minlength="3" maxlength="30" placeholder="Nombre de Pila" required>
            <span class="ion-person form-control-feedback"></span>
            <div class="help-block with-errors">Nombre debe estar entre 3 y 30</div>
        </div>

        <div class="form-group has-feedback">
            <input class="form-control input-lg" type="email" id="re_email" name="email" maxlength="50" placeholder="Correo" data-error="El correo de seguir esta forma ejemplo.correo@dominio.com" pattern="^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$"  required>
            <span class="ion-at form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input class="form-control input-lg" type="email" id="email_confirmation" name="email_confirmation" data-match="#re_email" data-match-error="Correos no coinciden" placeholder="Repita Correo" required>
            <span class="ion-at form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>  

        <div class="form-group has-feedback" >
            <input class="form-control input-lg" type="password" id="password" data-minleght-error="Longitud mínima requerida 6" data-minlength="6" maxlength="16" name="password" placeholder="Contraseña" required>
            <span class="ion-key form-control-feedback"></span>
            <div class="help-block with-errors" >Contraseña debe estar entre 6 y 16</div>
        </div>

        <div class="form-group has-feedback">
            <input class="form-control input-lg" type="password" id="password_confirmation" data-match="#password" data-match-error="Contraseñas no coinciden" name="password_confirmation" placeholder="Repita Contraseña" required>
            <span class="ion-key form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div> -->

        <!--<div class="form-group has-feedback">
            <input class="form-control input-lg" type="text" id="postal_code" data-pattern-error="Formato incorrecto solo números" data-minlength-error="Longitud minima requerida 5" data-minlength="5"  maxlength="5" pattern="^\d+$" name="postal_code" placeholder="Código Postal" required>
            <span class="ion-location form-control-feedback"></span>
            <div class="help-block with-errors">Exactamente 5 números </div>
        </div> -->

        {!! Form::close() !!}
@stop