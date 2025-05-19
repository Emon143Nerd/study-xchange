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
        Schema::create('resource_space_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resource_space_id'); // Foreign key to resource_spaces table
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_space_users');
    }
};
