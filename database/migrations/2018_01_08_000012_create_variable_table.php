<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variable', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('name_database')->nullable();
            $table->string('table')->nullable();
            $table->string('description')->nullable();
            $table->smallInteger('use_classify')->default(0);
            $table->smallInteger('discretize')->default(0);
            $table->smallInteger('nominal')->default(0);

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
        Schema::dropIfExists('variable');
    }
}
