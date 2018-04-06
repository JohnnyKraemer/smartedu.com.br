<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'detail';
    protected $appends = ['situation'];

    protected $fillable = [
        'id',
        'periodo_carga',
        'ano_situacao',
        'semestre_situacao',
        'cr',
        'disciplinas_aprovadas',
        'disciplinas_consignadas',
        'disciplinas_matriculadas',
        'disciplinas_reprovadas_frequencia',
        'disciplinas_reprovadas_nota',
        'idade_situacao',
        'matriz',
        'periodo',
        'provavel_jubilamento',
        'retencao_parcial',
        'retencao_total',
        'situation_id',
        'quant_semestre_cursados',
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
