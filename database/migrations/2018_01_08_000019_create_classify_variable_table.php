<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassifyVariableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classify_variable', function (Blueprint $table) {
            $table->integer('classify_id')->unsigned();
            $table->foreign('classify_id')->references('id')->on('classify');
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
        Schema::dropIfExists('classify_variable');
    }
}
