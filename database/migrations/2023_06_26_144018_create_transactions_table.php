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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('tranx_ref')->unique();
            $table->unSignedBigInteger('user_id');
            $table->unSignedBigInteger('from_wallet_id');
            $table->unSignedBigInteger('to_wallet_id');
            $table->float('amount', 17,2)->default(0.00);
            $table->float('tranx_fee', 17,2)->default(0.00);
            $table->float('commission', 17,2)->default(0.00);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
