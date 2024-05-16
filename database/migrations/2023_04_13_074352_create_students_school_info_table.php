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
        Schema::create('students_school_info', function (Blueprint $table) {
            $table->id();

            // Students id
            $table->unsignedBigInteger('students_info_id');
            $table->foreign('students_info_id')->references('id')->on('students_info')->cascadeOnDelete()->cascadeOnDelete();

            // programs  id
            $table->unsignedBigInteger('programs_id');
            $table->foreign('programs_id')->references('id')->on('programs')->cascadeOnDelete()->cascadeOnDelete();
 

            $table->date('registered_date');
            $table->integer('discount')->default(0);
            $table->string('active')->default('1');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_school_info');
    }
};
