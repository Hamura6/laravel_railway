<?php

namespace Database\Seeders;

use App\Models\Institution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Institution::create([
            'name' => 'ILUSTRE COLEGIO DE ABOGADOS DE POTOSÍ',
            'initials' => 'ICAP',
            'logo' => 'logo.png',
            'phone' => '26225790',
            'email' => 'icap.potosi@gmail.com',
            'address' => 'Dirección: Calle Lanza N° 29',
            'city' => 'PT',
            'mission' => 'Ser reconocida como una institución sólida, que patrocina el manejo ético de la defensa, con la finalidad de lograr la justicia de la sociedad, fomentando la práctica de valores y comportamiento ético de nuestros abogados y abogadas.',
            'vision' => 'Ser una empresa consolidada con pleno reconocimiento en el ámbito educativo, ampliando nuestro servicio a nivel nacional e internacional mediante la innovación de nuevos programas y proyectos de capacitación continua.',
            'requirement' => 'Documentos Requeridos Memorial de solicitud dirigido al Presidente del ICALP, Dr. Franz Gonzalo Mario Soliz Medrano, solicitando tu inscripción para el Juramento de Ley. Certificación del Registro Profesional emitida por el Ministerio de Justicia, que avala tu calidad de abogado/a. Título en Provisión Nacional (Original), presentado en una funda transparente y acompañado de una fotocopia simple. Formulario de Inscripción que te proporcionaremos en nuestras oficinas. Fotocopia simple del Carnet de Identidad. Depósito de Bs. 2,700.00 al Banco Nacional de Bolivia (BNB), Cuenta Caja de Ahorro N.º 100-021-2136 a nombre del Colegio de Abogados de Potosi. Dos fotografías recientes a color, tamaño 4x4 cm, con fondo blanco.'
        ]);
    }
}
