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

    public function index(Request $request, $id = 1)
    {
        try {
            try {
                $object = null;
                $courses = null;
                $loggedUser = \Auth::user();

                if($loggedUser->position_id == 1 || $loggedUser->position_id == 2){
                    $object = Course::findOrFail($id);
                }else{
                    if($loggedUser->position_id == 3){
                        $courses = $loggedUser->campus->courses;
                    }else if($loggedUser->courses != "-"){
                        $courses = $loggedUser->courses;
                    }else{
                        $request->session()->flash('type', 'danger');
                        $request->session()->flash('message', 'Ocorreu um erro no sistema!');
                        return redirect('/');
                    }

                    foreach ($courses as $course){
                        if($course->id == $id){
                            try {
                                $object = Course::findOrFail($id);
                            } catch (Exception $e) {
                                $request->session()->flash('type', 'danger');
                                $request->session()->flash('message', 'Este ' . $this->name . '  não existe!');
                                return redirect('/');
                            }
                        }
                    }
                    if($object == null){
                        $request->session()->flash('type', 'danger');
                        $request->session()->flash('message', 'Você não tem permissão para acessar está área!');
                        return redirect('/admin/course/'.$courses[0]->id);
                    }
                }
            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', 'Ocorreu um erro no sistema!');
                return redirect('/');
            }

            if($loggedUser->position_id == 1 || $loggedUser->position_id == 2) {
                $all_campus = Campus::all();
            }else{
                $all_campus = [];
                $all_campus[1] = Campus::find($loggedUser->campus_id);
            }

            $period_calculation = $this->test_classifier_repository->getLastPeriodCalculationByType(9);
            $bests_test = $this->test_classifier_repository->findBy(
                array(
                    array(0 => "type", 1 => "=", 2 => 9),
                    array(0 => "result", 1 => "=", 2 => 1),
                    array(0 => "course_id", 1 => "=", 2 => $id),
                    array(0 => "period_calculation", 1 => "=", 2 => $period_calculation),
                ),
                array(
                    array(0 => "success", 1 => "desc")
                )
            )[0];

            $objects =
                $this->student_repository->getStudentsProbability(
                    array(
                        0 => "student.name",
                        1 => "detail.year_situation",
                        2 => "detail.semester_situation",
                        3 => "detail.period",
                        4 => "student.quota",
                        5 => "detail.semesters",
                        6 => "situation.situation_long",
                        7 => "situation.situation_short",
                        8 => "student.id",
                        9 => "probability.probability_evasion"),
                    array(array(0 => "course.id", 1 => "=", 2 => $id), array(0 => "probability.test_classifier_id", 1 => "=", 2 => $bests_test->id))
                );

            $wheres = array(array(0 => "course.id", 1 => "=", 2 => $id), array(0 => "situation.situation_short", 1 => "!=", 2 => "'Outro'"));
            $group_bys = array(0 => "category", 1 => "situation_short");

            $students_by_period = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "detail.period AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));

            $students_by_ano_semestre = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "CONCAT(detail.year_situation, '-',detail.semester_situation ) AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));

            $students_by_genre = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "student.genre AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));

            $students_by_idade_ingresso = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "student.age AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));

            $students_by_age_situation = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "detail.age_situation AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));

            $students_by_semesters = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "detail.semesters AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));


            return view($this->way[0] . 'index', compact([
                'object', $object,
                'objects', $objects,
                'all_campus', $all_campus,
                'courses', $courses,
                'students_by_idade_ingresso', $students_by_idade_ingresso,
                'students_by_age_situation', $students_by_age_situation,
                'students_by_semesters', $students_by_semesters,
                'students_by_genre', $students_by_genre,
                'students_by_ano_semestre', $students_by_ano_semestre,
                'students_by_period', $students_by_period
            ]));
        } catch (Exception $e) {
            return $e;
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect('/');
        }
    }
}