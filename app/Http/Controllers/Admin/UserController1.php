<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Position;
use App\User as User;
use Exception;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class UserController1 extends Controller
{
    public function __construct()
    {
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

    public function index(Request $request)
    {
        try {
            $objects = User::all();
            return view('admin.user.index', compact([
                'objects', $objects,
            ]));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect('/');
        }
    }

    public function create(Request $request)
    {
        try {
            $positions = Position::all();
            $courses = Course::all();
            $campus = Campus::all();
            return view('admin.user.create', compact([
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:6|max:191',
            'email' => 'required|email|unique:user|max:191',
            'position_id' => 'required',
            'campus_id' => 'required',
            'courses' => 'required',
        ], $this->messages);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            try {
                $object = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'status' => 1,
                    'position_id' => $request->position_id,
                    'campus_id' => $request->campus_id,
                ]);

                foreach ($request->get('courses') as $id) {
                    $course = Course::find($id);
                    if ($course->campus_id == $object->campus_id) {
                        $object->course()->attach($course);
                    }
                }

                $request->session()->flash('type', 'success');
                $request->session()->flash('message', ucfirst('Usuário criado com sucesso!'));
                return redirect('admin/user');
            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', ucfirst('Erro ao criar usuário.'));
                return redirect('admin/user');
            }
        }
    }

    public function show(Request $request, $id)
    {
        try {
            try {
                $object = User::findOrFail($id);
            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', 'Este usuário não existe!');
                return redirect('admin/user');
            }
            return view('admin.user.show', compact('object', $object));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect('admin/user');
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            try {
                $object = User::findOrFail($id);
            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', 'Este usuário não existe!');
                return redirect('admin/user');
            }
            $positions = Position::all();
            $courses = Course::all();
            $campus = Campus::all();

            return view('admin.user.edit', compact([
                'object', $object,
                'positions', $positions,
                'courses', $courses,
                'campus', $campus,
            ]));

        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema!');
            return redirect('admin/user');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:6|max:191',
            'email' => 'required|email|max:191',
            'position_id' => 'required',
            'campus_id' => 'required',
            'courses' => 'required',
        ], $this->messages);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            try {
                try {
                    $object = User::findOrFail($id);
                } catch (Exception $e) {
                    $request->session()->flash('type', 'danger');
                    $request->session()->flash('message', 'Este usuário  não existe!');
                    return redirect('admin/user');
                }

                $object->name = $request->name;
                $object->email = $request->email;
                $object->position_id = $request->position_id;
                $object->status = $request->status;
                $object->campus_id = $request->campus_id;
                $object->save();
                $object->course()->detach();

                foreach ($request->get('courses') as $id) {
                    $course = Course::find($id);
                    if ($course->campus_id == $object->campus_id) {
                        $object->course()->attach($course);
                    }
                }

                $request->session()->flash('type', 'success');
                $request->session()->flash('message', ucfirst('Usuário atualizado com sucesso!'));
                return redirect('admin/user');

            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', ucfirst('Erro ao atualizar usuário.'));
                return redirect('admin/user');
            }
        }
    }

    public function destroy(Request $request)
    {
        try {
            try {
                $object = User::findOrFail($request->var_delete);
            } catch (Exception $e) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', 'Este usuário não existe!');
                return redirect('admin/user');
            }
            $object->course()->detach();
            $object->delete();

            $request->session()->flash('type', 'success');
            $request->session()->flash('message', ucfirst('Usuário deletado com sucesso!'));
            return redirect('admin/user');
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', ucfirst('Erro ao deletar usuário.'));
            return redirect('admin/user');
        }
    }
}
