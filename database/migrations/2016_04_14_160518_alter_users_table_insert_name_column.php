<?php

use Illuminate\Database\Migrations\Migration;

class AlterUsersTableInsertNameColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('number', 8)->change();
            $table->string('name')->after('number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->string('number')->change();
            $table->dropColumn('name');
        });
    }
}
