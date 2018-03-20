<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassifyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classify', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('period')->nullable()->default(0);
            $table->integer('period_calculation')->unsigned()->nullable();
            //$table->smallInteger('success')->nullable();
            //$table->smallInteger('failure')->nullable();
            //$table->smallInteger('success_evaded')->nullable();
            //$table->smallInteger('success_evaded')->nullable();
            //$table->smallInteger('failure_evaded')->nullable();
            //$table->smallInteger('failure_not_evaded')->nullable();

            $table->integer('classifier_id')->unsigned()->nullable();
            $table->foreign('classifier_id')->references('id')->on('classifier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classify');
    }
}
