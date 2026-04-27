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
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('complainant',200);
            $table->string('phone',100);
            $table->enum('status',['Abierta','En proceso','Archivada','Resulta','Rechazada']);
            $table->date('date');
            $table->text('description');
            $table->unsignedBigInteger('affiliate_id');
            $table->timestamps();
            $table->foreign('affiliate_id')->references('id')->on('affiliates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demands');
    }
};
