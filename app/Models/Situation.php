<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    protected $table = 'situation';

    protected $fillable = [
        'id',
        'situation_short',
        'situation_long',
        'description',
    ];
}
