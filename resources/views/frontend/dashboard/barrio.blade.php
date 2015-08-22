@extends('frontend.app')
@section('content')
    <div class="container-fluid title">
        <div class="container">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Bienvenidos a la <span class="text-success" >WEB</span> del <span class="text-primary" >{{ $barrio['name']  }}</span></h1>
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li class="active">{{ $barrio['name'] }}</li>
                </ol>
            </div>
        </div>
    </div>
@stop