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
        Schema::create('students_helth_record', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('students_info_id');
            $table->foreign('students_info_id')->references('id')->on('students_info')->cascadeOnDelete()->cascadeOnDelete();
            $table->string('disease');
            $table->date('date_of_injury');
            $table->string('hereditary')->default('no');
            $table->string('case_now');
            $table->text('h_comments');
            $table->date('register_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_helth_record');
    }
};
