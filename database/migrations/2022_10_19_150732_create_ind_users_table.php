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
        Schema::create('ind_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('dob')->nullable();
            $table->string('bloodtype')->nullable();
            $table->string('edu')->nullable();
            $table->string('spec')->nullable();
            $table->string('attr')->nullable();
            $table->string('lvl')->nullable();
            $table->string('prof')->nullable();
            $table->string('gen')->nullable();
            $table->string('vat')->nullable();
            $table->string('idno')->nullable();
            $table->string('passport')->nullable();
            $table->string('address')->nullable();
            $table->string('postal')->nullable();
            $table->string('contact')->nullable();
            $table->string('tele')->nullable();
            $table->string('email')->nullable();
            $table->string('active')->default(1);
            $table->string('password')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ind_users');
    }
};
