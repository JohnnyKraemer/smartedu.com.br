<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestClassifierVariableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_classifier_variable', function (Blueprint $table) {
            $table->integer('test_classifier_id')->unsigned();
            $table->foreign('test_classifier_id')->references('id')->on('test_classifier');
            $table->integer('variable_id')->unsigned();
            $table->foreign('variable_id')->references('id')->on('variable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_classifier_variable');
    }
}
