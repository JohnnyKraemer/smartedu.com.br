<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail', function (Blueprint $table) {
            $table->increments('id');

            $table->string('loading_period')->nullable();
            $table->smallInteger('period')->nullable();
            $table->smallInteger('matrix')->nullable();
            $table->smallInteger('age_situation')->nullable();
            $table->double('coefficient', 8, 2)->nullable();
            $table->smallInteger('year_situation')->nullable();
            $table->smallInteger('semester_situation')->nullable();
            $table->smallInteger('semesters')->nullable();
            $table->smallInteger('disciplines_approved')->nullable();
            $table->smallInteger('disciplines_consigned')->nullable();
            $table->smallInteger('disciplines_matriculate')->nullable();
            $table->smallInteger('disciplines_reprovated_frequency')->nullable();
            $table->smallInteger('disciplines_reprovated_note')->nullable();
            $table->string('likely_retirement')->nullable();

            $table->integer('situation_id')->unsigned();
            $table->foreign('situation_id')->references('id')->on('situation');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('student');
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
        Schema::dropIfExists('detail');
    }

/*$table->string('periodo_carga')->nullable();
$table->smallInteger('periodo')->nullable();
$table->smallInteger('matriz')->nullable();
$table->smallInteger('idade_situacao')->nullable();
$table->double('cr', 8, 2)->nullable();
$table->smallInteger('ano_situacao')->nullable();
$table->smallInteger('semestre_situacao')->nullable();
$table->smallInteger('quant_semestre_cursados')->nullable();
$table->smallInteger('disciplines_approved')->nullable();
$table->smallInteger('disciplinas_consignadas')->nullable();
$table->smallInteger('disciplines_matriculate')->nullable();
$table->smallInteger('disciplinas_reprovadas_frequencia')->nullable();
$table->smallInteger('disciplinas_reprovadas_nota')->nullable();
$table->string('provavel_jubilamento')->nullable();
$table->string('retencao_parcial')->nullable();
$table->string('retencao_total')->nullable();*/
}
