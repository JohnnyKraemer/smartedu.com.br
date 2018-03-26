<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Detail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Student extends Model
{
    protected $table = 'student';
    protected $appends = ['last_details', 'course', 'campus', 'situation', 'prob_evaded'];

    protected $fillable = [
        'id',
        'nome',
        'codigo',
        'ano_ingresso',
        'data_nascimento',
        'forma_ingresso',
        'genero',
        'mudou_curso_mesmo_campus',
        'mudou_curso_outro_campus',
        'municipio',
        'municipio_sisu',
        'enem_humanas',
        'enem_linguagem',
        'enem_matematica',
        'enem_natureza',
        'enem_redacao',
        'nota_final_sisu',
        'entradas_outro_curso',
        'entradas_curso',
        'pais_nascimento',
        'semestre_ingresso',
        'cota',
        'uf',
        'uf_sisu',
        'idade_ingresso',
        'course_id'];

    public function detail()
    {
        return $this->belongsToMany(Detail::class, 'student_detail', 'student_id', 'detail_id');
    }

    public function getDetailsAttribute()
    {
        return Detail::where('student_id', $this->id)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getLastDetailsAttribute()
    {
        return DB::select('SELECT detail.*
                                FROM student
                                LEFT JOIN detail ON student.id = detail.student_id
                                LEFT JOIN course ON student.course_id = course.id
                                LEFT JOIN campus ON course.campus_id = campus.id
                                LEFT JOIN situation ON detail.situation_id = situation.id
                                WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                                AND student.id = :id ;', ['id' => $this->id])[0];
    }

    public function getProbEvadedAttribute()
    {
        try {
            $probability_evasion = DB::select('SELECT IFNULL(probability.probability_evasion,9999) as probability_evasion
                                FROM test_classifier
                                LEFT JOIN probability
                                ON test_classifier.id = probability.test_classifier_id
                                WHERE test_classifier.period_calculation = (SELECT MAX(test_classifier.period_calculation)
                                                                  FROM test_classifier 
                                                                  WHERE test_classifier.type = 9
                                                                  AND test_classifier.result = 1)
                                AND test_classifier.type = 9
                                AND test_classifier.result = 1
                                AND probability.student_id = :id ;', ['id' => $this->id])[0]->probability_evasion;

            if ($probability_evasion != 0 && $probability_evasion != 9999) {
                return number_format(($probability_evasion * 100), 2, '.', ',');
            } else if($probability_evasion == 0){
                return 0;
            }else{
                return "-- ";
            }
        }catch (\Exception $e){
            return "-- ";
        }
    }

    public function getSituationAttribute()
    {
        return DB::select('SELECT situation.*
                                FROM student
                                LEFT JOIN detail ON student.id = detail.student_id
                                LEFT JOIN course ON student.course_id = course.id
                                LEFT JOIN campus ON course.campus_id = campus.id
                                LEFT JOIN situation ON detail.situation_id = situation.id
                                WHERE detail.periodo_carga = (SELECT MAX(detail.periodo_carga) FROM detail WHERE detail.student_id = student.id)
                                AND student.id = :id ;', ['id' => $this->id])[0];
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function getCourseAttribute()
    {
        return Course::find($this->course_id);
    }

    public function getCampusAttribute()
    {

        return Campus::find($this->getCourseAttribute()->campus_id);
    }

    public function base()
    {
        //$student = DB::table('student')->select('name', 'email as user_email')->get();

        $students = DB::table('student')
            ->leftJoin('detail', 'student.id', '=', 'detail.student_id')
            ->leftJoin('course', 'student.course_id', '=', 'course.id')
            ->select('student.*', 'detail.id', 'course.name')
            ->get();

        return $students;
    }
}
