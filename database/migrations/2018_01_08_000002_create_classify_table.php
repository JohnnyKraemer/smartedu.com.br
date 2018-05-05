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
            //$table->smallInteger('period')->nullable()->default(0);
            $table->integer('period_calculation')->unsigned();
            $table->integer('classifier_id')->unsigned();
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
