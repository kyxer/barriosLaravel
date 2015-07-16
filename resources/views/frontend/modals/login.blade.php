@include('frontend.forms.login')
@section('modalLogin')
    <div id="modalLogin" class="modal fade bs-example-modal-sm jq-login" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center"><i class="ion-log-in"></i> Inciar Sesión </h4>
                </div>
                <div class="panel-body">
                    @yield('loginForm')
                </div>
            </div>
        </div>
    </div>
@stop