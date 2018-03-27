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

class CourseController extends Controller
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
        array_push($this->way, 'admin.course.');
        array_push($this->way, 'admin/course');

        $this->name = 'curso';
        $this->repository = $repository;
        $this->test_classifier_repository = $test_classifier_repository;
        $this->student_repository = $student_repository;
        $this->course_repository = $course_repository;
    }

    public function index(Request $request, $id)
    {
        try {
            try {
                $object = Course::findOrFail($id);
            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', 'Este ' . $this->name . '  não existe!');
                return redirect('/');
            }


            $period_calculation = $this->test_classifier_repository->getLastPeriodCalculationByType(9);
            $bests_test = $this->test_classifier_repository->findBy(
                array(
                    array(0 => "type", 1 => "=", 2 => 9),
                    array(0 => "result", 1 => "=", 2 => 1),
                    array(0 => "period_calculation", 1 => "=", 2 => $period_calculation),
                ),
                array(
                    array(0 => "success", 1 => "desc")
                )
            );
            $bests_test = json_encode($bests_test);

            $courses = $this->course_repository->findBy(
                array(
                    array(0 => "campus_id", 1 => "=", 2 => $object->campus_id)
                )
            );

            $all_campus = Campus::all();
            $objects = $this->student_repository->findBy(
                array(
                    array(0 => "course_id", 1 => "=", 2 => $id)
                )
            );

            $wheres = array(array(0 => "course.id", 1 => "=", 2 => $id), array(0 => "situation.situation_short", 1 => "!=", 2 => "'Outro'"));
            $group_bys = array(0 => "category", 1 => "situation_short");

            $students_by_periodo = json_encode(
                $this->student_repository->getCountStudens(
                    array(0 => "detail.periodo AS category", 1 => "situation.situation_short"), $wheres, $group_bys
                ));

            $students_by_ano_semestre = json_encode(
                $this->student_repository->getCountStudens(
                    array(0 => "CONCAT(detail.ano_situacao, '-',detail.semestre_situacao ) AS category", 1 => "situation.situation_short"), $wheres, $group_bys
                ));

            $students_by_genero = json_encode(
                $this->student_repository->getCountStudens(
                    array(0 => "student.genero AS category", 1 => "situation.situation_short"), $wheres, $group_bys
                ));

            $students_by_idade_ingresso = json_encode(
                $this->student_repository->getCountStudens(
                    array(0 => "student.idade_ingresso AS category", 1 => "situation.situation_short"), $wheres, $group_bys
                ));

            $students_by_idade_situacao = json_encode(
                $this->student_repository->getCountStudens(
                    array(0 => "detail.idade_situacao AS category", 1 => "situation.situation_short"), $wheres, $group_bys
                ));

            $students_by_disciplinas_aprovadas = json_encode(
                $this->student_repository->getCountStudens(
                    array(0 => "detail.disciplinas_aprovadas AS category", 1 => "situation.situation_short"), $wheres, $group_bys
                ));

            $students_by_disciplinas_reprovadas_frequencia = json_encode(
                $this->student_repository->getCountStudens(
                    array(0 => "detail.disciplinas_reprovadas_frequencia AS category", 1 => "situation.situation_short"), $wheres, $group_bys
                ));

            $students_by_disciplinas_reprovadas_nota = json_encode(
                $this->student_repository->getCountStudens(
                    array(0 => "detail.disciplinas_reprovadas_nota AS category", 1 => "situation.situation_short"), $wheres, $group_bys
                ));

            $students_by_quant_semestre_cursados = json_encode(
                $this->student_repository->getCountStudens(
                    array(0 => "detail.quant_semestre_cursados AS category", 1 => "situation.situation_short"), $wheres, $group_bys
                ));


            return view($this->way[0] . 'index', compact([
                'object', $object,
                'objects', $objects,
                'bests_test', $bests_test,
                'all_campus', $all_campus,
                'students_by_idade_ingresso', $students_by_idade_ingresso,
                'students_by_idade_situacao', $students_by_idade_situacao,
                'students_by_disciplinas_aprovadas', $students_by_disciplinas_aprovadas,
                'students_by_disciplinas_reprovadas_frequencia', $students_by_disciplinas_reprovadas_frequencia,
                'students_by_disciplinas_reprovadas_nota', $students_by_disciplinas_reprovadas_nota,
                'students_by_quant_semestre_cursados', $students_by_quant_semestre_cursados,
                'students_by_genero', $students_by_genero,
                'students_by_ano_semestre', $students_by_ano_semestre,
                'students_by_periodo', $students_by_periodo
            ]));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect('/');
        }
    }
}