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
        Schema::create('job_circulars', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('title');
            $table->text('description'); // Job description
            $table->text('requirement'); // Job requirement
            $table->text('responsibilities'); // Job responsibilities
            $table->string('type'); // Job type (Full-time, Part-time, Remote, Internship etc.)
            $table->string('location'); // Job location
            $table->string('salary_range'); // Salary range
            $table->dateTime('application_deadline'); // Application deadline
            $table->text('image')->nullable(); // Job status (Active/Closed)
            $table->tinyInteger('status')->default(1); // Job status (Active/Closed)
            $table->integer('hit_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_circulars');
    }
};
