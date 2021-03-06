$('#login').on('click', function(event){
    $.post('/pretraga/login',
        {
            _token:__token,
            email:$('input[name=email]').val(),
            password:$('input[name=password]').val()
        },function(data){
            var rezultati=JSON.parse(data);
            if(rezultati.validator){
                errors = '<div id="poruka" class="alert alert-danger alert-autocloseable-danger"><ul>';
                $.each( rezultati.validator, function(key, value){
                    errors += '<li>' + value + '</li>';
                });
                errors += '</ul></div>';
                $('#greskaLogin').html(errors);
                $('#imam_nalog').show();
            }
            if(rezultati.uspesno){
                $('#imam_nalog').hide();
                /*$(".alert-autocloseable-danger").fadeTo(5000, 500).slideUp(500, function(){
                    $(".alert-autocloseable-danger").hide();
                });*/
                $('.modal-body').prepend('<div id="poruka" class="alert alert-success alert-autocloseable-success">Uspešno logovanje!</div>');
                $('#izlogovan').hide();
                /*$(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                    $(".alert-autocloseable-success").hide();
                });*/
                $('#lulogovan').toggle('show');
                $('#lime').text(rezultati.korisnik['ime']);
                $('#lprezime').text(rezultati.korisnik['prezime']);
                $('#lemail').text(rezultati.korisnik['email']);
            }
        }
    )
    /*$(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
        $(".alert-autocloseable-success").hide();
    });*/
});

$('#register').on('click', function(event) {
    var password = $("#password").val();
    //password  = password.replace(/./g, '*');
    var password_confirmation = $("#password_confirmation").val();
    //password_confirmation  = password_confirmation.replace(/./g, '*');console.log(password);
    $.post('/pretraga/register',
        {
            _token:__token,
            ime:$('input[name=ime]').val(),
            prezime:$('input[name=prezime]').val(),
            username:$('input[name=username]').val(),
            password:password,
            password_confirmation:password_confirmation,//$('input[name=password_confirmation]').val(),
            email:$('input[name=email1]').val(),
            telefon:$('input[name=telefon]').val(),
            adresa:$('input[name=adresa]').val(),
            grad:$('#gradr').val()
        },function(data){
            var rezultati=JSON.parse(data);
            if(rezultati.validator){
                $( '#poruka_neuspesna_reg' ).empty();
                errors = '<div class="alert alert-danger alert-autocloseable-danger"><ul>';
                $.each( rezultati.validator, function( key, value ) {
                    errors += '<li>' + value + '</li>';
                });
                errors += '</ul></div>';
                $( '#poruka_neuspesna_reg' ).append( errors );
            }
            if(rezultati.uspesno){
                $('.modal-body').prepend('<div id="poruka" class="alert alert-success alert-autocloseable-success">Uspešno ste registrovani!</div>');
                $('#izlogovan').hide();
                /*$(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                    $(".alert-autocloseable-success").hide();
                });*/
                $('#reg').hide();
                $('#lulogovan').toggle('show');
                $('#lime').text(rezultati.korisnik['ime']);
                $('#lprezime').text(rezultati.korisnik['prezime']);
                $('#lemail').text(rezultati.korisnik['email']);
            }
        }
    )
    /*$(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
        $(".alert-autocloseable-success").hide();
    });*/
});

$('#rezervisi').on('click', function(event){
    $.post('/pretraga/rezervisi',
        {
            _token:__token,
            datum_prijave: $('#inputPrijava1').val(),
            datum_odjave: $('#inputOdjava1').val(),
            broj_osoba:$('#brojosoba').val(),
            id_smestaja:$('#id_smestaja').val()
        },function(data){console.log(data);
            var rezultati=JSON.parse(data);
            if(rezultati.validator){
                $('.modal-body').prepend('<div id="poruka" class="alert alert-danger alert-autocloseable-danger">'+rezultati.validator+'</div>');
                /*$(".alert-autocloseable-danger").fadeTo(5000, 500).slideUp(500, function(){
                    $(".alert-autocloseable-danger").hide();
                });*/
            }
            if(rezultati.uspesno){ document.location = '/profil/rezervacije';
                /*$('.modal-body').prepend('<div id="poruka" class="alert alert-success alert-autocloseable-success">'+rezultati.uspesno+'</div>');
                $('#izlogovan').hide();*/
                /*$(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                    $(".alert-autocloseable-success").hide();
                });*/
                /*$('#rezervacija').modal('toggle');
                $('#uspesna_rezervacija').modal('toggle');*/
            }
        }
    );
    /*$(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
        $(".alert-autocloseable-success").hide();
    });*/
});

$(function(){
    $(".datepicker").each(function() {
        var d=$(this).val();
        $(this).datetimepicker({
            locale:'sr',
            format:'YYYY-MM-DD',
            defaultDate:d
        });
    });
    /*$('#inputPrijava1').datetimepicker();
    $('#inputOdjava1').datetimepicker();
    $('#inputPrijava1').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');
    $('#inputOdjava1').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');
    $('#inputPrijava').datetimepicker();
    $('#inputOdjava').datetimepicker();
    $('#inputPrijava').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');
    $('#inputOdjava').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');*/
    $('button.m').click(function(){
        $('#id_smestaja').val($(this).data('id'));
        var option = '';
        for (i=1; i <= $(this).data('broj_osoba'); i++){
            option += '<option value="'+i+'">'+i+'</option>';
        }
        $('#brojosoba').html(option)
    });
    $("button.zelja").click(function(){
        var btn=$(this);
        var id=btn.data("zid");
        $.post('/pretraga/like',
            {
                _token:__token,
                smestaj: btn.data("zid"),
                zelja: btn.data("zelja")
            },
            function(data){console.log(btn.data('zelja')!=false);
                btn.html("<i class='glyphicon glyphicon-heart'></i>");
                if(btn.data('zelja')!=false){
                    btn.data('zelja',false);
                    btn.removeClass('btn-danger').addClass('btn-info');
                } else{
                    btn.data('zelja',data);
                    btn.removeClass('btn-info').addClass('btn-danger');
                }
            }
        )
    });
    $('#imam_nalog_btn').on('click', function(event) {
        $('#reg').fadeOut();
        $('#imam_nalog').toggle('show');
    });
    $('#reg_btn').on('click', function(event) {
        $('#imam_nalog').fadeOut();
        $('#reg').toggle('show')
    })
})