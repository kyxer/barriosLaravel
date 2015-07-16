@include('frontend.forms.searchBarrio')
@extends('frontend.app')
@section('content')
    <div class="jumbotron">
        @if(isset($register))
            <div class="alert alert-dismissible alert-warning">
                <button type="button" class="close" data-dismiss="alert" >×</button>
                <h4>Gracias por registrarte</h4>
                <p>Has recibido un email para que confirmes tu Dirección de correo.</p>
            </div>
        @endif
        @if(session()->has('barrio'))
            <h2>
                <i class="ion-beer"></i>  Bienvenidos a la <span class="text-primary" >WEB</span> del
                    <span class="text-success" >
                    {{ session()->get('barrio')->name }}
                    </span>
            </h2>
        @else
            <h2>Lo sentimos en estos momentos <span class="text-success">TU</span> barrio no esta en nuestra base de datos</h2>
            <h3>Intenta buscando otro</h3>
            @yield('searchBarrioForm')
        @endif
    </div>
@stop