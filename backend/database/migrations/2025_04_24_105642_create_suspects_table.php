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
        Schema::create('suspects', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('age')->nullable();
            $table->string('gender')->default('male');
            $table->text('description');
            $table->string('address')->nullable();
             $table->string('video_path')->nullable();
            $table->string('audio_path')->nullable();
            $table->string('last_known_location');
            $table->string('status')->default('wanted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suspects');
    }
};
