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

        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            // students id
            $table->unsignedBigInteger('students_info_id');
            $table->foreign('students_info_id')->references('id')->on('students_info')->cascadeOnDelete()->cascadeOnDelete();

            // programs  id
            $table->unsignedBigInteger('programs_id');
            $table->foreign('programs_id')->references('id')->on('programs')->cascadeOnDelete()->cascadeOnDelete();

            // subjects_distributions id
            $table->unsignedBigInteger('subjects_distributions_id');
            $table->foreign('subjects_distributions_id')->references('id')->on('subjects_distributions')->cascadeOnDelete()->cascadeOnDelete();
 

            $table->integer('qu1')->default(0)->nullable();
            $table->integer('ex1')->default(0)->nullable();
            $table->integer('qu2')->default(0)->nullable();
            $table->integer('ex2')->default(0)->nullable();
            $table->integer('att')->default(0)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
