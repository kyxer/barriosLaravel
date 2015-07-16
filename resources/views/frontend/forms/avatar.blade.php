@section('avatarForm')
    {!! Form::open(['route'=>'avatar', 'role' => 'form','files'=>true, 'name' => 'avatarForm']) !!}
        <div id="avatarStandar" class="form-group has-feedback text-center">
            @if(Auth::check())
                <img src='{{ Auth::user()->avatar_standar  }}' />
            @endif
        </div>
        <div class="form-group has-feedback text-center">
            <input class="col-lg-12" id="avatar" name="avatar"  style="height:36px;" type="file" />
            <button class="btn btn-default"> Seleccionar Avatar </button>
        </div>
        <div class="form-group has-feedback">
            <div class="progress">
                <div id="progressBar" class="progress-bar" style="width:0%;"></div>
            </div>
        </div>
    {!! Form::close() !!}
@stop