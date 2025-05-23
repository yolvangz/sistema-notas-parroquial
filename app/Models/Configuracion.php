<?php

namespace App\Models;

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
     * Get the califiacionCualitativaAprobatoria attribute.
     */
    public function getCalificacionCualitativaAprobatoriaAttribute($value)
    {
        return $this->calificacionCualitativaLiterales[$value - 1]['literal'];
    }

}