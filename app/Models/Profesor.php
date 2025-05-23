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
    public $timestamps = false;

    protected $dates = ['fechaCreado', 'fechaModificado'];


    protected $fillable = [
        'nombres',
        'apellidos',
        'cedulaLetra',
        'cedulaNumero',
        'genero',
        'fechaNacimiento',
        'fechaIngreso',
        'direccion',
        'telefonoPrincipal',
        'email',
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
    public function getNombreCompletoAttribute() : string
    {
        return $this->nombres . ' ' . $this->apellidos;
    }
}