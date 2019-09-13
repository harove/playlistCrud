<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table="video";

    protected $fillable = [
        'id_usuario',
        'id_canal',
        'length',
        'nombre_video'
    ];
    
    protected $cast = [
        'lenght' => 'hh:mm:ss'
    ];
    
    public $timestamps = false;
    
}
