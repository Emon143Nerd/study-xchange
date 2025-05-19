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
        Schema::create('assessment_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('assessment_result_id'); // Reference to the assessment result
            $table->integer('question_id'); // The question ID (could be a quiz question or descriptive question)
            $table->text('answer'); // The user's answer to the question
            $table->tinyInteger('is_correct')->default(1); // 1 = correct; 0 = incorrect ; 2 = Pending
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_answers');
    }
};
