<?php

namespace hotel;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
     protected $table='comentario';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    'id',
    'id_habitacion',
    'comentarios'
    ];
}
