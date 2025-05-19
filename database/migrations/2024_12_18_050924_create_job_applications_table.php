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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('job_circular_id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->json('education')->nullable(); // JSON column for education data
            $table->json('skill')->nullable(); // JSON column for education data
            $table->json('work_experience')->nullable(); // JSON column for education data
            $table->json('certifications')->nullable(); // JSON column for education data
            $table->json('job_preference')->nullable(); // JSON column for education data
            $table->string('resume')->nullable();
            $table->text('image')->nullable();
            $table->tinyInteger('status')->default(0); // 0 = unchecked ; 1 = checked
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
