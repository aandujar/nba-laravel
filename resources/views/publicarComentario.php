<?php
$idNoticia = $_POST['idNoticia'];
$_SESSION['errorComentario'] = false;
$_SESSION['errorComentario2'] = false;

if(isset($_COOKIE["cookieUsuario"])){
    if(!empty($_POST['comentario'])){
        $sql = 'SELECT id from usuarios WHERE nombreUsuario = :nombre';
        $sth = $conexion->prepare($sql);
        $sth->bindParam(':nombre',$_SESSION['username'],PDO::PARAM_STR);
        $sth->execute();
        $resultado = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $row) {
            $idUser = $row['id'];
        }
        $comentario = strip_tags($_POST['comentario']);
   

        $sql2 = 'INSERT INTO comentarios (comentario,idUsuario,idNoticia) VALUES (:comentario,:idUsuario,:idNoticia)';
        $sth2 = $conexion->prepare($sql2);
        $sth2->bindParam(':comentario',$comentario,PDO::PARAM_STR);
        $sth2->bindParam(':idUsuario',$idUser,PDO::PARAM_INT);
        $sth2->bindParam(':idNoticia',$idNoticia,PDO::PARAM_INT);
        $sth2->execute();
    }else{
        $_SESSION['errorComentario2'] = true;
    }
}else{
    $_SESSION['errorComentario'] = true;
}

$ruta = "/noticia/" . $idNoticia; 
header("Location:" . $ruta);

