<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    // Relación con Cargos
    public function cargos()
    {
        return $this->hasMany(Cargos::class);
    }

     // Relación con Empleados
     public function empleados()
     {
         return $this->hasMany(Empleados::class);
     }
}
