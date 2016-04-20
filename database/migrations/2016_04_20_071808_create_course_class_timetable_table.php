<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseClassTimetableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_class_timetable', function (Blueprint $table) {
            $table->integer('course_class_id')->unsigned()->index();
            $table->foreign('course_class_id')->references('id')->on('course_classes')->onDelete('cascade');
            $table->integer('day')->unsigned();
            $table->integer('sequence')->unsigned();
            $table->timestamps();

            $table->primary(['course_class_id', 'day', 'sequence']);
            $table->index(['day', 'sequence']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('course_class_timetable');
    }
}
