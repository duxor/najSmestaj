<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Verifikujte vašu email adresu!</h2>

<div>
    <p>Hvala što ste se registrovali na našu aplikaciju.</p>
    <p>Kliknite na dole navedeni link za aktivaciju naloga!</p>
    <p><a href="{{ URL::to('register/verify/' . $confirmation_code) }}">Link za aktivaciju</a></p>
    <p>Ukoliko imate problema sa linkom iynad, iskopirajte u vas web pretraživač sledeću web lokaciju: {{ URL::to('register/verify/' . $confirmation_code) }}</p>
</div>

</body>
</html>


