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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            
            // The path to the slider image (e.g., 'sliders/hero.png')
            $table->string('image'); 
            
            // The main heading (e.g., 'Sell your furniture easily')
            $table->string('title'); 
            
            // The sub-text or paragraph
            $table->text('description'); 
            
            // Optional: A destination URL for the "Get Started" button
            $table->string('link')->nullable(); 
            
            // Optional: Order of appearance (useful for sorting slides)
            $table->integer('order')->default(0);

            // Optional: Toggle to show/hide the slide without deleting it
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};