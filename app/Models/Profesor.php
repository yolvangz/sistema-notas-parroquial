<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profesor extends Persona
{
    use HasFactory;

    protected $table = 'Profesores';
    protected $primaryKey = 'IDProfesor';

    public function getFillable()
    {
        return array_merge($this->fillable, [
            'fechaIngreso',
            'email',
            'telefonoPrincipal',
            'telefonoSecundario',
        ]);
    }

    public function __construct($attributes = [], $exists = false)
    {
        parent::__construct($attributes, $exists);
        $this->setTable($this->table);
        $this->setKeyName($this->primaryKey);
        $this->casts = array_merge($this->casts, [
            'fechaIngreso' => 'date:Y-m-d',
        ]);
    }
}