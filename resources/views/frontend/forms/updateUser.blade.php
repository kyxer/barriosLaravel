@section('updateUserForm')
     @if(isset($successUpdate))
        <div class="alert alert-dismissible alert-success" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Bien hecho!</strong>  Exito al actualizar tú informacion.
        </div>
    @endif
    @if($errors->has())
        <div class="alert alert-dismissible alert-danger jq-alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Error!</strong>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    {!! Form::open(['route'=>'updateUserProfile', 'role' => 'form', 'name' => 'updateUserForm', 'id'=>'updateUserForm', 'data-toggle' => 'validator' ]) !!}

    <fieldset>
            <legend>Edita tu Pérfil
                @if(Auth::user()->is_verify == 0)
                    <span class="label label-info jq-verify-alert">No verificado</span>
                @else
                    <span class="label label-primary">Verificado</span>
                @endif
            </legend>
            <div class="form-group">
                <label for="name" class="col-lg-3 control-label">Nombre de Pila</label>
                <div class="col-lg-9">
                    <input type="text" value="@if(Request::old('first_name')){{ Request::old('first_name')  }}@else{{ Auth::user()->first_name  }}@endif" data-maxlenght-error="Longitud del Nombre excedida 30" class="form-control" name="first_name" maxlength="30" placeholder="Nombre de Pila" required >
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="lastName" class="col-lg-3 control-label">Apellido</label>
                <div class="col-lg-9">
                    <input type="text" value="@if(Request::old('last_name')){{ Request::old('last_name') }}@else{{ Auth::user()->last_name  }}@endif" data-maxlenght-error="Longitud del Apellido excedida 30" class="form-control" maxlength="30" name="last_name" placeholder="Apellido">
                    <div class="help-block with-errors"></div>
                </div>

            </div>
            <div class="form-group">
                <label for="email" class="col-lg-3 control-label">Correo</label>
                <div class="col-lg-9">
                    <input type="email" id="email" value="@if(Request::old('email')){{ Request::old('email')  }}@else{{ Auth::user()->email  }}@endif" class="form-control" name="email" data-error="El correo de seguir esta forma ejemplo.correo@dominio.com" pattern="^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$"  placeholder="Correo" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-lg-3 control-label">Repetir Correo</label>
                <div class="col-lg-9">
                    <input type="email" value="@if(Request::old('email_confirmation')){{ Request::old('email_confirmation')  }}@else{{ Auth::user()->email  }}@endif" class="form-control" data-match-error="Correos no coinciden" data-match="#email" name="email_confirmation"  placeholder="Repetir Correo">
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="postal_code" class="col-lg-3 control-label">Código Postal</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" value="@if(Request::old('postal_code')){{ Request::old('postal_code')  }}@else{{ Auth::user()->postal_code  }}@endif" data-maxlength-error="Logintud de Código Postal excedida 5" data-minlength-error="Logintud de Código Postal minima 5" data-minlength="5" maxlength="5" data-pattern="/^\d+$/" name="postal_code" placeholder="Código Postal" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-lg-3 control-label">Teléfono</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" value="@if(Request::old('phone')){{ Request::old('phone')  }}@else{{ Auth::user()->phone  }}@endif" name="phone" maxlength="20" placeholder="Teléfono">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-lg-3 control-label">Dirección</label>
                <div class="col-lg-9">
                    <textarea class="form-control" maxlength="200" rows="3" name="address">@if(Request::old('address')){{ Request::old('address')  }}@else{{ Auth::user()->address  }}@endif</textarea>
                    <span class="help-block">Al darnos tú dirección podremos ofrecerte una mejor atención</span>
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