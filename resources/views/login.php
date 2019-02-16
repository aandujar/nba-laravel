<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
include "cabecera.php";
?>
<div class="formulario">
<form action="/compruebaLogin" method="post" name="formularioLogin">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="text" class="log" name="user" PlaceHolder="Nombre de usuario">
    <br />
    <br />
    <input type="password" class="log" name="password" PlaceHolder="Password">
    <br />
    <br />
    <input type="submit" class="boton" name="enviar" value="OK">
</form>
</div>
<?php
    
    if(Session::has('error')){
        echo "<div class='mensajeError'>" . Session::get('error') . "</p></div>";
        Session::forget('error');
    }
    
    
?>
</body>
</html>
