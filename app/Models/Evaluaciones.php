<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluaciones extends Model
{
    use HasFactory;
    protected $fillable = ['empleado_id', 'fecha_evaluacion', 'resultado', 'observaciones'];
    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'empleado_id');
    }

    // Aquí puedes añadir más métodos y propiedades según sea necesario para la lógica de tu aplicación.
}

