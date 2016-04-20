<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseClassTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_class_time', function (Blueprint $table) {
            $table->integer('course_class_id')->unsigned()->index();
            $table->foreign('course_class_id')->references('id')->on('course_classes')->onDelete('cascade');
            $table->integer('day')->unsigned();
            $table->integer('begin')->unsigned();
            $table->integer('end')->unsigned();
            $table->timestamps();

            $table->primary(['course_class_id', 'day', 'begin', 'end']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('course_class_time');
    }
}
