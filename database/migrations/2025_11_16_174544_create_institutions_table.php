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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('initials', 10)->nullable();
            $table->string('logo', 65);
            $table->string('phone', 10);
            $table->string('email', 150);
            $table->string('address', 255);
            $table->enum('city', [
                'LP',
                'PT',
                'OR',
                'CB',
                'SC',
                'TJ',
                'CH',
                'BN',
                'PD'
            ]);
            $table->text('mission');
            $table->text('vision');
            $table->text('requirement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};
