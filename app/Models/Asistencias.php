<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencias extends Model
{
    use HasFactory;
    
    protected $fillable = ['empleado_id', 'fecha', 'asistencia'];

    /**
     * Relación con el modelo Empleados.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'empleado_id');
    }

    // Puedes agregar otras funciones o relaciones según necesites.
}
