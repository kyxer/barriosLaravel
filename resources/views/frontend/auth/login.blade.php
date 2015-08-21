@include('frontend.forms.login')
@extends('frontend.app')
@section('content')
  <div class="container-fluid title">
    <div class="container">
      <div class="col-sm-6 col-sm-offset-3 col-xs-12">
          <h1>Ingresa</h1>
      </div>
    </div>
  </div>
  <section class="wrapper">
    <div class="container form">
      <div class="row">
          <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
              @yield('loginForm')
          </div>
        </div>
    </div>
  </section>
@stop