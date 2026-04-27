<?php

namespace Database\Seeders;

use App\Models\BoardMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DirectorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BoardMember::create([
            'is_directory'=>1,
            'level'=>1,
            'name'=>'Presidente',
        ]); 
        BoardMember::create([
            'is_directory'=>1,
            'level'=>2,
            'name'=>'Primer Vicepresidente',
        ]); 
        BoardMember::create([
            'is_directory'=>1,
            'level'=>3,
            'name'=>'Segundo Vicepresidente',
        ]); 
        BoardMember::create([
            'is_directory'=>1,
            'level'=>4,
            'name'=>'Vocal de Finanzas',
        ]); 
        BoardMember::create([
            'is_directory'=>1,
            'level'=>5,
            'name'=>'Vocal de Defensa Profesional',
        ]); 
        BoardMember::create([
            'is_directory'=>1,
            'level'=>6,
            'name'=>'Vocal de Cultura y Biblioteca',
        ]); 
        BoardMember::create([
            'is_directory'=>1,
            'level'=>7,
            'name'=>'Vocal de Regimen Interno',
        ]); 
        BoardMember::create([
            'is_directory'=>1,
            'level'=>8,
            'name'=>'Vocal de Vinculacion de Bienestar Social',
        ]); 
        BoardMember::create([
            'is_directory'=>1,
            'level'=>9,
            'name'=>'Vocal de Deportes',
        ]); 
        BoardMember::create([
            'level'=>1,
            'is_directory'=>0,
            'name'=>'Presidente',
        ]); 
        BoardMember::create([
            'level'=>2,
            'is_directory'=>0,
            'name'=>'Vocal Titular' ,
        ]); 
        BoardMember::create([
            'level'=>3,
            'is_directory'=>0,
            'name'=>'Vocal Titular' ,
        ]); 
        BoardMember::create([
            'level'=>4,
            'is_directory'=>0,
            'name'=>'Secretario de Cámara',
        ]); 
        BoardMember::create([
            'level'=>5,
            'is_directory'=>0,
            'name'=>'Vocal Suplente',
        ]); 
        BoardMember::create([
            'level'=>6,
            'is_directory'=>0,
            'name'=>'Vocal Suplente',
        ]); 
        BoardMember::create([
            'level'=>7,
            'is_directory'=>0,
            'name'=>'Vocal Suplente',
        ]); 

    }
}
