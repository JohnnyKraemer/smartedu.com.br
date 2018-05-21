<?php

namespace App\Http\Controllers\Development;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Detail;
use App\Models\Situation;
use App\Models\Student;
use App\Repositories\CampusRepository;
use App\Repositories\CourseRepository;
use App\Repositories\DetailRepository;
use Illuminate\Http\Request;
use App\Repositories\StudentRepository;

class UploadController extends Controller
{

    private $way;
    private $name;
    private $student_repository;
    private $detail_repository;
    private $campus_repository;
    private $course_repository;

    public function __construct(StudentRepository $student_repository,
                                DetailRepository $detail_repository,
                                CampusRepository $campus_repository,
                                CourseRepository $course_repository)
    {
        $this->way = array();
        array_push($this->way, 'development.upload.');
        array_push($this->way, 'development/upload');

        $this->name = 'upload';
        $this->detail_repository = $detail_repository;
        $this->student_repository = $student_repository;
        $this->campus_repository = $campus_repository;
        $this->course_repository = $course_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            //$objects = ObjectClass::all()->toJson();
            return view($this->way[0] . 'index');
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect('/');
        }
    }

    public function upload(Request $request)
    {
        $data = $request->get('data');
        $quant = 0;
        $count_courses = 0;
        $count_campus = 0;
        $count_students = 0;
        $count_details = 0;

        try {
            foreach ($data as $mydata) {
                try {
                    $campus = $this->campus_repository->get(
                        array(0 => "id"),
                        array(
                            array(0 => "name", 1 => " = ", 2 => "'" . $mydata["Câmpus"] . "'")
                        ),
                        array(0 => "id")
                    );
                    if($campus == null){
                        $campus = Campus::create([
                            'name' => $mydata["Câmpus"],
                            'city' => $mydata["Sede"],
                        ]);
                        $campus = $campus->id;
                        $count_campus = $count_campus + 1;
                    }else{
                        $campus = $campus[0]->id;
                    }
                } catch (Exception $e) {
                    return "Erro ao criar/buscar o Campus!";
                }

                try {
                    $course = $this->course_repository->get(
                        array(0 => "id"),
                        array(
                            array(0 => "name", 1 => " = ", 2 => "'" . $mydata["Curso"] . "'"),
                            array(0 => "campus_id", 1 => " = ", 2 => $campus)
                        ),
                        array(0 => "id")
                    );
                    if($course == null){
                        $course = Course::create([
                            'name' => $mydata["Curso"],
                            'level' => $mydata["Nível de ensino"],
                            'degree' => $mydata["Grau"],
                            'frequency' => $mydata["Periodicidade"],
                            'operation' => $mydata["Funcionamento"],
                            'amount_periods' => $mydata["Total de períodos do curso"],
                            'campus_id' => $campus,
                        ]);
                        $course = $course->id;
                        $count_courses = $count_courses + 1;
                    }else{
                        $course = $course[0]->id;
                    }
                } catch (Exception $e) {
                    return "Erro ao criar/buscar o Curso!";
                }

                try {
                    $student = $this->student_repository->getStudentsBase(
                        array(0 => "student.id"),
                        array(
                            array(0 => "student.name", 1 => " = ", 2 => "'" . $mydata["Nome"] . "'"),
                            array(0 => "student.code", 1 => " = ", 2 => $mydata["Código"]),
                            array(0 => "student.course_id", 1 => " = ", 2 => $course),
                            array(0 => "student.year_ingress", 1 => " = ", 2 => $mydata["Ano de ingresso"]),
                            array(0 => "student.semester_ingress", 1 => " = ", 2 => $mydata["Semestre de ingresso no curso"])
                        ),
                        array(0 => "student.id")
                    );


                    if ($student == null) {
                        $dataNascimento = $mydata["Data de nascimento"];
                        $dataIngresso = $mydata["Data de ingresso"];

                        if ($dataIngresso == "-") {
                            $dataIngresso = null;
                        }

                        if ($dataNascimento == "-") {
                            $dataNascimento = null;
                        }

                        if ($dataNascimento != null && $dataIngresso != null) {
                            list($anoNascimento, $mesNascimento, $diaNascimento) = explode('-', $dataNascimento);
                            list($anoIngresso, $mesIngresso, $diaIngresso) = explode('-', $dataIngresso);
                            $ingresso = mktime(0, 0, 0, $mesIngresso, $diaIngresso, $anoIngresso);
                            $nascimento = mktime(0, 0, 0, $mesNascimento, $diaNascimento, $anoNascimento);
                            $idadeIngresso = floor((((($ingresso - $nascimento) / 60) / 60) / 24) / 365.25);
                        } else {
                            $idadeIngresso = null;
                        }

                        $enemHumanas = null;
                        $enemLinguagem = null;
                        $enemMatematica = null;
                        $enemNatureza = null;
                        $enemRedacao = null;
                        $notaFinalSISU = null;


                        if ($mydata["Nota ENEM Humanas"] != "-") {
                            $enemHumanas = $mydata["Nota ENEM Humanas"];
                        }

                        if ($mydata["Nota ENEM Liguagem"] != "-") {
                            $enemLinguagem = $mydata["Nota ENEM Liguagem"];
                        }

                        if ($mydata["Nota ENEM Matemática"] != "-") {
                            $enemMatematica = $mydata["Nota ENEM Matemática"];
                        }

                        if ($mydata["Nota ENEM Natureza"] != "-") {
                            $enemNatureza = $mydata["Nota ENEM Natureza"];
                        }

                        if ($mydata["Nota ENEM Redação"] != "-") {
                            $enemRedacao = $mydata["Nota ENEM Redação"];
                        }

                        if ($mydata["Nota final SISU"] != "-") {
                            $notaFinalSISU = $mydata["Nota final SISU"];
                        }

                        if ($mydata["Nota ENEM Natureza"] != "-") {
                            $enemNatureza = $mydata["Nota ENEM Natureza"];
                        }

                        $student = Student::create([
                            'name' => $mydata["Nome"],
                            'code' => $mydata["Código"],
                            'year_ingress' => $mydata["Ano de ingresso"],
                            'genre' => $mydata["Gênero"],
                            'age' => $idadeIngresso,
                            'birth_date' => $dataNascimento,
                            'type_ingress' => $mydata["Forma de ingresso"],
                            'changed_course' => $mydata["Mudou de curso - mesmo câmpus"],
                            'changed_course_campus' => $mydata["Mudou de curso - outro câmpus"],
                            'municipality' => $mydata["Município"],
                            'municipality_sisu' => $mydata["Município SISU"],
                            'email' => $mydata["E-mail"],
                            'enem_human' => $enemHumanas,
                            'enem_language' => $enemLinguagem,
                            'enem_math' => $enemMatematica,
                            'enem_nature' => $enemNatureza,
                            'enem_redaction' => $enemRedacao,
                            'sisu' => $notaFinalSISU,
                            'entries_other_course' => $mydata["Número de entradas em outros cursos"],
                            'entries_course' => $mydata["Número de entradas no curso"],
                            'country' => $mydata["País de nascimento"],
                            'semester_ingress' => $mydata["Semestre de ingresso no curso"],
                            'quota' => $mydata["Tipo de cota"],
                            'state' => $mydata["UF"],
                            'state_sisu' => $mydata["UF SISU"],
                            'course_id' => $course,
                        ]);
                        $student = $student->id;
                        $count_students = $count_students + 1;
                    } else {
                        $student = $student[0]->id;
                    }
                } catch (Exception $e) {
                    return "Erro ao criar/buscar o Aluno!";
                }

                try {
                    $situation = Situation::firstOrCreate([
                        'situation_long' => $mydata["Situação"],
                        'description' => $mydata["Situação"],
                    ]);
                } catch (Exception $e) {
                    return "Erro ao criar/buscar a Situação!";
                }

                try {
                    $loading_period = $mydata["Ano"] . "-" . $mydata["Semestre"];
                    $detail = $this->detail_repository->getDetail(
                        array(0 => "detail.id"),
                        array(
                            array(0 => "detail.loading_period", 1 => " = ", 2 => "'" . $loading_period . "'"),
                            array(0 => "detail.student_id", 1 => " = ", 2 => $student),
                            array(0 => "detail.period", 1 => " = ", 2 => $mydata["Período"]),
                            array(0 => "detail.semesters", 1 => " = ", 2 => $mydata["Total de semestres cursados"]),
                            array(0 => "detail.situation_id", 1 => " = ", 2 => $situation->id)
                        )
                    );

                    if ($detail == null) {
                        $cr = null;
                        if ($mydata["Coeficiente de rendimento"] != "-") {
                            $cr = $mydata["Coeficiente de rendimento"];
                        } else {
                            $cr = null;
                        }

                        $detail = Detail::create([
                            'loading_period' => $loading_period,
                            'period' => $mydata["Período"],
                            'matrix' => $mydata["Matriz curricular"],
                            'age_situation' => $mydata["Idade"],
                            'coefficient' => $cr,
                            'year_situation' => $mydata["Ano"],
                            'semester_situation' => $mydata["Semestre"],
                            'semesters' => $mydata["Total de semestres cursados"],
                            'disciplines_approved' => $mydata["Disciplinas aprovadas"],
                            'disciplines_consigned' => $mydata["Disciplinas consignadas"],
                            'disciplines_matriculate' => $mydata["Disciplinas matriculadas"],
                            'disciplines_reprovated_frequency' => $mydata["Disciplinas reprovadas por frequência"],
                            'disciplines_reprovated_note' => $mydata["Disciplinas reprovadas por nota"],
                            'likely_retirement' => $mydata["Provável jubilamento"],
                            'situation_id' => $situation->id,
                            'student_id' => $student,
                        ]);
                        //$student = Student::find($student);
                        //$student->detail()->attach($detail);
                        $count_details = $count_details + 1;
                    }
                } catch (Exception $e) {
                    return "Erro ao criar/buscar o Detalhe!";
                }
                $quant = $quant + 1;
            }

            $result = [
                "campus" => $count_campus,
                "courses" => $count_courses,
                "students" => $count_students,
                "details" => $count_details,
                "amount_data" => $quant
            ];

            return $result;
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
