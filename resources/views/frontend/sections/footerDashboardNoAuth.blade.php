<footer>
    <div class="footer">
        <div class="col-5">
            <h4>Newsletter</h4>
            <p>Suscríbete y entérate de las cosas que pasan por el barrio.</p>
            <form>
                      <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                      <input type="email" class="form-control" id="email-newsletter" placeholder="Email">
                <button type="submit" class="btn btn-primary">Suscribir</button>
            </form>
        </div>
        <div class="col-3">
            <div class="secciones">
                <h4>Secciones</h4>
                <ul class="bullets">
                    <li>¿Quiénes somos?</li>
                    <li><a style="color:white" href="{{ URL::route('blogView') }}">Blog</a></li>
                </ul>
            </div>
        </div>
        <div class="col-4">
            <div class="contacto">
                <h4>Contacto</h4>
                <ul>
                    <li class="mail"><strong>Email:</strong> contacto@barrioos.com</li>
                    <li class="adress"><strong>Dirección:</strong> Madrid, España</li>
                    <li class="phone"><strong>Teléfono:</strong> +34 699 456 722</li>
                    <i class="fa fa-twitter"></i>
                    <i class="fa fa-facebook"></i>
                </ul>
            </div>
        </div>
    <div class="clearfix"></div>
    </div>
</footer>
<div id="copyright">
        <div class="credits">
            <div class="col-4 text-left">
                {!! HTML::image('assets/images/barrioos.png', 'BarrioOS', array('width' => 'auto', 'height'=>'25px')) !!}
            </div>
            <div class="col-8  text-right">
                <p>BarrioOS 2015 | Derechos Reservados</p>
            </div>
            <div class="clearfix"></div>
        </div>
</div>