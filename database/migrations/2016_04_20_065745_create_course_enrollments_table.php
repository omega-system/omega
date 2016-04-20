<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('course_class_id')->unsigned();
            $table->foreign('course_class_id')->references('id')->on('course_classes')->onDelete('cascade');
            $table->integer('score')->unsigned();
            $table->unique(['user_id', 'course_class_id']);
            $table->timestamps();

            $table->primary(['user_id', 'course_class_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('course_enrollments');
    }
}
