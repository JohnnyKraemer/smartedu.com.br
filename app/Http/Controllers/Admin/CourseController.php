<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course as ObjectClass;
use App\Models\Campus;
use Exception;
use Redirect;
use Validator;


class CourseController extends Controller
{
    private $way;
    private $name;

    public function __construct()
    {
        $this->way = array();
        array_push($this->way, 'admin.course.');
        array_push($this->way, 'admin/course');

        $this->name = 'curso';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $objects = ObjectClass::all()->toJson();
            $campus = Campus::all();

            return view($this->way[0] . 'index', compact(['objects', $objects,'campus', $campus,]));
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
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    }
}