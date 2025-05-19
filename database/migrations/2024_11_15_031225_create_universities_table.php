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
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->string('slug');
            $table->enum('university_type', ['public', 'private'])->nullable();
            $table->text('description');
            $table->text('image');
            $table->integer('rank');
            $table->string('tuition_fees');
            $table->text('campus_facilities');
            $table->text('scholarships');
            $table->text('placement_records');
            $table->text('residence_facilities');
            $table->text('food_facilities');
            $table->text('avg_living_cost');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
