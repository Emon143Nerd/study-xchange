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
        Schema::create('user_job_preferences', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('preferred_location');
            $table->string('preferred_industry');
            $table->string('preferred_job_type'); // Job type (Full-time, Part-time, Remote, Internship etc.)
            $table->integer('salary_expectation');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_job_preferences');
    }
};
