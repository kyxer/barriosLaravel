@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
{{isset($pageTitle) ? $pageTitle : 'Users'}}
@endsection
@section('content')

<div class="container-fluid admin">
	<div class="panel panel-primary">
		<div class="panel-heading">
			{{trans('LaravelAdmin::laravel-admin.usersListTitle')}}
		</div>
		<div class="panel-body">
			<div class="row">
        		<div class="col-lg-10">
        			@include('flash::message')
        		</div>
        		<div class="col-lg-2">
        			<a href="{{route('LaravelAdminUsersCreate')}}" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> {{trans('LaravelAdmin::laravel-admin.createUserTitle')}}</a>
        		</div>
        	</div>
        	<hr />
			{!! $table !!}	
		</div>
	</div>
</div>

@endsection
