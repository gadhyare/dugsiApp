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
        Schema::create('employees_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employees_info_id');
            $table->foreign('employees_info_id')->references('id')->on('employees_info')->cascadeOnDelete()->cascadeOnDelete();

            $table->unsignedBigInteger('emsections_id');
            $table->foreign('emsections_id')->references('id')->on('emsections')->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger('emplooyes_levels_id');
            $table->foreign('emplooyes_levels_id')->references('id')->on('emplooyes_levels')->cascadeOnDelete()->cascadeOnDelete();

            $table->integer( 'salary' )->default(0);

            $table->date( 'start_date' )->defaultDateTime();
            $table->date( 'end_date' )->defaultDateTime();

            $table->text( 'note' )->defaultDateTime();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees_jobs');
    }
};
