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
        Schema::create('research_projects', function (Blueprint $table) {
            $table->id();
            $table->integer('created_by');
            $table->string('title');
            $table->string('slug');
            $table->string('department');
            $table->text('description')->nullable();
            $table->string('objective')->nullable();
            $table->date('timeline_from');
            $table->date('timeline_to');
            $table->text('attachment')->nullable();
            $table->tinyInteger('status')->default(1); // 1 = Pending, 2 = On going, 3 = Completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_projects');
    }
};
