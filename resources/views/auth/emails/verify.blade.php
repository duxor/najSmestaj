<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Hvala što ste se registrovali na platformu <b>Zubolog</b>!</h1>
        <h2>Potvrdite Vašu email adresu!</h2>
        <p>
            Da bi ste potvrdili registraciju kliknite na sledeći <a href="{{URL::to('register/verify/' . $verification)}}">LINK</a>.
        </p>
        <p>
            Ukoliko navedeni link nije u funkciji u svoj internet pregledač iskopirajte sledeću adresu: <i>{{URL::to('register/verify/' . $verification)}}</i>
        </p>
    </body>
</html>