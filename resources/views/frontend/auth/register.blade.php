@include('frontend.forms.register')
@extends('frontend.app')
@section('content')
<div class="container-fluid title">
    <div class="container">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
            <h1>Registro</h1>
        </div>
    </div>
</div>
<section class="wrapper-2">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
          @yield('registerForm')
      </div>
    </div>
  </div>
</section>
@stop