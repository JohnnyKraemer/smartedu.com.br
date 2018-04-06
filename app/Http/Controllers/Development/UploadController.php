<?php

namespace App\Http\Controllers\Development;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Detail;
use App\Models\Situation;
use App\Models\Student;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    private $way;
    private $name;

    public function __construct()
    {
        $this->way = array();
        array_push($this->way, 'development.upload.');
        array_push($this->way, 'development/upload');

        $this->name = 'upload';
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

        //dd($data);

        try {
            foreach ($data as $mydata) {
                try {
                    $campus = Campus::firstOrCreate([
                        'name' => $mydata["Câmpus"],
                        'city' => $mydata["Sede"],
                    ]);
                } catch (Exception $e) {
                    return "Erro ao criar/buscar o Campus!";
                }

                try {
                    $course = Course::firstOrCreate([
                        'name' => $mydata["Curso"],
                        'nivel_ensino' => $mydata["Nível de ensino"],
                        'grau' => $mydata["Grau"],
                        'periodicidade' => $mydata["Periodicidade"],
                        'funcionamento' => $mydata["Funcionamento"],
                        'categoria_stricto_sensu' => $mydata["Categoria stricto sensu"],
                        'codigo_curso' => $mydata["Código do curso"],
                        'codigo_inep_curso' => $mydata["Código INEP do curso"],
                        'regime_ensino' => $mydata["Regime de ensino"],
                        'total_periodos' => $mydata["Total de períodos do curso"],
                        'campus_id' => $campus->id,
                    ]);

                } catch (Exception $e) {
                    return "Erro ao criar/buscar o Curso!";
                }

                try {
                    $dataNascimento = $mydata["Data de nascimento"];
                    $dataIngresso = $mydata["Data de ingresso"];

                    if($dataIngresso == "-"){
                        $dataIngresso = null;
                    }

                    if($dataNascimento == "-"){
                        $dataNascimento = null;
                    }

                    if($dataNascimento != null && $dataIngresso != null){
                        list($anoNascimento, $mesNascimento, $diaNascimento) = explode('-', $dataNascimento);
                        list($anoIngresso, $mesIngresso, $diaIngresso) = explode('-', $dataIngresso);
                        $ingresso = mktime(0, 0, 0, $mesIngresso, $diaIngresso, $anoIngresso);
                        $nascimento = mktime( 0, 0, 0, $mesNascimento, $diaNascimento, $anoNascimento);
                        $idadeIngresso = floor((((($ingresso - $nascimento) / 60) / 60) / 24) / 365.25);
                    }else{
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

                    $student = Student::firstOrCreate([
                        'nome' => $mydata["Nome"],
                        'codigo' => $mydata["Código"],
                        'ano_ingresso' => $mydata["Ano de ingresso"],
                        'genero' => $mydata["Gênero"],
                        'idade_ingresso' => $idadeIngresso,
                        'data_nascimento' => $dataNascimento,
                        'forma_ingresso' => $mydata["Forma de ingresso"],
                        'mudou_curso_mesmo_campus' => $mydata["Mudou de curso - mesmo câmpus"],
                        'mudou_curso_outro_campus' => $mydata["Mudou de curso - outro câmpus"],
                        'municipio' => $mydata["Município"],
                        'municipio_sisu' => $mydata["Município SISU"],
                        'email' => $mydata["E-mail"],
                        'enem_humanas' => $enemHumanas,
                        'enem_linguagem' => $enemLinguagem,
                        'enem_matematica' => $enemMatematica,
                        'enem_natureza' => $enemNatureza,
                        'enem_redacao' => $enemRedacao,
                        'nota_final_sisu' => $notaFinalSISU,
                        'entradas_outro_curso' => $mydata["Número de entradas em outros cursos"],
                        'entradas_curso' => $mydata["Número de entradas no curso"],
                        'pais_nascimento' => $mydata["País de nascimento"],
                        'semestre_ingresso' => $mydata["Semestre de ingresso no curso"],
                        'cota' => $mydata["Tipo de cota"],
                        'uf' => $mydata["UF"],
                        'uf_sisu' => $mydata["UF SISU"],
                        'course_id' => $course->id,
                    ]);
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
                    $cr = null;

                    if ($mydata["Coeficiente de rendimento"] != "-") {
                        $cr = $mydata["Coeficiente de rendimento"];
                    }else{
                        $cr = null;
                    }

                    $detail = Detail::firstOrCreate([
                        'periodo_carga' => $mydata["Ano"] . "-" . $mydata["Semestre"],
                        'periodo' => $mydata["Período"],
                        'matriz' => $mydata["Matriz curricular"],
                        'idade_situacao' => $mydata["Idade"],
                        'cr' => $cr,
                        'ano_situacao' => $mydata["Ano"],
                        'semestre_situacao' => $mydata["Semestre"],
                        'quant_semestre_cursados' => $mydata["Total de semestres cursados"],
                        'disciplinas_aprovadas' => $mydata["Disciplinas aprovadas"],
                        'disciplinas_consignadas' => $mydata["Disciplinas consignadas"],
                        'disciplinas_matriculadas' => $mydata["Disciplinas matriculadas"],
                        'disciplinas_reprovadas_frequencia' => $mydata["Disciplinas reprovadas por frequência"],
                        'disciplinas_reprovadas_nota' => $mydata["Disciplinas reprovadas por nota"],
                        'provavel_jubilamento' => $mydata["Provável jubilamento"],
                        'retencao_parcial' => $mydata["Retenção parcial"],
                        'retencao_total' => $mydata["Retenção total"],
                        'situation_id' => $situation->id,
                        'student_id' => $student->id,
                    ]);
                } catch (Exception $e) {
                    return "Erro ao criar/buscar o Detalhe!";
                }

                try {
                    $student->detail()->attach($detail);
                } catch (Exception $e) {
                    return "Erro ao atribuir o Detalhe ao Aluno!";
                }
            }

            //$courses = \App\Models\Course::all();

            //foreach ($courses as $course){
            //    if($course->students_formed > 50 && $course->students_evaded > 50){
            //        $course->use_classify = 1;
           //     }else{
           //         $course->use_classify = 0;
            //    }
           // }

            return $data;
        } catch (Exception $e) {
            dd($e);
            return $data;
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
