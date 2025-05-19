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
        Schema::create('admission_circulars', function (Blueprint $table) {
            $table->id();
            $table->integer('university_id');
            $table->integer('subject_category_id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('total_fees');
            $table->double('min_gpa_req');
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('status')->default(1);
            $table->text('image')->nullable();
            $table->text('attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_circulars');
    }
};
