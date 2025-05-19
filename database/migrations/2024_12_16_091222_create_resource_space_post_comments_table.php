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
        Schema::create('resource_space_post_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('resource_space_post_id');
            $table->text('comment');
            $table->integer('parent_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_space_post_comments');
    }
};
