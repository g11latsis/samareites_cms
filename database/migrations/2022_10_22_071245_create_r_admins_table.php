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
        Schema::create('r_admins', function (Blueprint $table) {
            //personal info
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('dob');
            $table->string('bloodgroup');
            $table->string('donor');
            $table->string('lvl');
            $table->string('spec');
            $table->string('attr');
            $table->string('grade');
            $table->string('gen');
            $table->string('vat');
            $table->string('doy');
            $table->string('idno');
            $table->string('passport')->nullable(); //pdf
            $table->string('amka');
            $table->string('memberid');
            $table->string('status1');
            $table->string('img')->nullable(); // img file
            //address
            $table->text('address');
            $table->string('postal');
            $table->string('city');
            $table->string('active');
            //contact
            $table->string('contact');
            $table->string('tele');
            $table->string('email');
            //edu
            $table->string('edu');
            $table->string('school');
            $table->string('degrees');
            //eac training
            $table->string('eacspec')->nullable();
            $table->string('eacdegree')->nullable(); //pdf
            $table->string('eacdesctin')->nullable();
            $table->string('eacdesctinproof'); //pdf
            $table->string('onlinetrai')->nullable();
            $table->string('onlinetraicert')->nullable(); //pdf
            $table->string('othertrai')->nullable();
            $table->string('othertraicert')->nullable(); //pdf
            //total hrs of volunteering
            $table->string('vhrs')->nullable();
            $table->string('healthcarehrs')->nullable();
            $table->string('rescuehrs')->nullable();
            $table->string('nursinghrs')->nullable();
            $table->string('sshrs')->nullable();
            $table->string('traihrs')->nullable();
            //current year hrs
            $table->string('cyvolunteeringhrs')->nullable();
            $table->string('cyhealthhrs')->nullable();
            $table->string('cyrescuehrs')->nullable();
            $table->string('cynursinghrs')->nullable();
            $table->string('cysshrs')->nullable();
            $table->string('cytraininghrs')->nullable();
            $table->string('cyeduhrs')->nullable();
            //penalties
            $table->string('date')->nullable();
            $table->string('type')->nullable();
            $table->string('duration')->nullable();
            $table->string('desc')->nullable();
            $table->string('doc')->nullable(); //pdf
            //others
            $table->string('spknow')->nullable();
            $table->string('licenses')->nullable(); //pdf
            $table->string('cv')->nullable(); //pdf
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
        Schema::dropIfExists('r_admins');
    }
};
