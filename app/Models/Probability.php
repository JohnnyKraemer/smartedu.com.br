<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Probability extends Model
{
    protected $table = 'probability';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'probability_evasion',
        'test_classifier_id',
        'student_id',
    ];
}
