<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class LetraCedula extends Model
{
    protected $table = 'LetrasCedula';
    protected $primaryKey = 'IDLetraCedula';
    protected $keyType = 'int';
    public $timestamps = false;

    public function id() : Attribute
    {
        return Attribute::make(
            get: fn() => $this->attributes[$this->primaryKey],
            set: fn($value) => $this->attributes[$this->primaryKey] = $value,
        );
    }
}
