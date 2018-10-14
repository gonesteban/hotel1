<?php

namespace hotel;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
     protected $table='reserva';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    'id',
    'id_users',
    'id_habitacion',
    'num_personas',
    'costo',
    'fecha_ingreso',
    'fecha_salida'
    ];
}
