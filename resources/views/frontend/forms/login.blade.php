@section('loginForm')
    {!! Form::open(['route'=>'login', 'role' => 'form', 'name' => 'loginForm', 'id'=>'loginForm', 'data-toggle' => 'validator', 'class' => 'form-horizontal' ]) !!}
    <div class="form-group has-feedback">
        <imput type="hidden" name="csrf-token" value="{{ csrf_token() }}">
        <label for="email" class="col-sm-2 control-label hidepola">Email</label>
        <div class="col-sm-10">
            <input class="form-control" data-error="El correo de seguir esta forma ejemplo.correo@dominio.com" pattern="^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$" type="email" name="email" placeholder="Correo" required>
            <div class="help-block with-errors" ></div>
        </div>
    </div>
    <div class="form-group has-feedback">
        <label for="password" class="col-sm-2 control-label hidepola">Contraseña</label>
        <div class="col-sm-10">
          <input data-minlength-error="Minimo son 6 caracteres" data-minlength="6" maxlength="16" class="form-control" type="password" name="password" placeholder="Contraseña" required>
          <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 col-xs-12">
          <div class="checkbox" id="ingresa">
            <label>
              <input type="checkbox"> Recordarme
              <a href="{{ URL::route('recoverView') }}">¿Olvidaste tu Contraseña?</a>
            </label>
          </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          {!! Form::submit('Iniciar Sesion',['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@stop