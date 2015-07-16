/**
 * Created by German on 14/07/2015.
 */
$(document).ready(function(){

    /*$('input').change(function() {
        if(!$('.panel-body .has-feedback').hasClass('has-error')){
            $('#modalLogin .panel-body :submit').removeAttr('disabled','disabled');
        }
    });*/

    $('#avatar').fileupload({
        dataType: 'json',
        done: function (e, data) {
            var img = createImgTag(data.result.success.response.avatar_standar);
            $('#avatarStandar').html(img);
            $('#progressBar').css(
                'width','0%'
            );
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progressBar').css(
                'width',
                progress + '%'
            );
        }
    });



    var doAjax = function(identifier, beforeSend,success,error){
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        $.ajax({
            url: $('#'+ identifier).attr("action"),
            type: $('#'+ identifier).attr("method"),
            data: $('#'+ identifier).serialize(),
            beforeSend:beforeSend,
            success: success,
            error:error
        });
    };

    var createErrorMessaje = function(message){
        var html = '<div class="alert alert-dismissible alert-danger jq-alert">'+
            '<button type="button" class="close" data-dismiss="alert">×</button>'+
            '<strong>Error!</strong> '+ message +
            '</div>';

        return html;
    }

    var createSuccessMessaje = function (message) {
        var html = '<div class="alert alert-dismissible alert-success jq-success">'+
            '<button type="button" class="close" data-dismiss="alert">×</button>'+
            '<strong>Exito!</strong> '+ message +
            '</div>';

        return html;
    }

    var createImgTag = function(src){
        var img ='<img src='+src+' />';

        return img;
    }

    $('#loginForm').validator().on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            console.log($('#modalLogin .panel-body .has-feedback').hasClass('has-error'));
            if(!$('#modalLogin .panel-body .has-feedback').hasClass('has-error')) {

                doAjax('loginForm',
                    function () {
                        $('.jq-alert').remove();
                    },
                    function () {
                        window.location = "/";
                    },
                    function (response) {

                        var html = createErrorMessaje('Email o Contraseña Incorrecto.');
                        $('#modalLogin .panel-body form').before(html);
                        $('.jq-alert').fadeIn();
                        $('#modalLogin .panel-body .has-feedback')
                            .removeClass('has-success')
                            .addClass('has-error');
                        $('#modalLogin .panel-body :submit').addClass('disabled');

                    });
            }
        }
        e.preventDefault();
    });

    $('#registerForm').validator().on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            console.log($('#modalRegister .panel-body .has-feedback').hasClass('has-error'));
            if(!$('#modalRegister .panel-body .has-feedback').hasClass('has-error')) {

                doAjax('registerForm',
                    function () {
                        $('.jq-alert').remove();
                    },
                    function (response) {
                        //window.location = "/";
                        $('#modalRegister').modal('hide');
                        $('#modalAvatar').modal();

                        var img = createImgTag(response.success.response.avatar_standar);
                        $('#avatarStandar').html(img);

                    },
                    function (response) {
                        $.each(response.responseJSON.error.message, function( index, value ) {
                            var $sel = $('#modalRegister .panel-body .has-feedback [name='+index+']').parent();
                            $sel.removeClass('has-success').addClass('has-error');
                            $sel.children('.with-errors').html(value);
                        });
                        var html = createErrorMessaje('Hay varios errores al momento de registrarse');
                        $('#modalRegister .panel-body form').before(html);
                        $('.jq-alert').fadeIn();
                        $('#modalRegister .panel-body :submit').addClass('disabled');

                    });
            }
        }
        e.preventDefault();
    });

    $('#recoverForm').validator().on('submit', function (e) {
        if (!e.isDefaultPrevented()) {

            if(!$('#modalRecover .panel-body .has-feedback').hasClass('has-error')) {

                doAjax('recoverForm',
                    function () {
                        $('.jq-alert, .jq-success').remove();
                    },
                    function () {

                        //window.location = "/";
                        var html = createSuccessMessaje('Revisa tu email un correo ha sido enviado');
                        $('#modalRecover .panel-body form').before(html);
                        $('.jq-success').fadeIn();
                        $('#modalRecover .panel-body :submit').addClass('disabled');
                    },
                    function (response) {

                        var html = createErrorMessaje(response.responseJSON.error.message);
                        $('#modalRecover .panel-body form').before(html);
                        $('.jq-alert').fadeIn();
                        $('#modalRecover .panel-body .has-feedback')
                            .removeClass('has-success')
                            .addClass('has-error');
                        $('#modalRecover .panel-body :submit').addClass('disabled');

                    });
            }
        }
        e.preventDefault();
    });

    $('#modalAvatar').on('hidden.bs.modal', function (e) {
        window.location = '/';
    });

    $('.jq-verify-alert').on('click',function(e){
        $sel = $("#jq-container-verify");

        if($sel.is(':visible')){
            $sel.fadeOut();
        }else{
            $sel.fadeIn();
        }
    });

    $('.jq-manual-register').on('click', function (e) {
        $('#modalRecover').modal('hide');
        $('#modalLogin').modal('hide');
        $('#modalRegister').modal();
    });

    $('.jq-manual-login').on('click', function (e) {
        $('#modalRecover').modal('hide');
        $('#modalRegister').modal('hide');
        $('#modalLogin').modal();
    });

    $('.jq-manual-recover').on('click', function (e) {
        $('#modalRegister').modal('hide');
        $('#modalLogin').modal('hide');
        $('#modalRecover').modal();
    });



});
