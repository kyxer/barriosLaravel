@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
{{isset($pageTitle) ? $pageTitle : 'Tags'}}
@endsection
@section('content')

<div class="container-fluid admin">
   <div class="panel panel-primary">
      <div class="panel-heading">
         Tags del Blog
      </div>
      <div class="panel-body">
         <div class="row">
              <div class="col-lg-10">
                 @include('flash::message')
              </div>
              <div class="col-lg-2">
                 <a href="{{url('backend/blog-tags/create')}}" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> Crear Tag</a>
              </div>
           </div>
           <hr />
         {!! $table !!}
      </div>
   </div>
</div>

@endsection