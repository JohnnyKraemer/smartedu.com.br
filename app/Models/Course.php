<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    protected $table = 'course';
    protected $appends = [
        'campus',
        'students',
        'students_evaded',
        'students_not_evaded',
        'students_formed',
        'students_evaded_percent',
        'students_not_evaded_percent',
        'students_formed_percent',
        'students_high_prob',
        'students_high_prob_percent'];

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
        'use_classify',
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

    public function getCampusAttribute()
    {
        return Campus::find($this->campus_id)->name;
    }

    public function getUsersAttribute()
    {
        return DB::table('user')->where('campus_id', $this->id)->count();
    }

    public function getStudentsAttribute()
    {
        return DB::select('SELECT COUNT(student.id) AS total
                            FROM student
                            WHERE student.course_id = :course', ['course' => $this->id])[0]->total;
    }

    public function getStudentsEvadedAttribute()
    {
        return DB::select('SELECT COUNT(student.id) AS total
                            FROM student
                            LEFT JOIN detail ON student.id = detail.student_id
                            LEFT JOIN situation ON detail.situation_id = situation.id
                            WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                            AND situation.situation_short = "Evadido"
                            AND student.course_id = :course', ['course' => $this->id])[0]->total;
    }

    public function getStudentsNotEvadedAttribute()
    {
        return DB::select('SELECT COUNT(student.id) AS total
                            FROM student
                            LEFT JOIN detail ON student.id = detail.student_id
                            LEFT JOIN situation ON detail.situation_id = situation.id
                            WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                            AND situation.situation_short = "Nao Evadido"
                            AND student.course_id = :course', ['course' => $this->id])[0]->total;
    }

    public function getStudentsFormedAttribute()
    {
        return DB::select('SELECT COUNT(student.id) AS total
                            FROM student
                            LEFT JOIN detail ON student.id = detail.student_id
                            LEFT JOIN situation ON detail.situation_id = situation.id
                            WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                            AND situation.situation_short = "Formado"
                            AND student.course_id = :course', ['course' => $this->id])[0]->total;
    }

    public function getStudentsEvadedPercentAttribute()
    {
        if ($this->getStudentsEvadedAttribute() != 0) {
            return  number_format((($this->getStudentsEvadedAttribute() / $this->getStudentsAttribute()) * 100),2, '.', ',' );
        } else {
            return 0;
        }
    }

    public function getStudentsNotEvadedPercentAttribute()
    {
        if ($this->getStudentsNotEvadedAttribute() != 0) {
            return  number_format((($this->getStudentsNotEvadedAttribute() / $this->getStudentsAttribute()) * 100),2, '.', ',' );
        } else {
            return 0;
        }
    }

    public function getStudentsFormedPercentAttribute()
    {
        if ($this->getStudentsFormedAttribute() != 0) {
            return  number_format((($this->getStudentsFormedAttribute() / $this->getStudentsAttribute()) * 100),2, '.', ',' );
        } else {
            return 0;
        }
    }

    public function getStudentsHighProbAttribute()
    {
        return DB::select('SELECT COUNT(probability.id) AS total
                                FROM probability
                                LEFT JOIN test_classifier
                                ON probability.test_classifier_id = test_classifier.id
                                LEFT JOIN course
                                ON test_classifier.course_id = course.id
                                WHERE test_classifier.type = 9
                                AND test_classifier.period_calculation = (SELECT MAX(test_classifier.period_calculation) AS period_calculation FROM test_classifier WHERE test_classifier.type = 9)
                                AND probability.state = "Não Evadido"
                                AND probability.probability_evasion > 0.5
                                AND course.id = :course', ['course' => $this->id])[0]->total;
    }

    public function getStudentsHighProbPercentAttribute()
    {
        if ($this->getStudentsHighProbAttribute() != 0) {
            return number_format((($this->getStudentsHighProbAttribute() / $this->getStudentsNotEvadedAttribute()) * 100), 2, '.', ',');
        } else {
            return 0;
        }
    }
}
