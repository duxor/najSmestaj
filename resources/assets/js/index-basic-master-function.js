$(function(){
    $(".scrol a,.scrol").on('click', function(event){
        if($(this.hash).offset())
            event.preventDefault();
        var hash = this.hash;
        $('html, body').animate({
            scrollTop: $(hash).offset().top
        }, 900, function(){
            window.location.hash = hash
        })
    });
    $('#inputPrijava').datetimepicker();
    $('#inputOdjava').datetimepicker();
    $('#inputPrijava').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');
    $('#inputOdjava').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');
    $('.newsletterBtn').click(function(){
        $('#poruka').remove();
        var ime=$('#inputIme').val(),
            email=$('#inputEmail').val();
        if(!ime || !email){
            $($(this).closest('form').append('<div id="poruka"><h2>Dogodila se greška! Proverite podatke i pokušajte ponovo!</h2></div>'));
            return
        }
        $.post('/newsletter',{
            _token:__token,
            ime:ime,
            email:email
        },function(data){
            data=JSON.parse(data);
            $($(this).closest('form').append('<div id="poruka"><h2>'+data.poruka+'</h2></div>'));
            if(data.check==1){
                $('#inputIme').val('');
                $('#inputEmail').val('')
            }
        })
    });
    $('.tagovi input[type=checkbox]').change(function(){
        if(!$(this).data('tag')) return;
        var tagovi=$('.tagovi input[type=checkbox]'),tagoviArray=[];
        for(var i=0,max=tagovi.length; i<max; i++)
            if($(tagovi[i]).prop('checked')) tagoviArray.push($(tagovi[i]).data('tag'));
        $('input[name=tagovi]').val(JSON.stringify(tagoviArray))
    })
    $('.dodaci input[type=checkbox]').change(function(){
        if(!$(this).data('dodatak')) return;
        var dodaci=$('.dodaci input[type=checkbox]'),dodaciArray=[];
        for(var i=0,max=dodaci.length; i<max; i++)
            if($(dodaci[i]).prop('checked')) dodaciArray.push($(dodaci[i]).data('dodatak'));
        $('input[name=dodaci]').val(JSON.stringify(dodaciArray))
    })
});