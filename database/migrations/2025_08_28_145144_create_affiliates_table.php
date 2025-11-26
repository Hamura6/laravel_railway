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


        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->string('enrollment_conalab', 20);
            $table->string('enrollment_RPA', 20);
            $table->enum('sede', ['La Paz', 'Cochabamba', 'Santa Cruz', 'Oruro', 'Potosí', 'Chuquisaca', 'Tarija', 'Beni', 'Pando']);
            $table->string('profession', 50);
            $table->enum('profession_status', ['Libre', 'Funcion publica', 'Privada'])->default('Libre');
            $table->string('institution', 100)->nullable();
            $table->string('address_office', 100);
            $table->string('address_number', 20)->default('s/n');
            $table->string('zone', 100);
            $table->string('address_home', 100);
            $table->string('address_number_home', 20)->default('s/n');
            $table->string('zone_home', 100);
            $table->string('sport', 50);
            $table->string('place', 50);
            $table->enum('status', [
                'Activo',
                'Inactivo',
                'Exento',
                'Fallecido',
                'Retirada',
                'Licencia'
            ])->default('Activo');



            /* $table->string('university',100); */
            $table->date('date');
            $table->string('number', 15);
            /*             $table->string('especiality',50);
            $table->string('area',20);
            $table->date('date_es');
            $table->string('university_es',100); */



            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('university_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliates');
    }
};
