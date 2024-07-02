<?php

namespace App\Models;

use App\Filament\Resources\DepartamentosResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargos extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'departamento_id'];

    // Relación con Departamento
    public function departamento()
    {
        return $this->belongsTo(Departamentos::class);
    }
        // Relación con Empleados
        public function empleados()
        {
            return $this->hasMany(Empleados::class);
        }
    
}