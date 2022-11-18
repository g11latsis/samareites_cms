<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ind_users', function (Blueprint $table) {
            $table->string('dor')->after('dob')->nullable();
            $table->string('doo')->after('dor')->nullable();
            $table->string('school')->after('edu')->nullable();
            $table->string('register')->after('vat')->nullable();
            $table->string('city')->after('address')->nullable();
            $table->string('regno')->after('passport')->nullable();
            $table->string('languages')->after('img')->nullable();
            $table->string('hours')->after('languages')->nullable();
            $table->string('awards')->after('hours')->nullable();
            $table->string('penalties')->after('awards')->nullable();
            $table->string('cv')->after('penalties')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ind_users', function (Blueprint $table) {
            //
        });
    }
};
