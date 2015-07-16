@extends('frontend.app')
@section('content')

<div class="center-form panel">
    <div class="panel-body" >
        @if($errors->has())
            <div class="alert alert-dismissible alert-danger">
                <strong>Error!</strong>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
                <br>
                <a href="/">Inicio</a>
            </div>
        @else
            <div class="alert alert-dismissible alert-success">
                <strong>Fabuloso!</strong>Tu cuenta ha sido Verificada
                <br>
                <a href="/" class="alert-link">Inicio</a>
            </div>
        @endif
    </div>
</div>

@stop