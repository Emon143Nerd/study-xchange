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
        Schema::create('research_meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('research_project_id');
            $table->integer('created_by');
            $table->string('title');
            $table->text('meeting_link')->nullable();
            $table->dateTime('time1'); // First proposed time
            $table->dateTime('time2'); // Second proposed time
            $table->dateTime('time3'); // Third proposed time
            $table->dateTime('final_time')->nullable(); // Finalized meeting time
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_meetings');
    }
};
