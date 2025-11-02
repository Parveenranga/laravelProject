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
       Schema::create('education', function (Blueprint $table) {
        $table->id();
        $table->foreignId('candidate_id')->constrained('candidates')->onDelete('cascade');
        $table->string('type');
        $table->string('certificate')->nullable();
        $table->timestamps();
});

    }
    public function candidate()
        {
            return $this->belongsTo(Candidate::class);
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
