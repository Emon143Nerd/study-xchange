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
        Schema::create('user_certifications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('certification_name');
            $table->string('issuing_organization');
            $table->date('issue_date');
            $table->date('expiration_date')->nullable();
            $table->text('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_certifications');
    }
};
