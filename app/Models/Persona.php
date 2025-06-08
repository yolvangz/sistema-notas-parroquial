<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


abstract class Persona extends Model
{
    use SoftDeletes;
    
    public $timestamps = true;
    
    const CREATED_AT = 'fechaCreado';
    const UPDATED_AT = 'fechaModificado';
    // const DELETED_AT is 'deleted_at' by default with SoftDeletes trait

    protected $fillable = [
        'nombres',
        'apellidos',
        'cedulaLetra',
        'cedulaNumero',
        'genero',
        'fechaNacimiento',
        'direccion',
    ];

    protected $casts = [
        'fechaNacimiento' => 'date:Y-m-d',
        'fechaCreado' => 'datetime:Y-m-d H:i:s',
        'fechaModificado' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function letraCedula(): BelongsTo
    {
        return $this->belongsTo(LetraCedula::class, 'cedulaLetra', 'IDLetraCedula');
    }

    public function id(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->attributes[$this->primaryKey],
            set: fn($value) => $this->attributes[$this->primaryKey] = $value,
        );
    }

    public function getPrimerNombreAttribute(): string
    {
        if (empty($this->nombres)) {
            return '';
        }
        $parts = explode(' ', $this->nombres);
        return $parts[0] ?? '';
    }

    public function getPrimerApellidoAttribute(): string
    {
        if (empty($this->apellidos)) {
            return '';
        }
        $parts = explode(' ', $this->apellidos);
        return $parts[0] ?? '';
    }

    public function getNombreSimpleAttribute(): string
    {
        return $this->primerNombre.' '.$this->primerApellido;
    }

    public function getNombreCompletoAttribute(): string
    {
        return $this->nombres . ' ' . $this->apellidos;
    }
    public function genero(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (object) [ // The $value passed here is $this->attributes['genero']
                "letra" => $value,
                "descripcion" => $value == 'M' ? 'Masculino' : 'Femenino',
            ],
        );
    }
    public function edad(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->fechaNacimiento ? (integer) abs(now()->diffInYears($this->fechaNacimiento)) : null,
        );
    }
}
