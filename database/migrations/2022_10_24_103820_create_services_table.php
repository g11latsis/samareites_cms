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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('regno');
            $table->string('date');
            $table->string('type');
            $table->string('detail')->nullable();
            $table->string('veh')->nullable();
            $table->string('vehtype')->nullable();
            $table->string('driver')->nullable();
            $table->string('desc')->nullable();
            $table->string('locus')->nullable();
            $table->string('strthrs')->nullable();
            $table->string('endhrs')->nullable();
            $table->string('ttlhrs')->nullable();
            $table->string('parts')->nullable();
            $table->string('parthrs')->nullable();
            $table->string('region')->nullable();
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
        Schema::dropIfExists('services');
    }
};
