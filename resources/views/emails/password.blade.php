<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Cambio de Contraseña</h2>

<div>
    Para cambiar la contraseña complete este formulario:
    {{ URL::to('cambiar-contrasena', array($token)) }}.
</div>
</body>
</html>