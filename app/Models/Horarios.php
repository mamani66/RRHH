<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Importa SoftDeletes si lo estás utilizando.

class Horarios extends Model
{
    use HasFactory;

    protected $fillable = ['empleado_id', 'dia_semana', 'turno'];
/**
     * Retorna el empleado asociado al horario.
     */
    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'empleado_id');
    }

    // Si necesitas agregar más funciones o lógica específica del negocio, puedes hacerlo aquí.
}
    

