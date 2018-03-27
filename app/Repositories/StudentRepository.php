<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\AbstractRepository;
use App\Models\TestClassifier;
use ClassesWithParents\E;
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

    public function getEvadedByYearAndSemesterAndCampus($campus)
    {
        return DB::select('SELECT Concat(detail.ano_situacao,"-",detail.semestre_situacao ) AS ano_semestre ,  COUNT(student.id) AS total 
                            FROM student
                            LEFT JOIN detail ON student.id = detail.student_id
                            LEFT JOIN course ON student.course_id = course.id
                            LEFT JOIN campus ON course.campus_id = campus.id
                            LEFT JOIN situation ON detail.situation_id = situation.id
                            WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                            AND situation.situation_short = "Evadido"
                            AND campus.id = :campus
                            GROUP BY ano_semestre', ['campus' => $campus]);
    }

    public function getEvadedByYearAndSemesterAndCourse($course)
    {
        return DB::select('SELECT Concat(detail.ano_situacao,"-",detail.semestre_situacao ) AS ano_semestre ,  COUNT(student.id) AS total 
                            FROM student
                            LEFT JOIN detail ON student.id = detail.student_id
                            LEFT JOIN course ON student.course_id = course.id
                            LEFT JOIN campus ON course.campus_id = campus.id
                            LEFT JOIN situation ON detail.situation_id = situation.id
                            WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                            AND situation.situation_short = "Evadido"
                            AND student.course_id = :course
                            GROUP BY ano_semestre', ['course' => $course]);
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

    //Retorna os alunos evadidos por gênero de toda a instituição
    public function getEvadedByGenre()
    {
        return DB::select('SELECT student.genero,  COUNT(student.id) AS total
                                FROM student
                                LEFT JOIN detail ON student.id = detail.student_id
                                LEFT JOIN situation ON detail.situation_id = situation.id
                                WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                                AND situation.situation_short = "Evadido"
                                GROUP BY student.genero ORDER BY student.genero;');
    }

    //Retorna os alunos evadidos por gênero de um campus
    public function getEvadedByGenreAndCampus($campus)
    {
        return DB::select('SELECT student.genero,  COUNT(student.id) AS total
                                FROM student
                                LEFT JOIN detail ON student.id = detail.student_id
                                LEFT JOIN course ON student.course_id = course.id
                                LEFT JOIN campus ON course.campus_id = campus.id
                                LEFT JOIN situation ON detail.situation_id = situation.id
                                WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                                AND situation.situation_short = "Evadido"
                                AND campus.id = :campus
                                GROUP BY student.genero ORDER BY student.genero;', ['campus' => $campus]);
    }

    //Retorna os alunos evadidos por gênero de um curso
    public function getEvadedByGenreAndCourse($course)
    {
        return DB::select('SELECT student.genero,  COUNT(student.id) AS total
                                FROM student
                                LEFT JOIN detail ON student.id = detail.student_id
                                LEFT JOIN situation ON detail.situation_id = situation.id
                                WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                                AND situation.situation_short = "Evadido"
                                AND student.course_id = :course
                                GROUP BY student.genero ORDER BY student.genero;', ['course' => $course]);
    }

    //Retorna a quantidade de alunos por situacao resumida e por gênero de um curso
    public function getEvadedByGenreAndCourseComplete($course)
    {
        return DB::select('SELECT situation.situation_short, student.genero,  COUNT(student.id) AS total
                                FROM student
                                LEFT JOIN detail ON student.id = detail.student_id
                                LEFT JOIN situation ON detail.situation_id = situation.id
                                WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                                AND situation.situation_short != "Outro"
                                AND student.course_id = :course
                                GROUP BY situation.situation_short, student.genero  
                                ORDER BY situation.situation_short ASC;', ['course' => $course]);
    }

    //Retorna os alunos evadidos por period de toda a instituição
    public function getEvadedByPeriod()
    {
        return DB::select('SELECT detail.periodo,  COUNT(student.id) AS total
                                FROM student
                                LEFT JOIN detail ON student.id = detail.student_id
                                LEFT JOIN situation ON detail.situation_id = situation.id
                                WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                                AND situation.situation_short = "Evadido"
                                GROUP BY detail.periodo ORDER BY detail.periodo;');
    }

    //Retorna os alunos evadidos por period de um campus
    public function getEvadedByPeriodAndCampus($campus)
    {
        return DB::select('SELECT detail.periodo,  COUNT(student.id) AS total
                                FROM student
                                LEFT JOIN detail ON student.id = detail.student_id
                                LEFT JOIN course ON student.course_id = course.id
                                LEFT JOIN campus ON course.campus_id = campus.id
                                LEFT JOIN situation ON detail.situation_id = situation.id
                                WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                                AND situation.situation_short = "Evadido"
                                AND campus.id = :campus
                                GROUP BY detail.periodo ORDER BY detail.periodo;', ['campus' => $campus]);
    }

    //Retorna os alunos evadidos por period de um curso
    public function getEvadedByPeriodAndCourse($course)
    {
        return DB::select('SELECT detail.periodo,  COUNT(student.id) AS total
                                FROM student
                                LEFT JOIN detail ON student.id = detail.student_id
                                LEFT JOIN situation ON detail.situation_id = situation.id
                                WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                                AND situation.situation_short = "Evadido"
                                AND student.course_id = :course
                                GROUP BY detail.periodo ORDER BY detail.periodo;', ['course' => $course]);
    }

    //Quantidade de por situcao resumida e idade ingresso
    public function getCountStudens(array $column, array $criteria, array $groupby = null, $orderBy = null)
    {
        try {
            $sql = "SELECT ";

            if ($column != null) {
                foreach ($column as $c) {
                    $sql = $sql . $c . ", ";
                }
            }

            $sql = $sql . " IFNULL(COUNT(student.id),0) AS total
                    FROM student
                    LEFT JOIN detail ON student.id = detail.student_id
                    LEFT JOIN course ON student.course_id = course.id
                    LEFT JOIN campus ON course.campus_id = campus.id
                    LEFT JOIN situation ON detail.situation_id = situation.id
                    WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)";

            if ($criteria != null) {
                foreach ($criteria as $c) {
                    $sql = $sql . "\nAND " . $c[0] . " " . $c[1] . " " . $c[2] . "";
                }
            }

            if ($groupby != null) {
                $sql = $sql . "\n GROUP BY ";
                $i = 1;
                foreach ($groupby as $c) {
                    $sql = $sql . $c;

                    if ($i != count($groupby)) {
                        $sql = $sql . ", ";
                    }
                    $i = $i + 1;
                }
            }

            if ($orderBy != null) {
                $sql = $sql . "\n ORDER BY " . $orderBy;
            }
            return DB::select($sql);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
