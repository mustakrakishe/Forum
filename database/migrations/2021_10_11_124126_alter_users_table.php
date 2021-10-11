<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Set strings limits

        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 25)->change();
            $table->string('phone', 13)->change();
            $table->string('email', 50)->change();
            $table->string('password', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->change();
            $table->string('phone')->change();
            $table->string('email')->change();
            $table->string('password')->change();
        });
    }
}
