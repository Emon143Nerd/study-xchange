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
        Schema::create('research_project_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('research_project_id');
            $table->tinyInteger('status')->default(1); // 1 = Pending, 2 = Accepted, 3 = Rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_project_requests');
    }
};
