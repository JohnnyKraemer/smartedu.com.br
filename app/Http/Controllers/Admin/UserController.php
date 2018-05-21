<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Position;
use App\User as ObjectClass;
use Exception;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class UserController extends Controller
{
    private $way;
    private $name;
    private $messages;

    public function __construct()
    {
        $this->way = array();
        array_push($this->way, 'admin.user.');
        array_push($this->way, 'admin/user');

        $this->name = 'usuário';

        $this->messages = [
            'required' => 'O :attribute é obrigatório.',
            'same' => 'Os campos :attribute e :other devem ser iguais.',
            'size' => 'O campo :attribute deve ter o tamnho igual a :size.',
            'between' => 'O campo :attribute deve ter um valor entre :min e :max.',
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
            $loggedUser = \Auth::user();
            if($loggedUser->position_id == 1){
                $objects = ObjectClass::all();
            }else{
                $objects = ObjectClass::where('position_id', '!=' ,1)
                    ->orderBy('position_id', 'asc')
                    ->get();
            }
            return view('admin.user.index', compact([
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
        try {
            $positions = Position::all();
            $courses = Course::all();
            $campus = Campus::all();
            return view($this->way[0] . 'create', compact([
                'positions', $positions,
                'courses', $courses,
                'campus', $campus,
            ]));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->position_id == 2 || $request->position_id == 3) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:6|max:191',
                'email' => 'required|email|unique:user|max:191',
                'position_id' => 'required',
                'campus_id' => 'required',
                'courses' => 'required',
            ], $this->messages);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:6|max:191',
                'email' => 'required|email|unique:user|max:191',
                'position_id' => 'required',
                'campus_id' => 'required',
            ], $this->messages);
        }

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            try {
                $object = ObjectClass::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'status' => 1,
                    'position_id' => $request->position_id,
                    'campus_id' => $request->campus_id,
                ]);

                if ($request->position_id == 2 || $request->position_id == 3) {
                    foreach ($request->get('courses') as $id) {
                        $course = Course::find($id);
                        if ($course->campus_id == $object->campus_id) {
                            $object->course()->attach($course);
                        }
                    }
                }

                $request->session()->flash('type', 'success');
                $request->session()->flash('message', ucfirst($this->name . ' criado com sucesso!'));
                return redirect($this->way[1]);
            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', ucfirst('Erro ao criar ' . $this->name . '.'));
                return redirect($this->way[1]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            try {
                $object = ObjectClass::findOrFail($id);
            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', 'Este ' . $this->name . ' não existe!');
                return redirect($this->way[1]);
            }
            return view($this->way[0] . 'show', compact('object', $object));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect($this->way[1]);
        }
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
            $positions = Position::all();
            $courses = Course::all();
            $campus = Campus::all();

            return view($this->way[0] . 'edit', compact([
                'object', $object,
                'positions', $positions,
                'courses', $courses,
                'campus', $campus,
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
        if ($request->position_id == 4 || $request->position_id == 5) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:6|max:191',
                'email' => 'required|email|max:191',
                'position_id' => 'required',
                'campus_id' => 'required',
                'courses' => 'required',
            ], $this->messages);
        } else if($request->position_id == 3 ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:6|max:191',
                'email' => 'required|email|max:191',
                'position_id' => 'required',
                'campus_id' => 'required',
            ], $this->messages);
        }else if($request->position_id == 1 || $request->position_id == 2){
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:6|max:191',
                'email' => 'required|email|max:191',
                'position_id' => 'required',
            ], $this->messages);
        }

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

                $object->name = $request->name;
                $object->email = $request->email;
                $object->position_id = $request->position_id;
                $object->status = $request->status;

                if ($request->position_id == 4 || $request->position_id == 5) {
                    $object->campus_id = $request->campus_id;
                } else if($request->position_id == 3 ){
                    $object->campus_id = $request->campus_id;
                }else if($request->position_id == 1 || $request->position_id == 2){
                    $object->campus_id = null;
                }
                $object->save();
                $object->course()->detach();

                if ($request->position_id == 4 || $request->position_id == 5) {
                    foreach ($request->get('courses') as $id) {
                        $course = Course::find($id);
                        if ($course->campus_id == $object->campus_id) {
                            $object->course()->attach($course);
                        }
                    }
                }

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
        try {
            try {
                $object = ObjectClass::findOrFail($request->var_delete);
            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', 'Este ' . $this->name . '  não existe!');
                return redirect($this->way[1]);
            }
            $object->course()->detach();
            $object->delete();

            $request->session()->flash('type', 'success');
            $request->session()->flash('message', ucfirst($this->name . ' deletado com sucesso!'));
            return redirect($this->way[1]);
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', ucfirst('Erro ao deletar ' . $this->name . '.'));
            return redirect($this->way[1]);
        }
    }
}
