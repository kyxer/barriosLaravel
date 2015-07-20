@extends('frontend.app')
@section('content')

    <div class="center-form panel">
        <div class="panel-body" >
            @if(!session()->has('successReset'))
                @if($errors->has())
                    <div class="alert alert-dismissible alert-danger jq-alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Error!</strong>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                <h4 class="text-center"><i class="ion-key"></i> Cambia tu Contraseña</h4>
                {!! Form::open(['route'=>'reset', 'role' => 'form', 'name' => 'resetForm', 'id'=>'resetForm', 'data-toggle' => 'validator' ]) !!}

                    <div class="form-group has-feedback">
                        <input class="form-control input-lg" data-minlength-error="Longitud Minima Requerida 6" type="password" data-minlength="6" maxlength="16" id="password" name="password" placeholder="Introduzca Contraseña" required>
                        <span class="ion-key form-control-feedback"></span>
                        <div class="help-block with-errors" >Contraseña debe estar entre 6 y 16</div>
                    </div>
                    <div class="form-group has-feedback" >
                        <input data-minlength="6" maxlength="15" class="form-control input-lg" type="password" data-match-error="Contraseñas no coinciden" data-match="#password" name="password_confirmation" placeholder="Repita Contraseña" required >
                        <span class="ion-key form-control-feedback"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <input name="token" value="{{ $token }}" style="display:none">
                    {!! Form::submit('Cambiar',['class' => 'btn btn-block btn-success']) !!}
                {!! Form::close() !!}
            @else
                <div class="alert alert-dismissible alert-success">
                    <strong>Fabuloso!</strong><a href="/" class="alert-link">Cambiaste tu Contraseña</a>
                </div>
            @endif
        </div>
    </div>
@stop