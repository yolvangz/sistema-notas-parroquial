<?php

namespace App\Models;

use Dom\Attr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estudiante extends Persona
{
    use HasFactory;

    protected $table = 'Estudiantes';
    protected $primaryKey = 'IDEstudiante';

    public function getFillable()
    {
        return array_merge($this->fillable, [
            'fotoPerfilPath',
            'cedulaPath',
            'partidaNacimientoPath',
        ]);
    }

    /**
     * The representantes that belong to the Estudiante.
     */
    public function representantes(): BelongsToMany
    {
        return $this->belongsToMany(Representante::class, 'AuxRepresentantesDelEstudiante', 'estudianteID', 'representanteID')
                    ->withPivot('representantePrincipal');
    }
}