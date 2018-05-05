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

class CampusController extends Controller
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
        array_push($this->way, 'admin.campus.');
        array_push($this->way, 'admin/campus');

        $this->name = 'campus';
        $this->repository = $repository;
        $this->test_classifier_repository = $test_classifier_repository;
        $this->student_repository = $student_repository;
        $this->course_repository = $course_repository;
    }

    public function index(Request $request, $id = 1)
    {
        try {
            try {
                $loggedUser = \Auth::user();
                if($loggedUser->position_id == 1 || $loggedUser->position_id == 2){
                    $object = Campus::findOrFail($id);
                }else if($loggedUser->campus != null){
                    if($loggedUser->campus->id == $id){
                        $object = Campus::findOrFail($id);
                    }else{
                        $request->session()->flash('type', 'danger');
                        $request->session()->flash('message', 'Você não tem permissão para acessar está área!');
                        return redirect('/admin/campus/'.$loggedUser->campus->id);
                    }
                }else{
                    $request->session()->flash('type', 'danger');
                    $request->session()->flash('message', 'Ocorreu um erro no sistema!');
                    return redirect('/');
                }
            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', 'Ocorreu um erro no sistema!');
                return redirect('/');
            }

            if($loggedUser->position_id == 1 || $loggedUser->position_id == 2) {
                $campus = Campus::all();
            }else{
                $campus = [];
                $campus[1] = $object;
            }
            $objects = $this->course_repository->findBy(
                array(
                    array(0 => "campus_id", 1 => "=", 2 => $id)
                )
            );

            $wheres = array(array(0 => "campus.id", 1 => "=", 2 => $id), array(0 => "situation.situation_short", 1 => "!=", 2 => "'Outro'"));
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

            $students_by_idade_situacao = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "detail.age_situation AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));

            $students_by_semesters = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "detail.semesters AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));

            $students_by_course = json_encode(
                $this->student_repository->getStudents(
                    array(0 => "course.name AS category", 1 => "situation.situation_short", 2 => "IFNULL(COUNT(student.id),0) AS total"), $wheres, $group_bys
                ));


            return view($this->way[0] . 'index', compact([
                'object', $object,
                'objects', $objects,
                'campus', $campus,
                'students_by_idade_ingresso', $students_by_idade_ingresso,
                'students_by_idade_situacao', $students_by_idade_situacao,
                'students_by_semesters', $students_by_semesters,
                'students_by_genre', $students_by_genre,
                'students_by_ano_semestre', $students_by_ano_semestre,
                'students_by_period', $students_by_period,
                'students_by_course', $students_by_course
            ]));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect('/');
        }
    }
}