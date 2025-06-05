<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Representante extends Persona
{
    use HasFactory;

    protected $table = 'Representantes';
    protected $primaryKey = 'IDRepresentante';

    public function getFillable()
    {
        return array_merge($this->fillable, [
            'email',
            'telefonoPrincipal',
            'telefonoSecundario',
        ]);
    }

    /**
     * The estudiantes that belong to the Representante.
     */
    public function estudiantes(): BelongsToMany
    {
        return $this->belongsToMany(Estudiante::class, 'AuxRepresentantesDelEstudiante', 'representanteID', 'estudianteID')
                    ->withPivot('representantePrincipal');
    }
}