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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            // Create foreign key column for Employer with cascade delete
            $table->foreignIdFor(\App\Models\Employer::class)->constrained()->onDelete('cascade');
            // Salary as a decimal type (assuming you're dealing with money)
            $table->decimal('salary');
            // Title as a string
            $table->string('title');
            // Timestamps for created_at and updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
