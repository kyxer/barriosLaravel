@include('frontend.forms.recover')
@section('modalRecover')
    <div id="modalRecover" class="modal fade bs-example-modal-sm jq-recover" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title text-center"><i class="ion-key"></i> Recuperar Contraseña </h5>
                </div>
                <div class="panel-body">
                    @yield('recoverForm')
                </div>
            </div>
        </div>
    </div>
@stop