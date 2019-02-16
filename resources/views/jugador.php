<html>
<head>
<title>Historia</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css">

</head>
<body>
<?php

include('cabecera.php');


echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";

echo "<table border=2 class='tabla'><tr><th>Codigo</th><th>Nombre</th><th>Procedencia</th><th>Altura</th><th>Peso</th><th>Posicion</th>";
foreach($jugador as $datos){
       echo "<tr><td>" . $datos->codigo . "</td>";
       echo "<td>" . $datos->Nombre . "</td>";
       echo "<td>" . $datos->Procedencia . "</td>";
       echo "<td>" . $datos->Altura . "</td>";
       echo "<td>" . $datos->Peso . "</td>";
       echo "<td>" . $datos->Posicion . "</td></tr>";
       $imagen = "../imagenes/" . $datos->codigo . ".jpg";
       echo '<tr><td colspan=7><img src="'. $imagen . '" height=400px width=100%></td></tr>';
}

echo "</table>";    

?>




</body>
</html>
