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
        Schema::create('study_materials', function (Blueprint $table) {
        $table->id();
        $table->foreignId('study_event_id')->constrained()->onDelete('cascade');
        $table->string('path');      // file path in storage
        $table->string('original_name');
        $table->string('title')->nullable();
        $table->string('file_type')->nullable(); // pdf, doc, image, etc.
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_materials');
    }
};
