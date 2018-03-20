<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';

    protected $fillable = [
        'id',
        'name',
        'nivel_ensino',
        'grau',
        'periodicidade',
        'funcionamento',
        'turno',
        'categoria_stricto_sensu',
        'codigo_curso',
        'codigo_inep_curso',
        'regime_ensino',
        'total_periodos',
        'campus_id',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }
}
