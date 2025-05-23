<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LetraCedula extends Model
{
    protected $table = 'LetrasCedula';
    protected $primaryKey = 'IDLetraCedula';
    protected $keyType = 'int';
    public $timestamps = false;
}
