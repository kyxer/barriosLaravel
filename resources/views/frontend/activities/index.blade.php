@extends('frontend.app')
@section('content')
    <div class="container-fluid title">
        <div class="container">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Bienvenido a  las <span class="text-success" >ACTIVIDADES</span> de <span class="text-primary" >{{ $barrio['name']  }}</span></h1>
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="/{{ $barrio['url_name'] }}/">{{ $barrio['name'] }}</a></li>
                  <li class="active">Actividades</li>
                </ol>
            </div>
        </div>
    </div>
@stop