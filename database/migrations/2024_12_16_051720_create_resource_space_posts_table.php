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
        Schema::create('resource_space_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('resource_space_id');
            $table->integer('user_id');
            $table->string('title');
            $table->text('description');
            $table->text('image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('upvotes')->default(0);
            $table->integer('downvotes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_space_posts');
    }
};
