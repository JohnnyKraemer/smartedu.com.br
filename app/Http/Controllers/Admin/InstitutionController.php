<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Campus;
use Exception;
use Illuminate\Http\Request;
use App\Repositories\CampusRepository AS Repository;
use App\Repositories\StudentRepository;
use App\Repositories\CourseRepository;
use App\Repositories\TestClassifierRepository;
use Illuminate\Support\Facades\DB;

class InstitutionController extends Controller
{
    private $way;
    private $name;
    private $repository;
    private $test_classifier_repository;
    private $student_repository;
    private $course_repository;

    public function __construct(Repository $repository,
                                TestClassifierRepository $test_classifier_repository,
                                StudentRepository $student_repository,
                                CourseRepository $course_repository)
    {
        $this->way = array();
        array_push($this->way, 'admin.institution.');
        array_push($this->way, 'admin/institution');

        $this->name = 'instituição';
        $this->repository = $repository;
        $this->test_classifier_repository = $test_classifier_repository;
        $this->student_repository = $student_repository;
        $this->course_repository = $course_repository;
    }

    public function index(Request $request)
    {
        try {


            $campus = Campus::all();

            $total_by_situation_short = DB::select('SELECT situation.situation_short, COUNT(student.id) AS total 
                                    FROM student
                                    LEFT JOIN detail ON student.id = detail.student_id
                                    LEFT JOIN course ON student.course_id = course.id
                                    LEFT JOIN campus ON course.campus_id = campus.id
                                    LEFT JOIN situation ON detail.situation_id = situation.id
                                    WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                                    AND situation.situation_short != "Outro"
                                    GROUP BY situation.situation_short ORDER BY situation.situation_short');
            /*
            $total_formado = DB::select('SELECT situation.situation_long, COUNT(student.id) AS total 
                                    FROM student
                                    LEFT JOIN detail ON student.id = detail.student_id
                                    LEFT JOIN course ON student.course_id = course.id
                                    LEFT JOIN campus ON course.campus_id = campus.id
                                    LEFT JOIN situation ON detail.situation_id = situation.id
                                    WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                                    AND situation.situation_long = "Formado"
                                    GROUP BY situation.situation_long ORDER BY situation.situation_long')[0];
            */

            $total =$total_by_situation_short[0]->total + $total_by_situation_short[1]->total + $total_by_situation_short[2]->total;

            $total_not_evaded_high_prob = DB::select('SELECT COUNT(probability.id) AS total
                                        FROM probability
                                        LEFT JOIN test_classifier
                                        ON probability.test_classifier_id = test_classifier.id
                                        WHERE test_classifier.type = 9
                                        AND test_classifier.period_calculation = (SELECT MAX(test_classifier.period_calculation) AS period_calculation FROM test_classifier WHERE test_classifier.type = 9)
                                        AND probability.state = "Não Evadido"
                                        AND probability.probability_evasion > 0.5')[0]->total;

            //$total_by_situation_short[1]->total = $total_by_situation_short[1]->total - $total_formado->total;
            //array_push($total_by_situation_short, $total_formado);
            foreach ($total_by_situation_short as $totals){
                $totals->percent = number_format((($totals->total / $total)*100 ),2);
            }

            //dd($total_by_situation_short);


            $courses = Course::all()->toArray();
            usort($courses,function ($a, $b) {
                return $a['students_evaded_percent'] < $b['students_evaded_percent'];
            });
            if(count($courses) > 8){
                $courses = array_slice($courses, 0, 8);
            }


            $wheres = array( array(0 => "situation.situation_short", 1 => "!=", 2 => "'Outro'"));
            $group_bys = array(0 => "category", 1 => "situation_short");

            $students_by_periodo = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "detail.periodo AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));

            $students_by_ano_semestre = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "CONCAT(detail.ano_situacao, '-',detail.semestre_situacao ) AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));

            $students_by_genero = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "student.genero AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));

            $students_by_idade_ingresso = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "student.idade_ingresso AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));

            $students_by_idade_situacao = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "detail.idade_situacao AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));

            $students_by_quant_semestre_cursados = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "detail.quant_semestre_cursados AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));


            $students_by_campus = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "campus.name AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));


            return view($this->way[0] . 'index', compact([
                'total_by_situation_short', $total_by_situation_short,
                'total_not_evaded_high_prob', $total_not_evaded_high_prob,
                'campus', $campus,
                'courses',$courses,
                'students_by_idade_ingresso', $students_by_idade_ingresso,
                'students_by_idade_situacao', $students_by_idade_situacao,
                'students_by_quant_semestre_cursados', $students_by_quant_semestre_cursados,
                'students_by_genero', $students_by_genero,
                'students_by_ano_semestre', $students_by_ano_semestre,
                'students_by_periodo', $students_by_periodo,
                'students_by_campus', $students_by_campus
            ]));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect('/');
        }
    }
}