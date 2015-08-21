@extends('frontend.app')
@section('content')
<section id="section-one">
    <div class="col-1">
            <iframe width="580" height="326" src="https://www.youtube.com/embed/h8BQ9LJrXOQ?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="col-2">
        <h2>Personas + Tecnología + <br><strong>Cercanía Física</strong></h2>
        <p>Las mejores ideas e iniciativas de internet trabajando juntas en una sola plataforma para que vivir y trabajar en tu barrio sea aún mejor.</p>
        <a class="btn btn-default pull-right" href="#" role="button">Conoce más</a>
    </div>
    <div class="clearfix"></div>
</section>
<div class="gray">
    <section id="section-two">
        <div class="col-2">
            <h2>Siéntete orgulloso de ser <br> de tu Barrio</h2>
            <p>Descargate la app que te identifica como vecino de tu barrio o localidad y que además te ayuda, entre otras muchas cosas, a obtener descuentos y regalos en los comercios de tu barrio.</p>
        </div>
        <div class="col-1 text-right">
            {!! HTML::image('assets/images/app.png', 'App BarrioOS') !!}
        </div>
        <div class="clearfix"></div>
    </section>
</div>
<section id="section-three">
    <div class="col-12">
        <h1 class="text-center">Nuestros Embajadores</h1>
        <h3 class="text-center">Quienes nos están ayudando a cambar la forma de vivir <br>y trabajar en nuestro barrio.</h3>
    </div>
    <div class="embajador">
        {!! HTML::image('assets/images/foto.jpg', 'Persona', array('class'=>'img-circle')) !!}
        <h4>John Doe</h4>
        <h5>Cargo / Puesto</h5>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dol doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasitole architecto beatae vitae dicta.</p>
        <div class="social-share">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
        </div>
    </div>
    <div class="embajador">
        {!! HTML::image('assets/images/foto.jpg', 'Persona', array('class'=>'img-circle')) !!}
        <h4>John Doe</h4>
        <h5>Cargo / Puesto</h5>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dol doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasitole architecto beatae vitae dicta.</p>
        <div class="social-share">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
        </div>
    </div>
    <div class="embajador">
        {!! HTML::image('assets/images/foto.jpg', 'Persona', array('class'=>'img-circle')) !!}
        <h4>John Doe</h4>
        <h5>Cargo / Puesto</h5>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dol doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasitole architecto beatae vitae dicta.</p>
        <div class="social-share">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
        </div>
    </div>
    <div class="embajador">
        {!! HTML::image('assets/images/foto.jpg', 'Persona', array('class'=>'img-circle')) !!}
        <h4>John Doe</h4>
        <h5>Cargo / Puesto</h5>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dol doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasitole architecto beatae vitae dicta.</p>
        <div class="social-share">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
        </div>
    </div>
    <div class="embajador">
        {!! HTML::image('assets/images/foto.jpg', 'Persona', array('class'=>'img-circle')) !!}
        <h4>John Doe</h4>
        <h5>Cargo / Puesto</h5>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dol doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasitole architecto beatae vitae dicta.</p>
        <div class="social-share">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
        </div>
    </div>
    <div class="embajador">
        {!! HTML::image('assets/images/foto.jpg', 'Persona', array('class'=>'img-circle')) !!}
        <h4>John Doe</h4>
        <h5>Cargo / Puesto</h5>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dol doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasitole architecto beatae vitae dicta.</p>
        <div class="social-share">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
        </div>
    </div>
    <div class="embajador">
        {!! HTML::image('assets/images/foto.jpg', 'Persona', array('class'=>'img-circle')) !!}
        <h4>John Doe</h4>
        <h5>Cargo / Puesto</h5>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dol doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasitole architecto beatae vitae dicta.</p>
        <div class="social-share">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
        </div>
    </div>
    <div class="embajador">
        {!! HTML::image('assets/images/foto.jpg', 'Persona', array('class'=>'img-circle')) !!}
        <h4>John Doe</h4>
        <h5>Cargo / Puesto</h5>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dol doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasitole architecto beatae vitae dicta.</p>
        <div class="social-share">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
@stop