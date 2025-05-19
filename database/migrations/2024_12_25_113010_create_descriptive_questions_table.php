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
        Schema::create('descriptive_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('descriptive_id');
            $table->string('question');
            $table->text('correct_answer')->nullable();
            $table->tinyInteger('status')->default(1); // 1 = Published, 2 = Unpublished
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descriptive_questions');
    }
};
