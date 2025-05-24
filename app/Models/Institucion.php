<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Instituciones';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'IDInstitucion';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The names of the custom timestamp columns.
     */
    const CREATED_AT = 'fechaCreado';
    const UPDATED_AT = 'fechaModificado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'letraRif',
        'numeroRif',
        'direccion',
        'telefono',
        'logoPath',
    ];

    /**
     * Get the related LetraCedula model.
     */
    public function letraCedula()
    {
        return $this->belongsTo(LetraCedula::class, 'letraRif', 'IDLetraCedula');
    }

    /**
     * Get the related Configuracion model.
     */
    public function configuracion()
    {
        return $this->hasOne(Configuracion::class, 'IDConfiguracion', 'IDInstitucion');
    }

    public function getRif()
    {
        return $this->letraCedula->letra . '-' . str_pad($this->numeroRif, 8, '0', STR_PAD_LEFT);
    }
}