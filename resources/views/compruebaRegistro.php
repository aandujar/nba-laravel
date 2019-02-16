<?php

$user = trim($_POST["usuario"]);
$password = crypt($_POST["password"]);
$avatar = basename($_FILES["avatar"]["name"]);
$separarAvatar = explode(".",$avatar);//separo nombre avatar
    $extensionAvatar = $separarAvatar[1];//guardo la extension
    try{
        $sql = 'SELECT nombreUsuario FROM usuarios WHERE nombreUsuario = :user';//ejecuto consulta para obtener usuario
        $sth = $conexion->prepare($sql);
        $sth->bindParam(':user',$user,PDO::PARAM_STR);
        $sth->execute();
        $resultado = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultado as $row){//recorro array de usuarios
            if(!$row['nombreUsuario']==null){//si la consulta no es nula el usuario existe
                echo "existe";
                $_SESSION["usuarioExiste"] = true;
            }
        }
        if($_SESSION["usuarioExiste"]==false){//si el usuario no existe en la base de datos
            $sql2 = 'INSERT INTO usuarios(nombreUsuario,password,avatar) VALUES (:nombreUsuario,:password,:extensionAvatar)';
            $sth2 = $conexion->prepare($sql2);//preparo consulta para crear usuario bda
            $sth2->bindParam(':nombreUsuario',$user,PDO::PARAM_STR);
            $sth2->bindParam(':password',$password,PDO::PARAM_STR);
            $sth2->bindParam(':extensionAvatar',$extensionAvatar,PDO::PARAM_STR);
            $sth2->execute();//lo inserto
            //busco a usuario en bd para obtener id y modifico cookie para loguear a usuario
            $sql3 = 'SELECT id FROM usuarios WHERE nombreUsuario = :user';
            $sth3 = $conexion->prepare($sql3);
            $sth3->bindParam(':user',$user,PDO::PARAM_STR);
            $sth3->execute();
            $resultado2 = $sth3->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultado2 as $row) {
                $id = $row['id'];
            }
            $fichero = "avatar" . $id . "." . $extensionAvatar;
            $rutaSubida = $rutaSubida = ROOT2 . DT . AVATARES . DT . $fichero;
            $informacionUsuario = $user . "/" . $fichero;
            //si el archivo se sube correctamente
            if(move_uploaded_file($_FILES['avatar']['tmp_name'], $rutaSubida)){
                //modifico la cookie
                setcookie("cookieUsuario",$user . "/" . $fichero,time()+604800);
                //redirijo a pagina principal
                header("Location: /");
            }
        }else{
            $_SESSION["usuarioExiste"] = true;
            header("Location: /registro");//indico que usuario existe y redirijo a registro
        }

    }catch(PDOException $e){
        //redirijo a pagina de registro indicando error en la bd
        $_SESSION["errorBD"] = true;
        header("Location: /registro");
    }
    }else{
        $_SESSION["extensionIncorrecta"] = "El fichero " . $avatar . " no es un archivo de imagen. Debes subir un archivo de imagen";
        header("Location: /registro");
    }

}
