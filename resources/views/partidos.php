<html>
<head>
<meta charset="UTF-8">
<title>Partidos</title>
</head>
<body>
<?php
include "cabecera.php";

echo "<h3>Selecciona el año para ver los partidos disputados</h3>";
$temporadas = DB::select('SELECT DISTINCT temporada FROM partidos');
echo "<form method='GET' action='/partidos'>";
echo "<select name='lista' id='lista' onchange='this.form.submit()'>";
    

    foreach($temporadas as $temporada){
        echo '<option value="' . $temporada->temporada. '">' . $temporada->temporada . '</option>';
        
    }
   
    echo "</select>";
    
   
    

   if(isset($_GET['lista'])){
        $temporadaSeleccionada = $_GET['lista'];
        $partidos = DB::select("SELECT * FROM partidos WHERE temporada = :temp AND (equipo_local= 'Lakers' OR equipo_visitante = 'Lakers')",['temp'=>$temporadaSeleccionada]);
        echo "<table border=2>";
        echo "<tr><th>Código</th><th>Equipo Local</th><th>Equipo Visitante</th><th>Puntos Local</th><th>Puntos Visitante</th><th>Temporada</th></tr>";
        foreach ($partidos as $partido) {
            echo "<tr><td>" . $partido->codigo . "</td>";
            echo "<td>" . $partido->equipo_local . "</td>";  
            echo "<td>" . $partido->equipo_visitante . "</td>";
            echo "<td>" . $partido->puntos_local . "</td>";
            echo "<td>" . $partido->puntos_visitante . "</td>";
            echo "<td>" . $partido->temporada . "</td></tr>";
        }
        echo "</table>";
      }

?>
</div>
</body>
</html>



