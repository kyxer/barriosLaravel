@section('verifyForm')
    {!! Form::open(['route'=>'sendVerify', 'role' => 'form', 'name' => 'verifyForm', 'id'=>'verifyForm' ]) !!}
        <input type="hidden" value="perfil" name="redirect_to" >
        {!! Form::submit('Solicitar Correo de Verificacion',['class'=>'btn btn-success']) !!}
    {!! Form::close() !!}
@stop