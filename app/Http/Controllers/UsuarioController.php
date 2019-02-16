<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
Use Session;
use Hash;

class UsuarioController extends Controller{

    public function comprobarLogin(){
        $user = trim($_POST["user"]);
        $password = $_POST["password"];
        $datosUser = DB::table('usuarios')->select('id','nombreUsuario','password','avatar')->where("nombreUsuario",$user)->first();
        if(($datosUser!=null)  && (password_verify($password,$datosUser->password))){
            Session::put('idSesion', $datosUser->id);
            Session::put('userSesion', $datosUser->nombreUsuario);
            Session::put('avatarSesion', $datosUser->avatar);
            Session::put('token', md5(uniqid(mt_rand(),true)));
            return view('/primera');
         }else{
            Session::put('error', 'El usuario o la contraseña introducidos no son correctos');
            return view('/login');
        }
    }

    public function logout(){
        session()->flush();
        return view('/primera');
    }

    public function comprobarRegistro(){
        if(($_POST["usuario"]!=null) && ($_POST["password"]!=null) && ($_FILES["avatar"]["name"]!=null)){
            if((($_FILES["avatar"]["type"]=="image/png") || ($_FILES["avatar"]["type"]=="image/jpg") || ($_FILES["avatar"]["type"]=="image/jpeg") || ($_FILES["avatar"]["type"]=="image/gif")) && (@getimagesize($_FILES["avatar"]["tmp_name"]))){
                $user = trim($_POST["usuario"]);
                $userSaneado = strip_tags($user);
                $password = strip_tags(Hash::make($_POST["password"]));
                $avatar = basename($_FILES["avatar"]["name"]);
                $separarAvatar = explode(".",$avatar);
                $extensionAvatar = $separarAvatar[1];
               try{
                    $usuarioExiste = DB::table('usuarios')->select('nombreUsuario')->where("nombreUsuario",$user)->first();
                    if($usuarioExiste==null){
                        DB::table('usuarios')->insert([
                            ['nombreUsuario'=>$user,'password'=>$password,'avatar'=>$extensionAvatar]
                        ]);
                        Session::put('idSesion', DB::getPdo()->lastInsertId());
                        Session::put('userSesion', $user);
                        Session::put('avatarSesion', $extensionAvatar);
                        Session::put('token', md5(uniqid(mt_rand(),true)));
                        $subirAvatar = "imagenes/avatares/" . "avatar" . Session::get('idSesion') . "." . $extensionAvatar;
                        move_uploaded_file($_FILES['avatar']['tmp_name'], $subirAvatar);
                        return view('/primera'); 
                    }
                }catch(PDOException $e){
                    Session::put('error',"Ha ocurrido un error. Vuelva a intentarlo más tarde");
                    return view('/registrarse');
                }
            }else{
                Session::put('error',"Formato de imagen incorrecto. Debes subir una imagen válida");
                return view('/registrarse');
            }
        }else{
            Session::put('error',"Debes completar todos los campos");
            return view('/registrarse');
        }
    } 
    
}
