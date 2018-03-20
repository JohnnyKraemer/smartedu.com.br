<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentProbabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('student_probability', function (Blueprint $table) {
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('student');
            $table->integer('probability_id')->unsigned();
            $table->foreign('probability_id')->references('id')->on('probability');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_probability');
    }
}
