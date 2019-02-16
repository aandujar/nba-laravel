<html>
<head>
<meta charset="UTF-8">
<title>Noticias</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
include "cabecera.php";
echo '<div class="noticia">';
foreach ($noticias as $noticia){
    echo '<div><a href="/noticia/' . $noticia->id . '"><h2>' . $noticia->titulo . '</h2></a></div>';
}
echo '</div>';
?>
</div>
</body>
</html>
