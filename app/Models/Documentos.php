<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    use HasFactory;

    protected $fillable = ['tipo', 'codigo', 'empleado_id', 'archivo', 'fecha_emision'];

    /**
     * Relación con el modelo Empleados.
     *
     * Este método define una relación de tipo 'pertenece a' donde cada documento
     * está asociado con un empleado específico.
     */
    public function empleado()
    {
        // Asegúrate de que 'Empleados' sea el nombre correcto del modelo y que 'empleado_id' es la clave foránea en esta tabla.
        return $this->belongsTo(Empleados::class, 'empleado_id');
    }
}
