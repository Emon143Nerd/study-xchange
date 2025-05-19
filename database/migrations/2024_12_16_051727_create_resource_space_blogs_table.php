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
        Schema::create('resource_space_blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('resource_space_id');
            $table->integer('user_id');
            $table->string('title');
            $table->text('description');
            $table->text('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('hit_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_space_blogs');
    }
};
