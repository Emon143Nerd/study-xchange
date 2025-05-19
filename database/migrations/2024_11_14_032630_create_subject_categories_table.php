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
        Schema::create('subject_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('university_id');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->text('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_categories');
    }
};
