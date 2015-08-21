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
        <a class="navbar-brand" href="/">{!! HTML::image('assets/images/barrioos.png', 'BarrioOS', array('width' => 'auto', 'height'=>'50px', 'id'=>'logo')) !!}</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right log">
            <li @if(isset($login)) class="active" @endif >  
                <a href="{{ URL::route('loginView') }}" class="text-uppercase">Ingresar</a>
            </li>
            <li class="separator">|</li>
            <li @if(isset($register)) class="active" @endif ><a href="{{ URL::route('registerView') }}" class="text-uppercase">Registrarse</a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>