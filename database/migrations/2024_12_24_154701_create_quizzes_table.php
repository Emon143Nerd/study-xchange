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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->integer('university_id');
            $table->integer('course_id');
            $table->string('title');
            $table->tinyInteger('question_type')->default(1); // 1 = Quizzes, 2 = Descriptive Questions
            $table->tinyInteger('difficulty_level')->default(1); // 1 = Beginner, 2 = Intermediate, 3 = Advanced
            $table->integer('duration')->nullable(); // In minutes
            $table->tinyInteger('status')->default(1); // 1 = Published, 2 = Unpublished
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
