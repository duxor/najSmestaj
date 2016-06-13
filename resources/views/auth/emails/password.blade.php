<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Hvala na ukazanom poverenju!</h1>
        <h1>Zubolog</h1>
        <p>
            Za oporavak Vaše pristupne šifre idite na sledeći <a href="{{url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">LINK</a>
        </p>
        <p>
            Ukoliko navedeni link nije u funkciji u svoj internet pregledač iskopirajte sledeću adresu: <i>{{url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}</i>
        </p>
    </body>
</html>