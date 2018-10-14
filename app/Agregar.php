<?php

namespace hotel;

use Illuminate\Database\Eloquent\Model;

class Agregar extends Model
{
    protected $table='habitacion';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    'id',
    'id_hotel',
    'tipo_habitacion',
    'capacidad',
    'precio',
    'cantidad'
    ];
}
