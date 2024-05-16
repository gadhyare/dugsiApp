->cascadeOnDelete()->cascadeOnDelete();<?php

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
                                                if (!Schema::hasTable('fee_trans')) {
                                                    Schema::create('fee_trans', function (Blueprint $table) {
                                                        $table->id();
                                                        $table->unsignedBigInteger('invoices_id');
                                                        $table->foreign('invoices_id')->references('id')->on('invoices')->cascadeOnDelete()->cascadeOnDelete();
                                                        $table->date('paid_date')->nullable();
                                                        $table->integer('descount');
                                                        $table->integer('amount');
                                                        $table->string('transaction_id')->nullable();
                                                        $table->string('note')->nullable();
                                                        $table->unsignedBigInteger('banks_id');
                                                        $table->foreign('banks_id')->references('id')->on('banks')->cascadeOnDelete()->cascadeOnDelete();
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
                                                Schema::dropIfExists('fee_trans');
                                            }
                                        };
