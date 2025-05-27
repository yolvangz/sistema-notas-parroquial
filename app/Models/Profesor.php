<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profesor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'Profesores';
    protected $primaryKey = 'IDProfesor';
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
        'fechaIngreso',
        'direccion',
        'email',
        'telefonoPrincipal',
        'telefonoSecundario',
    ];
    protected $casts = [
        'fechaNacimiento' => 'date:Y-m-d',
        'fechaIngreso' => 'date:Y-m-d',
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
    public function genero () : Attribute
    {
        return Attribute::make(
            get: fn() => (object) [
                "letra" => $this->attributes['genero'],
                "descripcion" => $this->attributes['genero'] == 'M' ? 'Masculino' : 'Femenino',
            ],
        );
    }
}