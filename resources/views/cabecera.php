<html>
<head>
<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
<?php
echo "<div class='cabecera'>";
echo "<h1>Los Angeles Lakers</h1>";

echo "<nav><ul class='nav'><li><a href='/'>Pagina principal</a></li><li><a href='/historia'>Historia</a></li><li><a href='/jugadores'>Jugadores</a></li><li><a href='/partidos'>Partidos</a></li><li><a href='/noticias'>Noticias</a></li>";
if(Session::has('idSesion')){
    echo "<li><img class='imagen' src='imagenes/avatares/avatar" . Session::get('idSesion') . "." . Session::get('avatarSesion') . "'><ul><li><a href='/preferencias'>Preferencias</a></li><li><a href='/logout'>Logout</a></li></ul></li>";
}else{
    echo "<li><a href='/registro' class='registro'>Registro</a></li><li><a href='/login'>Login</a></li>";
}


echo "</ul></nav></div>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
?>



</body>
</html>
