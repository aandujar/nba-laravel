<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Noticia;
Use Session;

class NoticiaController extends Controller{
    
    public function getNoticia($id){
        $noticia = Noticia::find($id);
        $comentarios = DB::select("SELECT id,comentario,idUsuario FROM comentarios WHERE idNoticia = '$id'");
        return view('noticia')
            ->with('noticia',$noticia)
            ->with('comentarios',$comentarios);
    }

    public function getNoticias(){
        $noticias = Noticia::all();
        return view('noticias')
            ->with('noticias',$noticias);
    }

    public function publicarComentario(){
        $idNoticia = $_POST['idNoticia'];
        $token = $_POST['tokenUser'];
        if($token==Session::get('token')){
            if(Session::has('idSesion')){
                if(!empty($_POST['comentario'])){
                    $comentario = strip_tags($_POST['comentario']);
                    DB::table('comentarios')->insert([
                        ['comentario' => $comentario, 'idUsuario' => Session::get('idSesion'), 'idNoticia' => $idNoticia]
                    ]);
                }else{
                    Session::put('error', 'No puedes publicar comentarios vacíos');
                }
            }else{
                Session::put('error', 'Debes iniciar sesión para publicar comentarios');
            }
            $comentarios = DB::select("SELECT id,comentario,idUsuario FROM comentarios WHERE idNoticia = '$idNoticia'");
            $noticia = Noticia::find($idNoticia);
            return view('noticia')
                ->with('noticia',$noticia)
                ->with('comentarios',$comentarios);
        }else{
            return redirect()->to('/logout');
        }
    }

}
