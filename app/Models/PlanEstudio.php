<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanEstudio extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'PlanesDeEstudios';
    protected $primaryKey = 'IDPlanEstudio';
    public $timestamps = true;

    const CREATED_AT = 'fechaCreado';
    const UPDATED_AT = 'fechaModificado';

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'activo',
    ];
    protected $casts = [
        'fechaNacimiento' => 'date:Y-m-d',
        'fechaCreado' => 'datetime:Y-m-d H:i:s',
        'fechaModificado' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function id() : Attribute
    {
        return Attribute::make(
            get: fn() => $this->attributes[$this->primaryKey],
            set: fn($value) => $this->attributes[$this->primaryKey] = $value,
        );
    }
    
    public function componentes() : HasMany
    {
        return $this->hasMany(Componente::class, 'PlanEstudioID', 'IDPlanEstudio');
    }
}