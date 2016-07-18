$(function(){
    $('.kontaktBtn').click(function(){
        $('#kontaktPoruka').slideUp();
        var ime=$('#kontaktModal input[name=ime]').val(),
            email=$('#kontaktModal input[name=email]').val(),
            naslov=$('#kontaktModal input[name=naslov]').val(),
            poruka=$('#kontaktModal textarea[name=poruka]').val();
        if(!email || !poruka){
            $('#kontaktPoruka').html('Dogodila se greška! Proverite podatke i pokušajte ponovo!');
            $('#kontaktPoruka').slideDown();
            return
        }
        $.post('/kontakt',{
            _token:__token,
            ime:ime,
            email:email,
            naslov:naslov,
            poruka:poruka
        },function(data){
            data=JSON.parse(data);
            $('#kontaktPoruka').html(+data.poruka);
            $('#kontaktPoruka').slideDown();
            if(data.check==1){
                $('#kontaktModal input[name=ime]').val('');
                $('#kontaktModal input[name=email]').val('');
                $('#kontaktModal input[name=naslov]').val('');
                $('#kontaktModal textarea[name=poruka]').val('')
            }
        })
    })
})