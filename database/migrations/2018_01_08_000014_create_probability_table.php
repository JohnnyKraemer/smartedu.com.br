<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProbabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('probability', function (Blueprint $table) {
            $table->increments('id');
            
            $table->double('probability_evasion', 8, 2)->nullable();
            $table->string('state')->nullable();

            $table->integer('student_id')->unsigned()->nullable();
            $table->foreign('student_id')->references('id')->on('student');

            $table->integer('test_classifier_id')->unsigned()->nullable();
            $table->foreign('test_classifier_id')->references('id')->on('test_classifier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('probability');
    }
}
