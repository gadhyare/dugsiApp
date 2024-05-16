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
        Schema::create('subjects_distributions', function (Blueprint $table) {
            $table->id();

            // programs  id
            $table->unsignedBigInteger('programs_id');
            $table->foreign('programs_id')->references('id')->on('programs')->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger('subjects_id');
            $table->foreign('subjects_id')->references('id')->on('subjects')->cascadeOnDelete()->cascadeOnDelete();          
            $table->integer('max_mark');
            $table->integer('min_mark');
            $table->integer('rank');


            $table->string('active');
            $table->softDeletes();
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects_distributions');
    }
};
