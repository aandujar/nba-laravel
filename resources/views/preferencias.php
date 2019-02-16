<html>
<head>
<meta charset="UTF-8">
<title>Preferencias</title>
<link rel="stylesheet" type="text/css" href="<?=ROOT . DT . VISTAS . DT . 'style.css'?>">
</head>
<body>
<?php
include "cabecera.php";
echo "<h1>Bienvenido ".$_SESSION['username']."</h1>";
?>

<div class="formulario">
<form enctype="multipart/form-data" action="/cambiaravatar" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="1600000" />
Elige la nueva imagen<input name="nuevoAvatar" type="file" accept="image/*">
<input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
<input type="submit" value="Cambiar avatar" />
</form>
</div>

<?php
//si ha habido error al cambiar avatar muestro mensaje
if($_SESSION["errorAvatar"]==true){
    echo "<div class='mensajeError'>";
    echo "<p>Error al cambiar avatar. Vuelve a intentarlo</p></div>";
    //modifico la variable para que desaparezca el mensaje de error al cambiar la pagina
    $_SESSION["errorAvatar"]=false;
}
if($_SESSION["avatarVacio"]==true){
    echo "<div class='mensajeError'>";
    echo "<p>Debes seleccionar un avatar</p></div>";
    //modifico la variable para que desaparezca el mensaje de error al cambiar la pagina
    $_SESSION["avatarVacio"]=false;
}
if($_SESSION["extensionIncorrecta"]!=null){
    echo "<div class='mensajeError'>";
    echo $_SESSION["extensionIncorrecta"];
    //modifico la variable para que desaparezca el mensaje de error al cambiar la pagina
    $_SESSION["extensionIncorrecta"]=null;
}
if($_SESSION["errorToken"]==true){
    echo "<div class='mensajeError'>";
    echo "error token";
    //modifico la variable para que desaparezca el mensaje de error al cambiar la pagina
    $_SESSION["errorToken"]=false;
}

?>

</body>
</html>
