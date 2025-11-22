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
    Schema::create('send_to_investigator_leaders', function (Blueprint $table) {
        $table->id();
        
        // Basic suspect information
        $table->string('full_name');
        $table->unsignedTinyInteger('age')->nullable();
        $table->enum('gender', ['male', 'female'])->nullable();
        
        // Evidence files
        $table->string('personal_photo')->nullable()->comment('Suspect profile photo');
        $table->text('interview')->nullable()->comment('Interview notes or transcript');
        $table->text('additional_notes')->nullable()->comment('Additional investigation notes');
        
        // Digital evidence
        $table->string('dna_evidence')->nullable()->comment('DNA test results or evidence');
        $table->string('forensic_evidence')->nullable()->comment('Forensic analysis documents');
        $table->string('clinical_report')->nullable()->comment('Medical/clinical reports');
        $table->string('video_evidence')->nullable()->comment('Video recordings evidence');
        $table->string('audio_evidence')->nullable()->comment('Audio recordings evidence');
        
        // Metadata
        $table->foreignId('submitted_by')->constrained('users')->comment('Investigator who submitted');
        $table->timestamp('submitted_at')->useCurrent();
        $table->enum('status', ['pending', 'under_review', 'approved', 'rejected'])
              ->default('pending')
              ->comment('Report review status');
        
        // Timestamps
        $table->timestamps();
        $table->softDeletes()->comment('For archiving purposes');
        
        // Indexes
        $table->index('full_name');
        $table->index('status');
        $table->index('submitted_by');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('send_to_investigator_leaders');
    }
};
