<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Campus extends Model
{
    protected $table = 'campus';

    protected $appends = [
        'courses',
        'count_courses',
        'users',
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
        'id', 'name', 'city','use_classify',
    ];

    public function getCoursesAttribute()
    {
        return DB::table('course')->where('campus_id', $this->id)->get();
    }

    public function getCountCoursesAttribute()
    {
        return DB::table('course')->where('campus_id', $this->id)->count();
    }

    public function getUsersAttribute()
    {
        return DB::table('user')->where('campus_id', $this->id)->count();
    }

    public function getStudentsAttribute()
    {
        return DB::select('SELECT COUNT(student.id) AS total
                            FROM student
                            LEFT JOIN course ON student.course_id = course.id
                            LEFT JOIN campus ON course.campus_id = campus.id
                            WHERE campus.id = :campus', ['campus' => $this->id])[0]->total;
    }

    public function getStudentsEvadedAttribute()
    {
        return DB::select('SELECT COUNT(student.id) AS total
                            FROM student
                            LEFT JOIN detail ON student.id = detail.student_id
                            LEFT JOIN course ON student.course_id = course.id
                            LEFT JOIN campus ON course.campus_id = campus.id
                            LEFT JOIN situation ON detail.situation_id = situation.id
                            WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
                            AND situation.situation_short = "Evadido"
                            AND campus.id = :campus', ['campus' => $this->id])[0]->total;
    }

    public function getStudentsNotEvadedAttribute()
    {
        return DB::select('SELECT COUNT(student.id) AS total
                            FROM student
                            LEFT JOIN detail ON student.id = detail.student_id
                            LEFT JOIN course ON student.course_id = course.id
                            LEFT JOIN campus ON course.campus_id = campus.id
                            LEFT JOIN situation ON detail.situation_id = situation.id
                            WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
                            AND situation.situation_short = "Não Evadido"
                            AND campus.id = :campus', ['campus' => $this->id])[0]->total;
    }

    public function getStudentsFormedAttribute()
    {
        return DB::select('SELECT COUNT(student.id) AS total
                            FROM student
                            LEFT JOIN detail ON student.id = detail.student_id
                            LEFT JOIN course ON student.course_id = course.id
                            LEFT JOIN campus ON course.campus_id = campus.id
                            LEFT JOIN situation ON detail.situation_id = situation.id
                            WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
                            AND situation.situation_short = "Formado"
                            AND campus.id = :campus', ['campus' => $this->id])[0]->total;
    }

    public function getStudentsEvadedPercentAttribute()
    {
        if ($this->getStudentsEvadedAttribute() != 0) {
            return number_format((($this->getStudentsEvadedAttribute() / $this->getStudentsAttribute()) * 100), 2, '.', ',');
        } else {
            return 0;
        }
    }

    public function getStudentsNotEvadedPercentAttribute()
    {
        if ($this->getStudentsNotEvadedAttribute() != 0) {
            return number_format((($this->getStudentsNotEvadedAttribute() / $this->getStudentsAttribute()) * 100), 2, '.', ',');
        } else {
            return 0;
        }
    }

    public function getStudentsFormedPercentAttribute()
    {
        if ($this->getStudentsFormedAttribute() != 0) {
            return number_format((($this->getStudentsFormedAttribute() / $this->getStudentsAttribute()) * 100), 2, '.', ',');
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
                                AND probability.situation = "Não Evadido"
                                AND probability.probability_evasion > 0.5
                                AND course.campus_id = :campus', ['campus' => $this->id])[0]->total;
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
