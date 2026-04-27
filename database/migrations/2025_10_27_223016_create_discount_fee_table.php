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
        Schema::create('discount_fee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_id')->constrained()->onDelete('cascade');
            $table->foreignId('discount_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });





        /* CREATE TABLE payment_summaries (
        affiliate_id BIGINT PRIMARY KEY,
        total_por_pagar DECIMAL(10,2),
        aportes DECIMAL(10,2),
        aportes_cant INT,
        ultimo_pago DATE
        ); */






    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_fee');
    }
};
