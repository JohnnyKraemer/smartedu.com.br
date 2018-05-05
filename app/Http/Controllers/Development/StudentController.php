<?php

namespace App\Http\Controllers\Development;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\DB;
use Redirect;

class StudentController extends Controller
{
    private $way;
    private $name;
    private $student_repository;

    public function __construct(StudentRepository $student_repository)
    {
        $this->way = array();
        array_push($this->way, 'development.student.');
        array_push($this->way, 'development/student');

        $this->name = 'aluno';
        $this->student_repository = $student_repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $objects =
                $this->student_repository->getStudents(
                    array(
                        0 => "student.name",
                        1 => "detail.year_situation",
                        2 => "detail.semester_situation",
                        3 => "detail.period",
                        4 => "student.quota",
                        5 => "detail.semesters",
                        6 => "situation.situation_long",
                        7 => "situation.situation_short",
                        8 => "student.id")
                );

            /*
            $objects = DB::table('student')
            ->leftJoin('course', 'student.course_id', '=', 'course.id')
            ->select('student.code', 'student.name', 'course.name')
            ->distinct()
            ->get()
            ->toJson();*/

            //$objects = ObjectClass::base();
            //dd($objects);
            //$objects = ObjectClass::all()->toJson();
            return view($this->way[0] . 'index', compact(['objects', $objects]));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
