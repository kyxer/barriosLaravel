<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Verifica tu cuenta</h2>

<div>
    Gracias por crear una cuenta en BarrioOS, para verificar tu cuenta click en el enlace:
    {{ URL::to('verificar-cuenta', array($verified_code)) }}.
</div>
</body>
</html>