<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclutamientos extends Model
{
    use HasFactory;
    protected $fillable = ['empleado_id', 'empleado_nombre', 'cargo_id', 'fecha_postulacion', 'estado'];

/**
     * Relación con el modelo Empleados.
     *
     * Cada reclutamiento pertenece a un empleado.
     */
    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'empleado_id');
    }

    /**
     * Relación con el modelo Cargos.
     *
     * Cada reclutamiento está asociado a un cargo.
     */
    public function cargo()
    {
        return $this->belongsTo(Cargos::class, 'cargo_id');
    }
}
