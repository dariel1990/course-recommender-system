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
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();
            $table->string('referenceCode')->unique();
            $table->foreignId('academicId')->references('id')->on('academic_years')->restrictOnDelete();
            $table->foreignId('studentId')->references('id')->on('students')->restrictOnDelete();
            $table->datetime('schedule')->nullable();
            $table->boolean('hasCompleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};
