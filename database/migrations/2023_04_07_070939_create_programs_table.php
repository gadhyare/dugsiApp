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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            // levels id
            $table->unsignedBigInteger('levels_id');
            $table->foreign('levels_id')->references('id')->on('levels')->cascadeOnDelete()->cascadeOnDelete();

            // Classes id
            $table->unsignedBigInteger('classes_id');
            $table->foreign('classes_id')->references('id')->on('classes')->cascadeOnDelete()->cascadeOnDelete();

            // Groups id
            $table->unsignedBigInteger('groups_id');
            $table->foreign('groups_id')->references('id')->on('groups')->cascadeOnDelete()->cascadeOnDelete();

            // Shifts id
            $table->unsignedBigInteger('shifts_id');
            $table->foreign('shifts_id')->references('id')->on('shifts')->cascadeOnDelete()->cascadeOnDelete();

            // Sections id
            $table->unsignedBigInteger('sections_id');
            $table->foreign('sections_id')->references('id')->on('sections')->cascadeOnDelete()->cascadeOnDelete();
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
