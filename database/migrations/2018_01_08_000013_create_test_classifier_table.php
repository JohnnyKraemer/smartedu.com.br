<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestClassifierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_classifier', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('period_calculation')->unsigned()->nullable();

            $table->smallInteger('period')->nullable()->default(0);

            $table->smallInteger('success')->nullable()->default(0);
            $table->smallInteger('failure')->nullable()->default(0);
            $table->smallInteger('success_evaded')->nullable()->default(0);
            $table->smallInteger('success_not_evaded')->nullable()->default(0);
            $table->smallInteger('failure_evaded')->nullable()->default(0);
            $table->smallInteger('failure_not_evaded')->nullable()->default(0);

            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->integer('time_seconds')->unsigned()->nullable();
            $table->smallInteger('type')->nullable();
            $table->smallInteger('result')->nullable()->default(0);

            $table->integer('classifier_id')->unsigned()->nullable();
            $table->foreign('classifier_id')->references('id')->on('classifier');

            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')->on('course');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_classifier');
    }
}
