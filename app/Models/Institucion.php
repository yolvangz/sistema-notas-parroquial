<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'letraRifID',
        'numeroRif',
        'direccion',
        'telefono',
        'logoPath',
    ];

    /**
     * Get the related LetraCedula model.
     */
    public function letraRif()
    {
        return $this->belongsTo(LetraCedula::class, 'letraRifID', 'IDLetraCedula');
    }

    /**
     * Get the related Configuracion model.
     */
    public function configuracion()
    {
        return $this->hasOne(Configuracion::class, 'IDConfiguracion', 'IDInstitucion');
    }

    public function rif() : Attribute
    {
        return Attribute::make(
            get: fn() => $this->letraRif->letra . '-' . substr($this->numeroRif, 0, -1) . '-' . substr($this->numeroRif, -1),
        );
    }
}