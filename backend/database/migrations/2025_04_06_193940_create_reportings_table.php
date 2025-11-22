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
        Schema::create('reporting', function (Blueprint $table) {
            $table->id();
            $table->date('incident_date');
            $table->time('incident_time')->nullable();
            $table->string('location', 255);
            $table->text('description');
            $table->string('file_path')->nullable()->comment('Stores path to uploaded evidence files');
            $table->text('suspect_Information')->nullable();
            $table->text('witness_Information')->nullable();
            $table->string('reporter_name')->nullable();
            $table->string('reporter_email')->nullable();
            $table->string('reporter_phone', 20)->nullable();
            $table->timestamps();
            
            // Indexes for common search operations
            $table->index('incident_date');
            $table->index('location');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportings');
    }
};
