 <footer class="push">
    <div class="container">
        <div class="row">
            <div class="col-xs-5">
                <h4>Newsletter</h4>
                <p>Suscríbete y entérate de las cosas que pasan por el barrio.</p>
                <form class="form-inline">
                      <div class="form-group">
                            <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                                  <input type="email" class="form-control" id="email-newsletter" placeholder="Email">
                            </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Suscribir</button>
                </form>
            </div>
            <div class="col-xs-3">
                <div class="secciones">
                    <h4>Secciones</h4>
                    <ul class="bullets">
                        @if(session()->has('barrio'))
                            <li><a style="color:white" href="/{{ session()->get('barrio')->url_name }}/actividades">Actividades</a></li>
                            <li><a style="color:white" href="/{{ session()->get('barrio')->url_name }}/foros">Foros</a></li>
                        @endif
                        <li>¿Quiénes somos?</li>
                        <li><a style="color:white" href="{{ URL::route('blogView') }}">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="contacto">
                    <h4>Contacto</h4>
                    <ul>
                        <li class="mail"><strong>Email:</strong> contacto@barrioos.com</li>
                        <li class="adress"><strong>Dirección:</strong> Madrid, España</li>
                        <li class="phone"><strong>Teléfono:</strong> +34 699 456 722</li>
                        <li><i class="fa fa-facebook"></i>
                        <i class="fa fa-twitter"></i></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="copyright">
        <div class="container">
            <div class="credits">
                <div class="col-sm-6 col-xs-12 text-left">
                  {!! HTML::image('assets/images/barrioos.png', 'BarrioOS', array('width' => 'auto', 'height'=>'40px')) !!}
                </div>
                <div class="col-sm-6 col-xs-12 text-right">
                      <p>BarrioOS 2015 | Derechos Reservados</p>
                </div>
                <div class="clearfix"></div>
            </div>
      </div>
    </div>
</footer>