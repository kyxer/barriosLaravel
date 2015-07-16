@include('frontend.forms.avatar')
@section('modalAvatar')
    <div id="modalAvatar" class="modal fade bs-example-modal-sm jq-avatar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title text-center">Seleccionar Avatar</h5>
                </div>
                <div class="panel-body">
                    @yield('avatarForm')
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary"  data-dismiss="modal"  >Terminar</button>
                </div>
            </div>
        </div>
    </div>
@stop