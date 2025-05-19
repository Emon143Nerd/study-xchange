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
        Schema::create('question_votes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('question_id');
            $table->boolean('vote')->comment('1 for upvote, 0 for downvote');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_votes');
    }
};
