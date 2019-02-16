<?php
echo "aaaaaaaaaa";
    //recojo datos de formulario
    $user = trim($_POST["user"]);
    $password = $_POST["password"];
    echo $user . " " . $password;
    //$cookieCreada = false;
    //realizo consulta de usuario de la bda
    /*$sql = "SELECT id,nombreUsuario,password,avatar FROM usuarios WHERE nombreUsuario = '$user'";
    foreach($conexion->query($sql) as $row){
        if($row['nombreUsuario']!=null && password_verify($password,$row['password'])){
            //si  usuario no es nulo y contraseña es correcta, cookie creada es true, guardo nombre del avatar, creo cookie y redirijo a pagina principal
            $cookieCreada = true;
            $_SESSION['token'] = md5(uniqid(mt_rand(),true));
            //value de la cookie es igual al nombre y avatar del usuario
            $avatar = "avatar" . $row['id'] . "." . $row['avatar'];
            $usuario = $user . "/" . $avatar;
            setcookie("cookieUsuario",$usuario,time()+604800);
            header("Location: /");
       }
    }
      
    //si no se crea la cookie redirijo a login indicando error
    if($cookieCreada==false){
        $_SESSION["logueado"]="error";
        header("Location: /login");
    }