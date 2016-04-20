<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourseClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_classes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('trimester_id')->unsigned();
            $table->foreign('trimester_id')->references('id')->on('trimesters')->onDelete('cascade');
            $table->string('course_number', 10);
            $table->foreign('course_number')->references('course_number')->on('courses')->onDelete('cascade');
            $table->integer('class_number')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('location');
            $table->timestamps();

            $table->unique(['trimester_id', 'course_number', 'class_number']);
            $table->index(['trimester_id', 'course_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('course_classes');
    }
}
