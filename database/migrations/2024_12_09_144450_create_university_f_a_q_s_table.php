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
        Schema::create('university_f_a_q_s', function (Blueprint $table) {
            $table->id();
            $table->integer('university_id');
            $table->integer('subject_category_id');
            $table->string('question');
            $table->text('answer');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_f_a_q_s');
    }
};
