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
        Schema::create('question_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('question_id');
            $table->integer('user_id');
            $table->text('answer');
            $table->integer('spam_reports')->default(0); // Count of spam reports
            $table->tinyInteger('status')->default(1); // 1 means comment is showing, o means comment is hidden
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_comments');
    }
};
