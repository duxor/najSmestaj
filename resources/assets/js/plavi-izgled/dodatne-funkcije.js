$(function() {
    $(document).mouseup(function (e) {
        if (!$('.modal-dialog').is(e.target) && $('.modal-dialog').has(e.target).length === 0)
            $('.modal').slideUp()
    });
    $('[data-dismiss=modal]').click(function () {
        $('.modal').slideUp()
    });
    $('[data-toggle=modal]').click(function () {
        $('.modal-element').hide();
        $($(this).data('show')).show();
        $($(this).data('target')).slideDown();
    });
    $('#saljiNam').click(function () {
        $.post('/pisi-nam', {
            _token: __token,
            ime: $('input[name=ime]').val(),
            email: $('input[name=email]').val(),
            telefon: $('input[name=telefon]').val(),
            poruka: $('textarea[name=poruka]').val()
        }, function () {
            $('.modal-element').hide();
            $('#uspjeh').html('<h3>Sve ok!</h3>');
            $('#uspjeh').slideDown();
        })
    });
    PreInit('http://maps.google.com/maps/api/js?sensor=false',function(){
        google.maps.event.addDomListener(window, 'load', init)
    })
})
function init() {
    var coo = [44.815725,20.464665];
    var mapOptions = {
        zoom: 17,
        scrollwheel: false,
        draggable: false,
        center: new google.maps.LatLng(coo[0],coo[1]),
        styles: [{featureType:"road",elementType:"geometry",stylers:[{lightness:100},{visibility:"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#C6E2FF",}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#C5E3BF"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#D1D1B8"}]}]
    };
    var mapElement = document.getElementById('map');
    var map = new google.maps.Map(mapElement, mapOptions);
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(coo[0],coo[1]),
        map: map,
        icon:'/img/gmap_marker.png'
    });
}
function PreInit( url, callback ) {
    var script = document.createElement( "script" )
    script.type = "text/javascript";
    if(script.readyState){
        script.onreadystatechange = function() {
            if ( script.readyState === "loaded" || script.readyState === "complete" ) {
                script.onreadystatechange = null;
                callback();
            }
        };
    } else {
        script.onload = function() {
            callback();
        };
    }
    script.src = url;
    document.getElementsByTagName( "head" )[0].appendChild( script );
}

var _paq = _paq || [];
_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
(function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://analitika.dusanperisic.com//";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
    g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
})();

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-60752620-1', 'auto');
ga('send', 'pageview');