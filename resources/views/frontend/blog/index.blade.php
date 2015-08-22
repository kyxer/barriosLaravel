@extends('frontend.app')
@section('content')
<div class="container-fluid title">
  <div class="container">
      <div class="col-sm-10 col-sm-offset-1">
          <h1>Blog</h1>
          <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li class="active">Blog</li>
            </ol>
      </div>
  </div>
</div>
<div class="container">
    <section class="bloghome">
      @foreach($articles as $article)
        @include('frontend.blog.article', $article)
      @endforeach
    </section>
</div>
@stop