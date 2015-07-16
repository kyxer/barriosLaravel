@section('searchBarrioForm')
    {!! Form::open(['route'=>'searchBarrio', 'role' => 'form', 'name' => 'searchBarrioForm', 'id'=>'searchBarrioForm', 'data-toggle' => 'validator' ]) !!}
        @if($errors->has())
            <div class="alert alert-dismissible alert-danger jq-alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Error!</strong>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon ion-location"></span>
                <input data-minlength="5" maxlength="5" name="postal_code" type="text" placeholder="Introduce un codigo postal para la busqueda" data-pattern="/^\d+$/" class="form-control" required >
                <span class="input-group-btn">
                    {!! Form::submit('Ir',['class' => 'btn btn-success']) !!}
                </span>
            </div>
        </div>

    {!! Form::close() !!}
@stop