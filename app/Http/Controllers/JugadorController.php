<?php
use \Illuminate\Support\Facades\DB;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugador;


class JugadorController extends Controller
{
    public function getJugador($id){
        $jugador = Jugador::where("codigo",$id)->get();
        return view('jugador')->with('jugador',$jugador);
    }
    public function getJugadores(){
        $jugadores = Jugador::where("Nombre_equipo","Lakers")->get();
        return view('jugadores')->with('jugadores',$jugadores);
    }
}
