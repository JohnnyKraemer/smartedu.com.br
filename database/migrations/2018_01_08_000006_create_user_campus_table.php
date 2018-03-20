<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateUserCampusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('user_campus', function (Blueprint $table) {
        $table->integer('user_id')->unsigned();
        $table->foreign('user_id')->references('id')->on('user');
        $table->integer('campus_id')->unsigned();
        $table->foreign('campus_id')->references('id')->on('campus');
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
        Schema::dropIfExists('user_campus');
    }
}
