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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('certificate');
            $table->string('thumbnail')->nullable();
            $table->enum('type', ['FREE', 'PREMIUM']);
            $table->enum('status', ['Draft', 'Published']);
            $table->integer('price')->default(0);
            $table->enum('level', ['All-Level', 'Beginner', 'Intermediate', 'Advance']);
            $table->longText('description')->nullable();
            $table->foreignId('mentor_id')->constrained('mentors')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
