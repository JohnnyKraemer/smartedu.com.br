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

            //dd($objects);

            //$objects = json_encode($objects);
            //dd($objects->toJson());

            $evaded_by_yaer_semester = json_encode($this->student_repository->getEvadedByYearAndSemesterAndCourse($id));
            $students_evaded_by_genre = json_encode($this->student_repository->getEvadedByGenreAndCourse($id));
            $students_evaded_by_period = json_encode($this->student_repository->getEvadedByPeriodAndCourse($id));
            $students_evaded_by_genre_complete = json_encode($this->student_repository->getEvadedByGenreAndCourseComplete($id));

            $students_by_idade_ingresso = json_encode(
                $this->student_repository->getCountStudensBySituationShortAndColumn(
                    array(0 => "student.idade_ingresso" , 1 => "situation.situation_short"),
                    array(array(0 => "course.id", 1 => "=", 2 => $id)),
                    "student.idade_ingresso"
                ));


            return view($this->way[0] . 'index', compact([
                'object', $object,
                'objects', $objects,
                'evaded_by_yaer_semester', $evaded_by_yaer_semester,
                'students_evaded_by_genre', $students_evaded_by_genre,
                'students_evaded_by_period', $students_evaded_by_period,
                'bests_test', $bests_test,
                'courses', $courses,
                'all_campus', $all_campus,
                'students_evaded_by_genre_complete', $students_evaded_by_genre_complete,
                'students_by_idade_ingresso', $students_by_idade_ingresso
            ]));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect('/');
        }
    }
}