<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre', 'apellidos', 'email', 'documento', 'fecha_nacimiento', 
        'telefono', 'estado_civil', 'direccion', 'ciudad', 'departamento', 
        'fecha_registro', 'cargo_id', 'departamento_id', 'foto'
    ];

    // Relación con Departamento
    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'departamento_id');
    }

    // Relación con Cargo
    public function cargo()
    {
        return $this->belongsTo(Cargos::class, 'cargo_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documentos::class, 'empleado_id');
    }
}

