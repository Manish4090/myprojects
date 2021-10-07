<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('emp_id')->nullable()->after('password');
            $table->string('status')->nullable()->after('emp_id');
            $table->string('gender')->nullable()->after('status');
            $table->string('dob')->nullable()->after('gender');
            $table->string('doj')->nullable()->after('dob');
            $table->string('profile_image')->nullable()->after('doj');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
        });
    }
}
