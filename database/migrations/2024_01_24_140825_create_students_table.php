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
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('academicId')->references('id')->on('academic_years')->restrictOnDelete();
            $table->string('firstName');
            $table->string('middleName');
            $table->string('lastName');
            $table->string('suffix')->nullable();
            $table->enum('gender', ['M', 'F']);
            $table->date('birthDate');
            $table->text('address')->nullable();
            $table->string('emailAddress')->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('contactNo')->nullable();
            $table->text('lastSchoolAttended')->nullable();
            $table->enum('status', ['New', 'Transferee', 'Returnee', 'Shiftee']);
            $table->foreignId('course1');
            $table->foreignId('course2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
