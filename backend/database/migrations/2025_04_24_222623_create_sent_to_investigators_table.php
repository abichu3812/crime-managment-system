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
        Schema::create('sent_to_investigators', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('last_known_location')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sent_to_investigators');
    }
};
