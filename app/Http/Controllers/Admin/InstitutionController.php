<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classifier;
use App\Models\Course;
use App\Models\Retorno;
use App\Models\Variable;
use App\Models\Campus;
use Exception;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Repositories\StudentRepository AS Repository;
use App\Repositories\TestClassifierRepository;

class InstitutionController extends Controller
{
    private $way;
    private $name;
    private $repository;
    private $test_classifier_repository;

    public function __construct(Repository $repository, TestClassifierRepository $test_classifier_repository)
    {
        $this->way = array();
        array_push($this->way, 'admin.institution.');
        array_push($this->way, 'admin/institution');

        $this->name = 'instituição';
        $this->repository = $repository;
        $this->test_classifier_repository = $test_classifier_repository;
    }

    public function index(Request $request)
    {
        try {
            $period_calculation = $this->test_classifier_repository->getLastPeriodCalculationByType(9);
            $bests_test = $this->test_classifier_repository->findBy(
                array(
                    array(0 => "type", 1 => "=", 2 => 9),
                    //array(0 => "result", 1 => "=", 2 => 1),
                    array(0 => "period_calculation", 1 => "=", 2 => $period_calculation),
                    //array(0 => "course_id", 1 => "=", 2 => 2)
                ),
                array(
                    array(0 => "success", 1 => "desc")
                )
            );


            $objects = Campus::all()->toJson();
            $campus = Campus::all()->toArray();
            $evaded_by_yaer_semester = json_encode($this->repository->getEvadedByYearAndSemester());
            $bests_test = json_encode($bests_test);

            $courses = Course::all()->toArray();
            usort($courses,function ($a, $b) {
                return $a['students_evaded_percent'] < $b['students_evaded_percent'];
            });
            if(count($courses) > 8){
                $courses = array_slice($courses, 0, 8);
            }

            $total_by_situation_short = DB::select('SELECT situation.situation_short, COUNT(student.id) AS total 
                                    FROM student
                                    LEFT JOIN detail ON student.id = detail.student_id
                                    LEFT JOIN course ON student.course_id = course.id
                                    LEFT JOIN campus ON course.campus_id = campus.id
                                    LEFT JOIN situation ON detail.situation_id = situation.id
                                    WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                                    AND situation.situation_short != "Outro"
                                    GROUP BY situation.situation_short ORDER BY situation.situation_short');

            $total = DB::select('SELECT COUNT(student.id) AS total 
                                    FROM student')[0]->total;

            $total_not_evaded_high_prob = DB::select('SELECT COUNT(probability.id) AS total
                                        FROM probability
                                        LEFT JOIN test_classifier
                                        ON probability.test_classifier_id = test_classifier.id
                                        WHERE test_classifier.type = 9
                                        AND test_classifier.period_calculation = (SELECT MAX(test_classifier.period_calculation) AS period_calculation FROM test_classifier WHERE test_classifier.type = 9)
                                        AND probability.state = "Não Evadido"
                                        AND probability.probability_evasion > 0.5')[0]->total;

            foreach ($total_by_situation_short as $totals){
                $totals->percent = (($totals->total / $total)*100 );
            }

            return view($this->way[0] . 'index', compact([
                'campus',$campus,
                'objects', $objects,
                'courses', $courses,
                'evaded_by_yaer_semester', $evaded_by_yaer_semester,
                'total_by_situation_short', $total_by_situation_short,
                'bests_test',$bests_test,
                'total_not_evaded_high_prob',$total_not_evaded_high_prob
            ]));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            dd($e);

            //return redirect('/');
        }
    }
}