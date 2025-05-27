<?php

namespace App\Models;

use Dom\Attr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estudiante extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'Estudiantes';
    protected $primaryKey = 'IDEstudiante';
    public $timestamps = true;

    const CREATED_AT = 'fechaCreado';
    const UPDATED_AT = 'fechaModificado';

    protected $fillable = [
        'nombres',
        'apellidos',
        'cedulaLetra',
        'cedulaNumero',
        'genero',
        'fechaNacimiento',
        'direccion',
        'fotoPerfilPath',
        'cedulaPath',
        'partidaNacimientoPath',
    ];

    protected $casts = [
        'fechaNacimiento' => 'date:Y-m-d',
        'fechaCreado' => 'datetime:Y-m-d H:i:s',
        'fechaModificado' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function letraCedula() : BelongsTo
    {
        return $this->belongsTo(LetraCedula::class, 'cedulaLetra', 'IDLetraCedula');
    }

    public function id() : Attribute
    {
        return Attribute::make(
            get: fn() => $this->attributes[$this->primaryKey],
            set: fn($value) => $this->attributes[$this->primaryKey] = $value,
        );
    }

    public function getPrimerNombreAttribute() : string
    {
        return explode(' ', $this->nombres)[0];
    }

    public function getPrimerApellidoAttribute() : string
    {
        return explode(' ', $this->apellidos)[0];
    }

    public function getNombreSimpleAttribute() : string
    {
        return $this->primerNombre.' '.$this->primerApellido;
    }

    public function getNombreCompletoAttribute() : string
    {
        return $this->nombres . ' ' . $this->apellidos;
    }

    public function genero() : Attribute
    {
        return Attribute::make(
            get: fn($value) => [ // The $value passed here is $this->attributes['genero']
                "letra" => $value,
                "descripcion" => $value == 'M' ? 'Masculino' : 'Femenino',
            ],
        );
    }
    
    public function edad() : Attribute
    {
        return Attribute::make(
            get: fn() => $this->fechaNacimiento ? (integer) abs(now()->diffInYears($this->fechaNacimiento)) : null,
        );
    }

    /**
     * The representantes that belong to the Estudiante.
     */
    public function representantes(): BelongsToMany
    {
        return $this->belongsToMany(Representante::class, 'AuxRepresentantesDelEstudiante', 'estudianteID', 'representanteID')
                    ->withPivot('representantePrincipal') // To access the 'representantePrincipal' attribute from the pivot table
                    ->withTimestamps(); // If your pivot table has timestamps (created_at, updated_at)
    }
}