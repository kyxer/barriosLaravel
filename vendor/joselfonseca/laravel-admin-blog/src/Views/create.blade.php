@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : 'Articulo'}}
@endsection
@section('styles')
    <link href="{{asset('vendor/image-manager/css/imagemanager.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/image-manager/vendors/colorbox/colorbox.css')}}" rel="stylesheet">
@endsection
@section('content')

    <div class="container-fluid admin">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Crear artículo
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-10">
                        @include('flash::message')
                    </div>
                </div>
                {!! Form::open(['url' => 'backend/blog/']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for='titulo'>Titulo</label>
                            {!! Form::text('title',null, ['class' => 'form-control']) !!}
                            @if($errors->has('title'))
                                <span class="text-danger">{{$errors->first('title')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for='titulo'>Caretogias</label>
                            {!! Form::select('categories[]',$categories, null, ['class' => 'form-control selectBootstrap', 'multiple' => 'multiple']) !!}
                            @if($errors->has('categories'))
                                <span class="text-danger">{{$errors->first('categories')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for='titulo'>Tags</label>
                            {!! Form::select('tags[]',$tags, null, ['class' => 'form-control selectBootstrap', 'multiple' => 'multiple']) !!}
                            @if($errors->has('tags'))
                                <span class="text-danger">{{$errors->first('tags')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for='titulo'>Publicado</label>
                            {!! Form::select('published',['0' => 'No', '1' => 'Si'], 1, ['class' => 'form-control selectBootstrap']) !!}
                            @if($errors->has('published'))
                                <span class="text-danger">{{$errors->first('published')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for='titulo'>Imagen del Post</label>
                            {!! ImageManager::getField(['text' => 'Select the File', 'class' => 'btn btn-primary', 'field_name' => 'image']) !!}
                            @if($errors->has('image'))
                                <span class="text-danger">{{$errors->first('image')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for='intro'>Introducción</label>
                            {!! Form::textarea('intro',null, ['class' => 'form-control']) !!}
                            @if($errors->has('intro'))
                                <span class="text-danger">{{$errors->first('intro')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for='titulo'>Cuerpo</label>
                            {!! Form::textarea('body',null, ['class' => 'form-control editor']) !!}
                            @if($errors->has('body'))
                                <span class="text-danger">{{$errors->first('body')}}</span>
                            @endif
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/vendor/image-manager/js/imageManager.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('') }}/assets/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="{{ url('') }}/assets/tinymce/tinymce_editor.js"></script>
    <script type="text/javascript">
        editor_config.selector = ".editor";
        editor_config.path_absolute = "{{url()}}/";
        tinymce.init(editor_config);
    </script>
@endsection