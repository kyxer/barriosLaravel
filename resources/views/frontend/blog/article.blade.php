<article>
    <div class="row blog-post">
        <div class="col-sm-1 col-sm-offset-1">
            <div class="date hidden-xs">
                <h4 class="number">
                    {{ $article['day'] }}
                </h4>
                <h6 class="month">
                    {{ $article['month'] }}
                </h6>
            </div>
        </div>
        <div class="col-sm-8">
            <h2><a href="">{{ $article['title'] }}</a></h2>
            @if(isset($single))
                <div class="blog-author inside">
                    <ul class="list-inline list-unstyled pull-right">
                        <li><span><a href="#"><i class="fa fa-user"></i> &nbsp;{{ $article['first_name']}} </a></span></li>
                        <li>|</li>
                        <li>
                            <span>
                                <a href="#"><i class="fa fa-clock-o"></i> &nbsp;{{ $article['spent_days'] }} </a>
                            </span>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            @endif;
            <div class="blog-image">
              <!--<img src="images/race.jpg" alt="Carrera Femenil">-->
            </div>
            <p>
                @if(isset($single))
                    {!! $article['body'] !!}
                @else
                    {{ $article['intro'] }}
                    <a class="btn btn-primary btn-xs readmore" href="{{ URL::route('articleView', ['slug'=>$article['slug']])  }}" role="button">Leer más...</a>
                @endif
            </p>
        </div>
    </div>
    <div class="row">
        @if(isset($single))
            <div class="col-sm-8 col-sm-offset-2 rrss">
                <h4>¿Te ha gustado el contenido?</h4>
                <ul class="list-inline list-unstyled">
                    <li><h4><span>¡Compártelo!</span></h4></li>
                    <li>
                    <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
                      <span><a href=""><i class="fa fa-facebook-square"></i></a><span class="badge">20</span></span>
                      <span><a href=""><i class="fa fa-twitter-square"></i></a><span class="badge">42</span></span>
                      <span><a href=""><i class="fa fa-google-plus-square"></i></a><span class="badge">16</span></span>
                    </li>
                </ul>
            </div>
        @else
            <div class="col-sm-8 col-sm-offset-2 blog-author">
                <ul class="list-inline list-unstyled">
                    <li>
                        <span><a href="#"><i class="fa fa-user"></i> &nbsp;{{ $article['first_name'] }} </a></span>
                    </li>
                    <li>|</li>
                    <li>
                        <span>
                            <a href="#"><i class="fa fa-clock-o"></i> &nbsp;{{ $article['spent_days'] }} </a>
                        </span>
                    </li>
                    <li>|</li>
                    <li>
                        <span>
                            <a href="#"><i class="fa fa-comments-o"></i> 0 comentarios</a>
                        </span>
                    </li>
                    <li class="pull-right" >
                        <span>
                            <a href=""><i class="fa fa-facebook-square"></i></a>
                        </span>
                        <span>
                            <a href=""><i class="fa fa-twitter-square"></i></a>
                        </span>
                        <span>
                            <a href=""><i class="fa fa-google-plus-square"></i></a>
                        </span>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</article>