<?php
use Illuminate\Support\Facades\DB;
?>
<html>
<head>
<meta charset="UTF-8">
<title>Noticias</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>
<body>
<?php
include "cabecera.php";
echo '<div class="noticia"><h2 class="titulo">' . $noticia->titulo . '</h2><p>' . $noticia->cuerpo . '</p>';

if(Session::has('error')){
    echo "<div class='mensajeError'>" . Session::get('error') . "</p></div>";
    Session::forget('error');
}

?>
<h2 class="tituloComentarios">Comentarios</h2>
<hr />
<form action="/publicarComentario" name="formulario" method="post">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="hidden" name="tokenUser" value="<?php echo Session::get('token') ?>">
<input type="text" name="comentario" class="formularioComentario"><br />
<input type="hidden" name="idNoticia" value="<?php echo $noticia->id ?>">
<input type="submit" value="Publicar comentario" class="botonComentario">
</form>

<?php
if(count($comentarios)>0){
    foreach($comentarios as $comentario){
        $userComentario = DB::select("SELECT nombreUsuario from usuarios where id = '$comentario->id'");
        echo '<div class="divComentario"><p>' . $comentario->id . ' - ' . $userComentario[0]->nombreUsuario . '</p>';
        echo '<p>'. htmlspecialchars($comentario->comentario) . '</p></div>';
    }
}else{
    echo '<p>Todavía no hay comentarios publicados</p>';
    
    }

echo '</div>';
?>

</body>
</html>
