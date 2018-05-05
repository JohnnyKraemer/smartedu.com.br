<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classifier extends Model
{
    protected $table = 'classifier';

    protected $fillable = [
        'id', 'name', 'selected',
    ];
}
