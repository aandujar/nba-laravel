<html>
<head>
<title>Jugadores</title>
</head>
<body>
<?php
include('cabecera.php');
?>
<br/>
<br/>
<br/>
<br/>
<?php
foreach($jugadores as $jugador){
        echo '<a href="/jugador/' . $jugador->codigo . '"><img class="imagen" src="imagenes/' . $jugador->codigo . '.jpg"></a>';
}
?>
</body>
</html>
