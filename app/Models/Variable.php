<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $table = 'variable';

    protected $fillable = [
        'id', 
        'name', 
        'name_database',
        'table',
        'description',
        'selected',
        'discretize',
        'nominal'
    ];
}
