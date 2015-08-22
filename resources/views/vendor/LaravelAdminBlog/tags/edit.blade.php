@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : 'Editar Tag'}}
@endsection
@section('content')

    <div class="container-fluid admin">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Editar Tag
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-10">
                        @include('flash::message')
                    </div>
                </div>
                <div class="row">
                    {!! Form::model($tag, ['url' => 'backend/blog-tags/'.$tag->id, 'method' => 'PUT']) !!}
                    <div class="col-md-10 col-lg-offset-1">
                        <div class="form-group">
                            <label for='titulo'>Nombre del Tag</label>
                            {!! Form::text('name',null, ['class' => 'form-control']) !!}
                            @if($errors->has('name'))
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection