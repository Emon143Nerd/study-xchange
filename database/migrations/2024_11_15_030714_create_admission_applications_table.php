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
        Schema::create('admission_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('university_id');
            $table->integer('admission_circular_id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->date('dob');
            $table->string('nationality');
            $table->string('prev_education');
            $table->double('gpa');
            $table->string('test_scores')->nullable();
            $table->integer('subject_category_id');
            $table->date('start_date');
            $table->text('transcript')->nullable();
            $table->text('resume')->nullable();
            $table->text('recommendation_letter')->nullable();
            $table->tinyInteger('acceptance')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_applications');
    }
};
