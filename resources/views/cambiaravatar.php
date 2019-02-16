<?php
if(empty($_POST["token"])){
    echo "Error al comprobar el token de seguridad";
}else{
   


if(empty($_FILES['nuevoAvatar']['name'])){//si no se ha seleccionado avatar indico error
    $_SESSION['avatarVacio']=true;
    header("Location: /preferencias");
}else{
        //indica ruta de avatares y recojo nombre de avatar
        $_SESSION["extensionIncorrecta"] = null;
        $rutaSubida = ROOT2 . DT . AVATARES . DT; 
        $nombreImagen = basename($_FILES['nuevoAvatar']['name']);
        if($_FILES["nuevoAvatar"]["type"]=="image/png" || $_FILES["nuevoAvatar"]["type"]=="image/jpg" || $_FILES["nuevoAvatar"]["type"]=="image/jpeg" || $_FILES["nuevoAvatar"]["type"]=="image/gif"){
            $comprobarTam = getimagesize($_FILES['nuevoAvatar']['tmp_name']);
            if($comprobarTam!=null){
        //obtengo extension
        $separarExtension = explode(".",$nombreImagen);
        $extension = $separarExtension[1];
        //inserto extension en bd
        $sql = 'UPDATE usuarios SET avatar = :extension WHERE nombreUsuario = :usuario';
        $sth = $conexion->prepare($sql);
        $sth->bindParam(':extension',$extension,PDO::PARAM_STR);
        $sth->bindParam(':usuario',$_SESSION['username'],PDO::PARAM_STR);
        $sth->execute();
        //obtengo id de usuario
        $sql2 = 'SELECT id FROM usuarios WHERE nombreUsuario = :user';
        $sth2 = $conexion->prepare($sql2);
        $sth2->bindParam(':user',$_SESSION['username'],PDO::PARAM_STR);
        $sth2->execute();
        $resultado = $sth2->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $row) {
            $id = $row['id'];
        }
        //nombre nuevo imagen
        $nuevoNombre = "avatar" . $id . "." .  $extension;
        //ruta nueva imagen
        $ficheroSubida = $rutaSubida . $nuevoNombre;
        $arrayDirectorio = scandir($rutaSubida);
        foreach($arrayDirectorio as $valor){
            //separa el nombre de los ficheros para quedarme con el id
            $separar = explode("r",$valor);
            $nombre = $separar[1];
            $separar2 = explode(".",$nombre);
            $nombre2 = $separar2[0];
            //si el id es el mismo del usuario, elimino el avatar
            if($nombre2==$id){
                $borrar = $rutaSubida . $valor;
                unlink($borrar);
            }
    }

    //si el archivo se sube correctamente
    if(is_uploaded_file($_FILES['nuevoAvatar']['tmp_name'])){
        if(move_uploaded_file($_FILES['nuevoAvatar']['tmp_name'], $ficheroSubida)){
            //cambio avatar del usuario en variable de sesion
            $_SESSION["avatar"] = $nuevoNombre;
            setcookie("cookieUsuario",$_SESSION["username"] . "/" . $_SESSION["avatar"],time()+604800);
            //redirijo a pagina principal
            header("Location: /");
        }else{
        //si hay error al cambiar el fichero
        $_SESSION["errorAvatar"]=true;
        header("Location: /preferencias");
        }
    }else{
        $_SESSION["extensionIncorrecta"] = "El fichero " . $nombreImagen . " no es un archivo de imagen. Debes subir un archivo de imagen";
        header("Location: /preferencias");
    }
}else{//else image size
    $_SESSION["extensionIncorrecta"] = "El fichero " . $nombreImagen . " no es un archivo de imagen. Debes subir un archivo de imagen";
    header("Location: /preferencias");
}
  
    }//fin if formato incorrecto
}//fin if avatar vacio
}//fin if token