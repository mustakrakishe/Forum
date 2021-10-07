<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    public function up(){
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'login');
        });
    }
    
    public function down(){
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('login', 'name');
        });
    }
}
