<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Componente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'Componentes';
    protected $primaryKey = 'IDComponente';
    public $timestamps = true;

    const CREATED_AT = 'fechaCreado';
    const UPDATED_AT = 'fechaModificado';

    protected $fillable = [
        'nombre',
        'descripcion',
        'planEstudioID',
        'prelaID',
    ];
    protected $casts = [
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

    public function planEstudio() : BelongsTo
    {
        return $this->belongsTo(PlanEstudio::class, 'planEstudioID', 'IDPlanEstudio');
    }
    public function materias() : HasMany
    {
        return $this->hasMany(Materia::class, 'componenteID', 'IDComponente');
    }
    public function prela() : BelongsTo
    {
        return $this->belongsTo(Componente::class, 'prelaID', 'IDComponente');
    }
}
