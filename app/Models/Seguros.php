<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguros extends Model
{
    use HasFactory;
    protected $fillable = [
        'empleado_id', 'tipo', 'numero', 'descripcion', 'vigencia', 
        'estado', 'valor', 'prima_neta', 'total'
    ];
}
