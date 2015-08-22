<header>
  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle toggle-menu menu-right jPushMenuBtn" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">
            {!! HTML::image('assets/images/barrioos-iso.png', 'BarrioOS', array('width' => 'auto', 'height'=>'50px', 'id'=>'iso')) !!}
              @if(session()->has('barrio'))
                <i class="fa fa-heart"></i>
                Soy de
                {{ session()->get('barrio')->name }}
              @else
                Aun no tienes Barrio
              @endif
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
              <li><a>Grupos</a></li>
              <li><a href="#">Participación Ciudadana</a></li>
              <li><a href="#">Ofertas</a></li>
              <li><a href="#">Directorio</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }}<span class="caret"></span>
                </a>
                <ul class="dropdown-menu text-right">
                  <li><a href="{{ URL::route('profile') }}">Perfil</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{ URL::route('logout') }}">Cerrar Sesion</a></li>
                </ul>
              </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
</header>
