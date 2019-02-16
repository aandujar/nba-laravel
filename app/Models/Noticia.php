<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model{
    protected $table = 'noticia';
    public $timestamps = false;
    protected $fillable = ['titulo','cuerpo'];
}
