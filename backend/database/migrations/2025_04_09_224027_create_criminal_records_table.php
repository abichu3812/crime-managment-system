<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('criminal_records', function (Blueprint $table) {
            $table->id();    
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('lname')->nullable();
            $table->string('nickname')->nullable();
            $table->string('gender')->nullable();      
            $table->string('photo')->nullable();
            $table->string('nationality')->nullable();
            $table->string('idnumber')->nullable();
            $table->string('address')->nullable();
            $table->string('recordnumber')->nullable();
            $table->string('typeofcrime')->nullable();   
            $table->string('arrestdate')->nullable();
            $table->string('releasedate')->nullable();
            $table->string('familyname')->nullable();
            $table->string('relationship')->nullable();
            $table->string('contactinfo')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criminal_records');
    }
};
