<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Campus extends Model
{
    protected $table = 'campus';

    protected $appends = ['courses', 'users', 'students', 'students_evaded', 'students_not_evaded', 'students_formed'];

    protected $fillable = [
        'id', 'name', 'city',
    ];

    public function getCoursesAttribute()
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
                            WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
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
                            WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
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
                            WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                            AND situation.situation_short = "Formado"
                            AND campus.id = :campus', ['campus' => $this->id])[0]->total;
    }
}
