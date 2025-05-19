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
        Schema::create('research_meeting_responses', function (Blueprint $table) {
            $table->id();
            $table->integer('meeting_id');
            $table->integer('user_id'); // Team member responding
            $table->enum('selected_time', ['time1', 'time2', 'time3'])->nullable(); // Selected time
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_meeting_responses');
    }
};
