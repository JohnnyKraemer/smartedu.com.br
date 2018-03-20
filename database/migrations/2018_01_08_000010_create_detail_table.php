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
            $table->string('periodo_carga')->nullable();
            $table->smallInteger('periodo')->nullable();
            $table->smallInteger('matriz')->nullable();
            $table->smallInteger('idade_situacao')->nullable();
            $table->double('cr', 8, 2)->nullable();
            $table->smallInteger('ano_situacao')->nullable();
            $table->smallInteger('semestre_situacao')->nullable();
            $table->smallInteger('quant_semestre_cursados')->nullable();
            $table->smallInteger('disciplinas_aprovadas')->nullable();
            $table->smallInteger('disciplinas_consignadas')->nullable();
            $table->smallInteger('disciplinas_matriculadas')->nullable();
            $table->smallInteger('disciplinas_reprovadas_frequencia')->nullable();
            $table->smallInteger('disciplinas_reprovadas_nota')->nullable();
            $table->string('provavel_jubilamento')->nullable();
            $table->string('retencao_parcial')->nullable();
            $table->string('retencao_total')->nullable();

            $table->integer('situation_id')->unsigned()->nullable();
            $table->foreign('situation_id')->references('id')->on('situation');

            $table->integer('student_id')->unsigned()->nullable();
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
}
