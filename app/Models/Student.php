<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Detail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    protected $table = 'student';
    protected $appends = ['details', 'course', 'campus', 'base'];

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

    public function base(){
        //$student = DB::table('student')->select('name', 'email as user_email')->get();

        $students = DB::table('student')
            ->leftJoin('detail', 'student.id', '=', 'detail.student_id')
            ->leftJoin('course', 'student.course_id', '=', 'course.id')
            ->select('student.*', 'detail.id', 'course.name')
            ->get();

        return $students;
    }
}
