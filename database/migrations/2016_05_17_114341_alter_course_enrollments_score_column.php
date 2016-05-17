<?php

use Illuminate\Database\Migrations\Migration;

class AlterCourseEnrollmentsScoreColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_classes', function ($table) {
            $table->integer('score_a_percent')->unsigned()->after('location');
        });

        Schema::table('course_enrollments', function ($table) {
            $table->integer('score_a')->unsigned()->nullable()->after('course_class_id');
            $table->integer('score_b')->unsigned()->nullable()->after('score_a');
            $table->integer('score')->nullable()->change();
        });

        DB::unprepared('
            CREATE TRIGGER score_calculation_before_insert_into_course_enrollments
            BEFORE INSERT
                ON course_enrollments FOR EACH ROW
            BEGIN
                DECLARE p INT(11) UNSIGNED;

                SELECT score_a_percent
                    INTO p FROM course_classes
                    WHERE id = NEW.course_class_id;

                IF NEW.score_a IS NOT NULL AND NEW.score_b IS NOT NULL THEN
                    SET NEW.score = p * NEW.score_a / 100
                        + (100 - p) * NEW.score_b / 100;
                ELSE
                    SET NEW.score = NULL;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER score_calculation_before_update_course_enrollments
            BEFORE UPDATE
                ON course_enrollments FOR EACH ROW
            BEGIN
                DECLARE p INT(11) UNSIGNED;

                SELECT score_a_percent
                    INTO p FROM course_classes
                    WHERE id = NEW.course_class_id;

                IF NEW.score_a IS NOT NULL AND NEW.score_b IS NOT NULL THEN
                    SET NEW.score = p * NEW.score_a / 100
                        + (100 - p) * NEW.score_b / 100;
                ELSE
                    SET NEW.score = NULL;
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER score_calculation_before_insert_into_course_enrollments');
        DB::unprepared('DROP TRIGGER score_calculation_before_update_course_enrollments');

        Schema::table('course_enrollments', function ($table) {
            $table->dropColumn('score_a');
            $table->dropColumn('score_b');
        });

        Schema::table('course_classes', function ($table) {
            $table->dropColumn('score_a_percent');
        });
    }
}
