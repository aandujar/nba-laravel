<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body>
<?php
    include "cabecera.php";
?> 


<form action="/comprobarRegistro" method="post" name="formularioRegistro" enctype="multipart/form-data">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="text" class="log" name="usuario" PlaceHolder="Nombre de usuario">
<br />
<br />
<input type="password" class="log" name="password" PlaceHolder="Password">
<br />
<br />
<input type="hidden" name="MAX_FILE_SIZE" value="1600000" />
Elige el avatar<input name="avatar" type="file" accept="image/*"/>
<br />
<br />
<input type="submit" class="boton" name="enviar" value="Crear usuario">
</form>
<?php
if(Session::has('error')){
        echo "<div class='mensajeError'>" . Session::get('error') . "</p></div>";
        Session::forget('error');
    }
?>
</body>
</html>
