<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Situation as ObjectClass;
use Exception;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class SituationController extends Controller
{
    private $way;
    private $name;
    private $messages;

    public function __construct()
    {
        $this->way = array();
        array_push($this->way, 'admin.situation.');
        array_push($this->way, 'admin/situation');

        $this->name = 'situação do aluno';

        $this->messages = [
            'required' => 'O :attribute é obrigatório.',
            'same' => 'Os campos :attribute e :other devem ser iguais.',
            'size' => 'O campo :attribute deve ter o tamnho igual a :size.',
            'between' => 'O campo :attribute deve ter um valor entre :min e :max.',
            //'in' => 'The :attribute must be one of the following types: :values',
            'unique' => 'Este :attribute já está em uso.',
            'min' => 'O :attribute deve ter no mínimo :min caracteres.',
            'max' => 'O :attribute deve ter no máximo :min caracteres.',
        ];
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

            return view($this->way[0] . 'index', compact([
                'objects', $objects,
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
        try {
            try {
                $object = ObjectClass::findOrFail($id);
            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', 'Este ' . $this->name . '  não existe!');
                return redirect($this->way[1]);
            }

            return view($this->way[0] . 'edit', compact([
                'object', $object,
            ]));

        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema!');
            return redirect($this->way[1]);
        }
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
        $validator = Validator::make($request->all(), [
            'situation_short' => 'required',
            'description' => 'required',
        ], $this->messages);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            try {
                try {
                    $object = ObjectClass::findOrFail($id);
                } catch (Exception $e) {
                    $request->session()->flash('type', 'danger');
                    $request->session()->flash('message', 'Este ' . $this->name . '  não existe!');
                    return redirect($this->way[1]);
                }

                $object->situation_short = $request->situation_short;
                $object->description = $request->description;
                $object->save();

                $request->session()->flash('type', 'success');
                $request->session()->flash('message', ucfirst($this->name . ' atualizado com sucesso!'));
                return redirect($this->way[1]);

            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', ucfirst('Erro ao atualizar ' . $this->name . '.'));
                return redirect($this->way[1]);
            }
        }
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
