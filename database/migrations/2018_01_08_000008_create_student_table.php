<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('code');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('genre');
            $table->smallInteger('age')->nullable();
            $table->double('enem_human', 8, 2)->nullable();
            $table->double('enem_language', 8, 2)->nullable();
            $table->double('enem_math', 8, 2)->nullable();
            $table->double('enem_nature', 8, 2)->nullable();
            $table->double('enem_redaction', 8, 2)->nullable();
            $table->double('sisu', 8, 2)->nullable();
            $table->string('quota')->nullable();
            $table->smallInteger('year_ingress');
            $table->smallInteger('semester_ingress');
            $table->date('birth_date')->nullable();
            $table->string('type_ingress')->nullable();
            $table->string('country')->nullable();
            $table->string('municipality_sisu')->nullable();
            $table->string('municipality')->nullable();
            $table->string('changed_course')->nullable();
            $table->string('changed_course_campus')->nullable();
            $table->smallInteger('entries_other_course')->nullable();
            $table->smallInteger('entries_course')->nullable();
            $table->string('state')->nullable();
            $table->string('state_sisu')->nullable();
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('course');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }

/*$table->bigInteger('codigo')->nullable();
$table->string('nome')->nullable();
$table->string('email')->nullable();
$table->string('genero')->nullable();
$table->smallInteger('idade_ingresso')->nullable();
$table->double('enem_humanas', 8, 2)->nullable();
$table->double('enem_linguagem', 8, 2)->nullable();
$table->double('enem_matematica', 8, 2)->nullable();
$table->double('enem_natureza', 8, 2)->nullable();
$table->double('enem_redacao', 8, 2)->nullable();
$table->double('nota_final_sisu', 8, 2)->nullable();
$table->string('quota')->nullable();
$table->smallInteger('year_ingress')->nullable();
$table->smallInteger('semester_ingress')->nullable();
$table->date('data_nascimento')->nullable();
$table->string('forma_ingresso')->nullable();
$table->string('pais_nascimento')->nullable();
$table->string('municipio_sisu')->nullable();
$table->string('municipio')->nullable();
$table->string('mudou_curso_mesmo_campus')->nullable();
$table->string('mudou_curso_outro_campus')->nullable();
$table->smallInteger('entradas_outro_curso')->nullable();
$table->smallInteger('entradas_curso')->nullable();
$table->string('uf')->nullable();
$table->string('uf_sisu')->nullable();*/
}
