<header>
    <div class="fill hd-bg">
        <nav class="container">
            <div class="pull-left">
                <a href="/">{!! HTML::image('assets/images/barrioos.png', 'BarrioOS', array('width' => 'auto', 'height'=>'50px')) !!}</a>
            </div>
            <div class="pull-right">
                <ul>
                    <li>
                        <a class="btn btn-primary" href="{{ URL::route('loginView') }}" role="button">Ingresar</a>
                    </li>
                    <li class="visible-xs">
                        <a class="btn btn-primary" href="{{ URL::route('registerView') }}" role="button">Registrarse</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </nav>
        <div class="over-slider container">
            <div class="left">
                <div class="title">
                    <h1>Las mejores cosas <br>pasan cerca de tí.</h1>
                    <br>
                    <h3>Conecta con tu Barrio.</h3>
                </div>
                <div class="carousel">
                    <div class="carousel-caption text-center">
                        <h4>Un partido de futbol todas las semanas</h4>
                    </div>
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                </div>
            </div>
            <div class="right">
                <div class="form form-header">
                   <a href="{{ URL::route('loginWithProvider', ['povider'=>'facebook'])  }}">{!! HTML::image('assets/images/ingresafb.png', 'Ingresa con Facebook', array('width' => '280')) !!}</a>
                    <a class="btn blue btn-lg" href="{{ URL::route('loginView') }}">Ingresar</a>
                    <a class="btn blue btn-lg" href="{{ URL::route('registerView') }}">Registrarse</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <a href=""><i class="fa fa-chevron-down"></i></a>
        </div>
    </div>
</header>