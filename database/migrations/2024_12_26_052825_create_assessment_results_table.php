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
        Schema::create('assessment_results', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'); // User who took the assessment
            $table->integer('assessment_id'); // Unified column for either quiz or descriptive ID; it is similar to descriptive id or quizzes id
            $table->integer('question_type'); // 1 = quiz; 2 = descriptive
            $table->string('skill_name'); // The skill name (or course title)
            $table->integer('score')->nullable(); // The score the user achieved
            $table->integer('correct_answers')->nullable(); // Number of correct answers
            $table->integer('wrong_answers')->nullable(); // Number of wrong answers
            $table->timestamp('start_time')->nullable(); // Time when the assessment starts
            $table->timestamp('end_time')->nullable(); // Time when the assessment ends
            $table->integer('completed_time')->nullable(); // Time in seconds
            $table->float('accuracy', 5, 2)->nullable(); // Accuracy percentage (e.g., 85.00 for 85%)
            $table->text('feedback')->nullable(); // Feedback by the paper checker
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_results');
    }
};
