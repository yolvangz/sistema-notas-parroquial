<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Configuraciones';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'IDConfiguracion';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The names of the custom timestamp fields.
     */
    const CREATED_AT = 'fechaCreado';
    const UPDATED_AT = 'fechaModificado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'institucionID',
        'calificacionNumericaMinima',
        'calificacionNumericaMaxima',
        'calificacionNumericaAprobatoria',
        'calificacionCualitativaLiterales',
        'calificacionCualitativaAprobatoria',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'calificacionNumericaMinima' => 'decimal:2',
        'calificacionNumericaMaxima' => 'decimal:2',
        'calificacionNumericaAprobatoria' => 'decimal:2',
        'calificacionCualitativaLiterales' => 'json:unicode',
    ];

    /**
     * Get the related Institucion model.
     */
    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'IDConfiguracion', 'IDInstitucion');
    }


    /**
     * Get and set the califiacionCualitativaLiterales attribute.
     */
    public function calificacionCualitativaLiteralesAttribute() : Attribute
    {
        return Attribute::make(
            get: function ($value) {
                // Decode the JSON string into an array
                $calificacionCualitativaLiterales = json_decode($value, true);

                // Ensure the decoded value is an array
                if (!is_array($calificacionCualitativaLiterales)) {
                    return [];
                }
                // Return the decoded array
                return $calificacionCualitativaLiterales;
            },
            set: fn ($value) => json_encode($value, true),
        );
    }
    public function calificacionCualitativaAprobatoria () : Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->calificacionCualitativaLiterales[$value - 1]['letra'],
        );
    }
}