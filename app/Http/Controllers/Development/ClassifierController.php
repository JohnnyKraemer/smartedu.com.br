<?php

namespace App\Http\Controllers\Development;

use App\Http\Controllers\Controller;
use App\Models\Classifier as ObjectClass;
use Exception;
use Illuminate\Http\Request;
use Redirect;

class ClassifierController extends Controller
{
    private $way;
    private $name;

    public function __construct()
    {
        $this->way = array();
        array_push($this->way, 'development.classifier.');
        array_push($this->way, 'development/classifier');

        $this->name = 'classificador';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $objects = ObjectClass::all();
            return view($this->way[0] . 'index', compact(['objects', $objects]));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect('/');
        }
    }

    public function alterState(Request $request, $state, $id)
    {
        try {
            try {
                $object = ObjectClass::findOrFail($id);
            } catch (Exception $e) {
                return $e;
            }

            if ($object->$state == 0) {
                $object->$state = 1;
            } else {
                $object->$state = 0;
            }

            $object->save();
            return $object;
        } catch (Exception $e) {
            return $e;
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
