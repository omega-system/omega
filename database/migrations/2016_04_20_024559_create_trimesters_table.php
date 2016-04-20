<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrimestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trimesters', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('year')->unsigned();
            $table->integer('sequence')->unsigned();
            $table->string('trimester_name');
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
        Schema::drop('trimesters');
    }
}
