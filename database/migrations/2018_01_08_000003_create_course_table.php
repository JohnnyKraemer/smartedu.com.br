<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->string('nivel_ensino')->nullable();
            $table->string('grau')->nullable();
            $table->string('periodicidade')->nullable();
            $table->string('funcionamento')->nullable();
            $table->string('turno')->nullable();
            $table->string('categoria_stricto_sensu')->nullable();
            $table->string('codigo_curso')->nullable();
            $table->string('codigo_inep_curso')->nullable();
            $table->string('regime_ensino')->nullable();
            $table->integer('total_periodos')->nullable();

            $table->smallInteger('use_classify')->default(0);

            $table->integer('campus_id')->unsigned()->nullable();
            $table->foreign('campus_id')->references('id')->on('campus');

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
        Schema::table('course', function (Blueprint $table) {
            $table->dropForeign('course_campus_id_foreign');
        });

        Schema::dropIfExists('course');
    }
}
