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
        Schema::create('employee_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employees_info_id');
            $table->foreign('employees_info_id')->references('id')->on('employees_info')->cascadeOnDelete()->cascadeOnDelete();
            $table->string('title');
            $table->string('description');
            $table->string('file_name');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_attachments');
    }
};
