<?php

namespace Database\Seeders;

use App\Models\PriceTier;
use Illuminate\Database\Seeder;

class PriceTierSeeder extends Seeder
{
    public function run(): void
    {
        $tiers = [
            // Simposio
            ['event' => 'simposio', 'category' => 'Especialistas', 'price' => 350.00, 'note' => null, 'sort_order' => 1],
            ['event' => 'simposio', 'category' => 'Médicos Generales', 'price' => 200.00, 'note' => null, 'sort_order' => 2],
            ['event' => 'simposio', 'category' => 'Lic. Enfermería / Residentes', 'price' => 150.00, 'note' => null, 'sort_order' => 3],
            ['event' => 'simposio', 'category' => 'Aux. Enf. / Lic. Fisioterapia', 'price' => 100.00, 'note' => null, 'sort_order' => 4],
            ['event' => 'simposio', 'category' => 'Estudiantes', 'price' => 100.00, 'note' => 'Con carnet universitario vigente', 'sort_order' => 5],

            // Taller
            ['event' => 'taller', 'category' => 'Especialistas', 'price' => 300.00, 'note' => null, 'sort_order' => 1],
            ['event' => 'taller', 'category' => 'Médicos Generales', 'price' => 200.00, 'note' => null, 'sort_order' => 2],
            ['event' => 'taller', 'category' => 'Lic. Enfermería', 'price' => 200.00, 'note' => null, 'sort_order' => 3],
            ['event' => 'taller', 'category' => 'Residentes / Aux. / Fisioterapia', 'price' => 150.00, 'note' => null, 'sort_order' => 4],
            ['event' => 'taller', 'category' => 'Estudiantes', 'price' => 100.00, 'note' => 'Con carnet universitario vigente', 'sort_order' => 5],
        ];

        foreach ($tiers as $tier) {
            PriceTier::create($tier);
        }
    }
}
