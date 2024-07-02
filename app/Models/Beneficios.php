<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficios extends Model
{
    use HasFactory;
    protected $fillable = ['empleado_id', 'tipo', 'descripcion', 'fecha_asignacion'];
    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'empleado_id');
    }

    // Otras definiciones de métodos del modelo...
}