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
        Schema::create('research_tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('research_project_id');
            $table->integer('research_team_member_id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->date('due_date');
            $table->text('attachment')->nullable();
            $table->tinyInteger('status')->default(1); // 1 = Pending, 2 = On Going, 3 = Completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_tasks');
    }
};
