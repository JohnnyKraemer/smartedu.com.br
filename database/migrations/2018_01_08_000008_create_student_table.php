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
            $table->bigInteger('codigo')->nullable();
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
            $table->string('cota')->nullable();
            $table->smallInteger('ano_ingresso')->nullable();
            $table->smallInteger('semestre_ingresso')->nullable();
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
            $table->string('uf_sisu')->nullable();

            $table->integer('course_id')->unsigned()->nullable();
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
}
