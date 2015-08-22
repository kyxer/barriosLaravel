@section('changePasswordForm')

    @if(session()->has("password"))
        <div  class="alert alert-dismissible alert-success" >
            <button type="button" class="close" data-dismiss="alert" >×</button>
            <div >
                <strong>Excelente!</strong> Haz cambiado tu contraseña.
            </div>
        </div>
    @endif

    {!! Form::open(['route'=>'changePassword', 'role' => 'form', 'name' => 'changePasswordForm', 'id'=>'changePasswordForm', 'data-toggle' => 'validator' ]) !!}

    <fieldset>
        <legend>Cambia tu Contraseña</legend>

        <div class="form-group">
            <label for="name" class="col-lg-3 control-label">Actual Contraseña</label>
            <div class="col-lg-9">
                <input type="password" value="" data-maxlenght-error="Longitud de Actual Contraseña excedida 16" class="form-control" name="password_old" maxlength="16" placeholder=" Actual Contraseña" required >
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-lg-3 control-label">Nueva Contraseña</label>
            <div class="col-lg-9">
                <input id="password" type="password" value="" data-maxlenght-error="Longitud de Nueva Contraseña excedida 16" class="form-control" name="password" maxlength="16" placeholder="Nueva Contraseña" required >
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-lg-3 control-label">Repita Nueva Contraseña</label>
            <div class="col-lg-9">
                <input type="password" value="" data-maxlenght-error="Longitud de Nueva Contraseña excedida 16" data-match-error="Contraseñas no Coinciden" data-match="#password" class="form-control" name="password_confirmation" maxlength="16" placeholder="Nueva Contraseña" required >
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-9 col-lg-offset-3">
                {!! Form::submit('Actualizar',['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </fieldset>
    {!! Form::close() !!}
@stop