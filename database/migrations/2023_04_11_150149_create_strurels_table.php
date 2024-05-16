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
        Schema::create('strurels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('students_info_id');
            $table->foreign('students_info_id')->references('id')->on('students_info')->cascadeOnDelete()->cascadeOnDelete();
            $table->string('name');
            $table->string('rel_type');
            $table->string('rel_lev');
            $table->string('address');
            $table->string('email');
            $table->string('phones');
            $table->string('is_subscribe');
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
        Schema::dropIfExists('strurels');
    }
};
