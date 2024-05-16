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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expenses_types_id');
            $table->foreign('expenses_types_id')->references('id')->on('expenses_types')->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger('billing_cycles_id');
            $table->foreign('billing_cycles_id')->references('id')->on('billing_cycles')->cascadeOnDelete()->cascadeOnDelete();
            $table->date('date');
            $table->integer('amount');
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
