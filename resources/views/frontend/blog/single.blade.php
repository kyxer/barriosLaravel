@extends('frontend.app')
@section('content')
<div class="container-fluid title">
  <div class="container">
      <div class="col-sm-10 col-sm-offset-1">
          <h1>Blog</h1>
          <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="{{ URL::route('blogView') }}">Blog</a></li>
              <li class="active">{{ $article['title'] }}</li>
            </ol>
      </div>
  </div>
</div>
<div class="container">
    <section class="bloghome">
        @include('frontend.blog.article', $article)
        <div class="row comments">
          <div class="col-sm-8 col-sm-offset-2">
            <h2 class="page-header">¿Tienes algo que decir? ¡Coméntanos!</h2>
                <form class="form-horizontal">
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" placeholder="Nombre">
                      </div>
                    </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="comentario-txt" class="col-sm-2 control-label">Comentario</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="comentario-txt" rows="3"></textarea>
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary pull-right">Enviar</button>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </form>
                    <div class="comment-list">
                      <!-- First Comment -->
                      <div class="row">
                        <div class="col-md-2 col-sm-2 hidden-xs">
                          <figure class="thumbnail">
                            <img class="img-responsive" src="images/avatar.jpg" />
                            <figcaption class="text-center">John Doe</figcaption>
                          </figure>
                        </div>
                        <div class="col-md-10 col-sm-10">
                          <div class="panel panel-default arrow left">
                            <div class="panel-body">
                              <header class="text-left">
                                <div class="comment-user"><i class="fa fa-user"></i> John Doe</div>
                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                              </header>
                              <div class="comment-post">
                                <p>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                              </div>
                              <p class="text-right"><a href="#" class="btn btn-primary btn-xs"><i class="fa fa-reply"></i> reply</a></p>
                            </div>
                          </div>
                        </div>
                    </div>
                      <!-- Second Comment Reply -->

                      <div class="row">
                        <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-1 hidden-xs">
                          <figure class="thumbnail">
                            <img class="img-responsive" src="images/avatar.jpg" />
                            <figcaption class="text-center">John Doe</figcaption>
                          </figure>
                        </div>
                        <div class="col-md-9 col-sm-9">
                          <div class="panel panel-default arrow left">

                            <div class="panel-body">
                              <header class="text-left">
                                  <h4>Reply</h4>
                                <div class="comment-user"><i class="fa fa-user"></i> John Doe</div>
                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                              </header>
                              <div class="comment-post">
                                <p>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                              </div>
                              <p class="text-right"><a href="#" class="btn btn-primary btn-xs"><i class="fa fa-reply"></i> reply</a></p>
                            </div>
                          </div>
                        </div>
                    </div>


                    </div>
                </div>
              </div>
    </section>
</div>
@stop