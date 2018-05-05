<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'detail';
    protected $appends = ['situation'];

    protected $fillable = [
        'id',
        'loading_period',
        'period',
        'matrix',
        'age_situation',
        'year_situation',
        'semester_situation',
        'coefficient',
        'disciplines_approved',
        'disciplines_consigned',
        'disciplines_matriculate',
        'disciplines_reprovated_frequency',
        'disciplines_reprovated_note',
        'likely_retirement',
        'semesters',
        'situation_id',        
        'student_id',
    ];

    public function student()
    {
        return $this->belongsToMany(Student::class);
    }

    public function getSituationAttribute()
    {
        return Situation::find($this->situation_id);
    }
}
