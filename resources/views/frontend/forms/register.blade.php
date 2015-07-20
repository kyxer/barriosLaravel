@section('registerForm')
    {!! Form::open(['route'=>'register', 'data-toggle' => 'validator',  'role'=>'form', 'id'=>'registerForm']) !!}

        <div class="form-group has-feedback">
            <input class="form-control input-lg" type="text" id="first_name" name="first_name" data-minlength-error="Longitud minima requerida 3" data-minlength="3" maxlength="30" placeholder="Nombre de Pila" required>
            <span class="ion-person form-control-feedback"></span>
            <div class="help-block with-errors">Nombre debe estar entre 3 y 30</div>
        </div>

        <div class="form-group has-feedback">
            <input class="form-control input-lg" type="email" id="email" name="email" maxlength="50" placeholder="Correo" data-error="El correo de seguir esta forma ejemplo.correo@dominio.com" pattern="^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$"  required>
            <span class="ion-at form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input class="form-control input-lg" type="email" id="email_confirmation" name="email_confirmation" data-match="#email" data-match-error="Correos no coinciden" placeholder="Repita Correo" required>
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
        </div>

        <div class="form-group has-feedback">
            <input class="form-control input-lg" type="text" id="postal_code" data-pattern-error="Formato incorrecto solo números" data-minlength-error="Longitud minima requerida 5" data-minlength="5"  maxlength="5" data-pattern="/^\d+$/" name="postal_code" placeholder="Código Postal" required>
            <span class="ion-location form-control-feedback"></span>
            <div class="help-block with-errors">Exactamente 5 números </div>
        </div>

        <p class="text-center text-muted"><small>Al hacer clic en Registrarse, aceptas los <a href="">términos y condiciones</a> y la <a href="">política de privacidad</a></small></p>


        <div>
            {!! Form::submit('Registrarse',['class' => 'btn btn-block btn-primary']) !!}
        </div>
        <br>
    {!! Form::close() !!}
    <p class="text-center text-muted">
        <small>¿Ya tienes una cuenta?
            <a class="jq-manual-login" > Inicia Sesión ahora</a>
        </small>
    </p>
    <div class="signup-or-separator">
        <h6 class="text">O</h6>
        <hr>
    </div>
    <a href="{{ URL::route('loginWithProvider', ['povider'=>'facebook'])  }}">
        <button class="btn btn-block btn-facebook">
            <i class="ion-social-facebook"></i> Registrate con Facebook
        </button>
    </a>

@stop
