<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Ciclista extends Model
{
    use HasFactory;

    protected $table = 'ciclista';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'peso_base',
        'altura_base',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

}
