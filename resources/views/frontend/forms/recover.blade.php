@section('recoverForm')
    {!! Form::open(['route'=>'recover', 'role' => 'form', 'name' => 'recoverForm', 'id'=>'recoverForm', 'data-toggle' => 'validator' ]) !!}
        <div class="form-group has-feedback">
            <input class="form-control input-lg" id="email" type="email" name="email" placeholder="Correo" required>
            <span class="ion-at form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>
        {!! Form::submit('Recuperar',['class' => 'btn btn-block btn-success']) !!}
        <br/>
    {!! Form::close() !!}
    <p class="text-center text-muted">
        <small>¿Ya tienes una cuenta?
            <a class="jq-manual-login"> Inicia Sesión ahora</a>
        </small><br>
        <small>¿Todavía no tienes una cuenta?
            <a class="jq-manual-register"> Registrate</a>
        </small>
    </p>
@stop