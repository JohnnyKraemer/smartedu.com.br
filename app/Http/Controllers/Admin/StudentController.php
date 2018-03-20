<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;

class StudentController extends Controller
{
    private $way;
    private $name;

    public function __construct()
    {
        $this->way = array();
        array_push($this->way, 'admin.student.');
        array_push($this->way, 'admin/student');

        $this->name = 'aluno';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $objects = DB::table('student')
                ->leftJoin('detail', 'student.id', '=', 'detail.student_id')
                ->leftJoin('course', 'student.course_id', '=', 'course.id')
                ->leftJoin('situation', 'detail.situation_id', '=', 'situation.id')
                ->select('student.codigo', 'student.nome','detail.periodo_carga', 'situation.situation_long', 'course.name')
                ->where('detail.periodo_carga', '=',DB::raw("(SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)"))
                ->distinct()
                ->get()
                ->toJson();

            /*
            $objects = DB::table('student')
            ->leftJoin('course', 'student.course_id', '=', 'course.id')
            ->select('student.codigo', 'student.nome', 'course.name')
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
