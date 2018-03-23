<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\AbstractRepository;
use App\Models\TestClassifier;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StudentRepository extends AbstractRepository
{
    public function __construct(Student $model)
    {
        $this->model = $model;
    }

    public function getSumSituationShortByCampus()
    {
        return DB::select('SELECT campus.name, situation.situation_short,  COUNT(student.id) AS total
                            FROM student
                            LEFT JOIN detail ON student.id = detail.student_id
                            LEFT JOIN course ON student.course_id = course.id
                            LEFT JOIN campus ON course.campus_id = campus.id
                            LEFT JOIN situation ON detail.situation_id = situation.id
                            WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                            GROUP BY campus.name, situation.situation_short;');
    }

    public function getEvadedByYearAndSemesterAndCampus()
    {
        return DB::select('SELECT campus.name AS campus,  Concat(detail.ano_situacao,"-",detail.semestre_situacao ) AS ano_semestre ,  COUNT(student.id) AS total 
                            FROM student
                            LEFT JOIN detail ON student.id = detail.student_id
                            LEFT JOIN course ON student.course_id = course.id
                            LEFT JOIN campus ON course.campus_id = campus.id
                            LEFT JOIN situation ON detail.situation_id = situation.id
                            WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                            AND situation.situation_short = "Evadido"
                            GROUP BY campus.name, ano_semestre');
    }

    public function getEvadedByYearAndSemester()
    {
        return DB::select('SELECT Concat(detail.ano_situacao,"-",detail.semestre_situacao ) as ano_semestre,  COUNT(student.id) AS total 
                            FROM student
                            LEFT JOIN detail ON student.id = detail.student_id
                            LEFT JOIN course ON student.course_id = course.id
                            LEFT JOIN campus ON course.campus_id = campus.id
                            LEFT JOIN situation ON detail.situation_id = situation.id
                            WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                            AND situation.situation_short = "Evadido"
                            GROUP BY ano_semestre');
    }

}
