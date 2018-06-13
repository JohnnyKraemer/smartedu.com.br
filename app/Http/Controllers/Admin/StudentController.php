<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\DetailRepository;
use Exception;
use Illuminate\Http\Request;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Student as ObjectClass;

class StudentController extends Controller
{
    private $way;
    private $name;
    private $student_repository;
    private $detail_repository;
    private $cache;
    private $time_cache;

    public function __construct(StudentRepository $student_repository,
                                DetailRepository $detailRepository,
                                \Illuminate\Cache\Repository $cache)
    {
        $this->way = array();
        array_push($this->way, 'admin.student.');
        array_push($this->way, 'admin/student');

        $this->name = 'aluno';
        $this->student_repository = $student_repository;
        $this->detailRepository = $detailRepository;
        $this->cache = $cache;
        $this->time_cache = 60;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        try {
            try {
                $object = null;
                $students = null;
                $loggedUser = \Auth::user();
                if ($loggedUser->position_id == 1 || $loggedUser->position_id == 2) {
                    $object = ObjectClass::findOrFail($id);

                    $students = $this->student_repository->getStudents(
                        array(0 => "student.id", 1 => "student.name", 2 => "course.name AS course_name", 3 => "student.code"),
                        array(array(0 => "1", 1 => " = ", 2 => 1)),
                        array(0 => "student.id", 1 => "student.name", 2 => "course_name", 3 => "student.code")
                    );

                } else {
                    if ($loggedUser->position_id == 3) {
                        $courses = $loggedUser->campus->courses;
                    } else if ($loggedUser->courses != "-") {
                        $courses = $loggedUser->courses;
                    } else {
                        $request->session()->flash('type', 'danger');
                        $request->session()->flash('message', 'Ocorreu um erro no sistema!');
                        return redirect('/');
                    }

                    //dd($courses);
                    $wher = "";

                    for ($i = 0; $i < count($courses); $i++) {
                        if ($i == (count($courses) - 1)) {
                            $wher = $wher . " course.id = " . $courses[$i]->id;
                        } else {
                            $wher = $wher . " course.id = " . $courses[$i]->id . " OR";
                        }

                    }

                    if (!$this->cache->has('students1')) {
                        $students = $this->student_repository->getStudents(
                            array(0 => "student.id", 1 => "student.name", 2 => "course.name AS course_name", 3 => "student.code"),
                            array(array(0 => " ", 1 => " ", 2 => " " . $wher)),
                            array(0 => "student.id", 1 => "student.name", 2 => "course_name", 3 => "student.code")
                        );
                        $this->cache->put('students', $students, $this->time_cache);
                    }
                    $students = $this->cache->get('students');

                    foreach ($students as $student) {
                        if ($student->id == $id) {
                            try {
                                $object = ObjectClass::findOrFail($id);
                            } catch (Exception $e) {
                                $request->session()->flash('type', 'danger');
                                $request->session()->flash('message', 'Este ' . $this->name . '  não existe!');
                                return redirect('/');
                            }
                        }
                    }
                    if ($object == null) {
                        $request->session()->flash('type', 'danger');
                        $request->session()->flash('message', 'Você não tem permissão para acessar está área!');
                        return redirect('/admin/student/' . $students[0]->id);
                    }
                }
            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', 'Ocorreu um erro no sistema!');
                dd($e);
                //return redirect('/');
            }

            $details = $this->detailRepository->findBy(
                array(array(0 => "student_id", 1 => "=", 2 => $object->id))
            );

            //dd($details);

            return view($this->way[0] . 'index', compact([
                'object', $object,
                'students', $students,
                'details', $details
            ]));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
