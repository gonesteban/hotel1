<?php

namespace hotel;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table='hotel';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    'id',
    'nombre_hotel',
    'id_ciudad'
    ];
}
