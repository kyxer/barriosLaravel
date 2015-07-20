@section('loginForm')

    {!! Form::open(['route'=>'login', 'role' => 'form', 'name' => 'loginForm', 'id'=>'loginForm', 'data-toggle' => 'validator' ]) !!}
    <div class="form-group has-feedback">
        <input class="form-control input-lg" data-error="El correo de seguir esta forma ejemplo.correo@dominio.com" pattern="^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$" type="email" name="email" placeholder="Correo" required>
        <span class="ion-at form-control-feedback"></span>
        <div class="help-block with-errors" ></div>
    </div>
    <div class="form-group has-feedback">
        <input data-minlength-error="Minimo son 6 caracteres" data-minlength="6" maxlength="16" class="form-control input-lg" type="password" name="password" placeholder="Contraseña" required>
        <span class="ion-key form-control-feedback"></span>
        <div class="help-block with-errors"></div>
    </div>
    <!--<div class="checkbox">
        <label><input name="remember" type="checkbox"> Remember me</label>
    </div>-->
    <div>
        {!! Form::submit('Iniciar Sesion',['class' => 'btn btn-block btn-success']) !!}
    </div>
    {!! Form::close() !!}
    <p class="text-center text-muted">
        <small>¿Todavía no tienes una cuenta?
            <a class="jq-manual-register" >Registrate</a>
        </small><br>
        <small>
            <a class="jq-manual-recover" >¿Has olvidado tu contraseña?</a>
        </small>
    </p>
    <div class="signup-or-separator">
        <h6 class="text">O</h6>
        <hr>
    </div>
    <a href="{{ URL::route('loginWithProvider', ['povider'=>'facebook'])  }}">
        <button class="btn btn-block btn-facebook">
        <i class="ion-social-facebook"></i> Inicia Sesión con Facebook
        </button>
    </a>
@stop