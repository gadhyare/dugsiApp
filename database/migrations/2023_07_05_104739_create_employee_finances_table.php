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
        Schema::create('employee_finances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employees_info_id');
            $table->foreign('employees_info_id')->references('id')->on('employees_info')->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger('allowance_types_id');
            $table->foreign('allowance_types_id')->references('id')->on('allowance_types')->cascadeOnDelete()->cascadeOnDelete();
            $table->integer('amount')->nullable();
            $table->string('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_finances');
    }
};
