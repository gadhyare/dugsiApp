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
        if (!Schema::hasTable('invoices')) {
            Schema::create('invoices', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('billing_cycles_id');
                $table->foreign('billing_cycles_id')->references('id')->on('billing_cycles')->cascadeOnDelete()->cascadeOnDelete();
                // Students id
                $table->unsignedBigInteger('students_info_id');
                $table->foreign('students_info_id')->references('id')->on('students_info')->cascadeOnDelete()->cascadeOnDelete();

                // programs  id
                $table->unsignedBigInteger('programs_id');
                $table->foreign('programs_id')->references('id')->on('programs')->cascadeOnDelete()->cascadeOnDelete();


                $table->unsignedBigInteger('feestypes_id'); 
                $table->foreign('feestypes_id')->references('id')->on('feestypes')->cascadeOnDelete()->cascadeOnDelete();
                $table->integer('want')->default(0)->nullable();
                $table->integer('discount')->default(0)->nullable();
                $table->integer('account_statuse')->default(0)->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
