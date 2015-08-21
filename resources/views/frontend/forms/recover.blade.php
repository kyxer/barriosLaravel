@section('recoverForm')
    {!! Form::open(['route'=>'recover', 'role' => 'form', 'class'=>'form-horizontal', 'name' => 'recoverForm', 'id'=>'recoverForm', 'data-toggle' => 'validator' ]) !!}
        <div class="form-group has-feedback">
            <div class="col-sm-12">
                <input class="form-control" data-error="El correo de seguir esta forma ejemplo.correo@dominio.com" pattern="^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$" id="email" type="email" name="email" placeholder="Correo" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                {!! Form::submit('Recuperar',['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        <br/>
    {!! Form::close() !!}
@stop