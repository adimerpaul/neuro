<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('videos')->insert([
            [
              "subtitle"=> '14:20 INAUGURACIÓN:',
              "title"=> 'Dr. Juan Carlos Torrez',
              "avatar"=> 'https://media.licdn.com/dms/image/C4E03AQEEIofieuM97Q/profile-displayphoto-shrink_800_800/0/1657579174144?e=2147483647&v=beta&t=S4Sjm5u5BwpOjIJX5MzhJfkrrfjEY88pyVmhBFnNUrw',
              "content"=> 'Presidente  de  La  Sociedad  Boliviana  de  Neurología filial La Paz',
              "button"=> true,
                "urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ],
            [
                "subtitle"=> '14:30   TRASTORNO   DE   ANSIEDAD   GENERALIZADA   EN NEUROLOGIA (ORURO)',
              "title"=> 'Dra. Magaly Gonzales',
              "avatar"=> 'https://www.tocdoc.com/sites/default/files/doctores/doc.jpg',
              "content"=> '',
              "button"=> true,
				"urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ],
            [
                "subtitle"=> '15:00 CARDIOEMBOLISMO Y USO DE ANTICOAGULANTES (ORURO) ',
              "title"=> 'Dra. Mancilla',
              "avatar"=> '',
              "content"=> '',
              "button"=> true,
                "urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ],
            [
                "subtitle"=> '15:30     ACTUALIZACION     EN     DISLIPIDEMIAS     (ORURO)',
              "title"=> 'Dra. Jhenny Acha',
              "avatar"=> 'data:image/jpeg;base64,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',
              "content"=> '',
              "button"=> true,
                "urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ],
            [
                "subtitle"=> '16:00 ACTUALIZACION EN DIABETES MELLITUS TIPO 2 Y RIESGO METABOLICO (ORURO)',
              "title"=> 'Dra. Demelza Fuentes',
              "avatar"=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmypll-0itDRNiRiVVruwlFUeOvKpWFur4ysOsPjYXmddPOvPh-4ZSdNc5IrMJ8QE3UxQ&usqp=CAU',
              "content"=> '',
              "button"=> true,
                "urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ],
            [
                "subtitle"=> '16:30     PSICOSIS     AGUDA     (ORURO)',
              "title"=> 'Dr.David    Bustos Cisneros',
              "avatar"=> '',
              "content"=> '',
              "button"=> true,
                "urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ],
            [
                "subtitle"=> '17:30 REFRIGERIO',
              "title"=> 'REFRIGERIO ',
              "avatar"=> '',
              "content"=> '',
              "button"=> false,
                "urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ],
            [
                "subtitle"=> '18:00 MOVIMIENTOS ANORMALES EN EMERGENCIAS (LA-PAZ)',
              "title"=> 'Dr. Sergio Silva',
              "avatar"=> 'https://medicina.uc.cl/wp-content/uploads/2017/09/SERGIO-SILVA.jpg',
              "content"=> '',
              "button"=> true,
                "urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ],
            [
                "subtitle"=> '18:30 ENFERMEDAD DE PARKINSON (LA PAZ)',
              "title"=> 'Dra. Rosario Jauregui',
              "avatar"=> '',
              "content"=> '',
              "button"=> true,
                "urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ],
            [
                "subtitle"=> '19:00   NUEVOS   CONCEPTOS   Y   CLASIFICACION   DE   LA EPILEPSIA (LA PAZ) ',
              "title"=> 'Dra. Penelope Michel Herbas',
              "avatar"=> '',
              "content"=> '',
              "button"=> true,
                "urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ],
            [
                "subtitle"=> '19:30 EPILEPSIA Y TRATAMIENTO (LA PAZ)',
              "title"=> 'Dr. Federico Fortun',
              "avatar"=> '',
              "content"=> '',
              "button"=> true,
              "urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ],
            [
                "subtitle"=> '20:00    VISION    ACTUAL    DE    LA    NEUROCISTICERCOSIS (LA PAZ) ',
              "title"=> 'Dr. Denis Cruz',
              "avatar"=> '',
              "content"=> '',
              "button"=> true,
                "urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ],
            [
                "subtitle"=> '20:30 LUMBALGIA MECANICA (POTOSI) ',
              "title"=> 'Dr. Carlos Flores',
              "avatar"=> '',
              "content"=> '',
              "button"=> true,
                "urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ],
            [
                "subtitle"=> '21:00 PARALISIS FACIAL PERIFERICA (POTOSI)',
              "title"=> 'Dr. Jhonny Churata',
              "avatar"=> '',
              "content"=> '',
              "button"=> true,
              "urlZoom"=>"http://www.google.com.bo",
                "urlYoutube"=>"http://www.google.com.bo"
            ]
        ]);
    }
}
