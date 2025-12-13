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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Blog title
            $table->text('content'); // Main blog content
            $table->string('author')->nullable(); // Author name
            $table->string('image')->nullable(); // Optional featured image
            $table->enum('status', ['draft', 'published'])->default('draft'); // Blog status
            $table->string('tags')->nullable(); // Comma-separated hashtags
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
