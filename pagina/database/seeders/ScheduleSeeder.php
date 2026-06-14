<?php

namespace Database\Seeders;

use App\Models\ScheduleSlot;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $slots = [
            // DÍA 1 — Jueves 23 Jul
            ['day_label' => 'Jueves 23 Jul', 'day_key' => 'd1', 'day_tag' => 'Simposio Día 1', 'time_start' => '08:00', 'time_end' => '09:00', 'title' => 'Acreditación y registro', 'description' => 'Entrega de materiales y credenciales a los participantes.', 'is_break' => false, 'sort_order' => 1],
            ['day_label' => 'Jueves 23 Jul', 'day_key' => 'd1', 'day_tag' => 'Simposio Día 1', 'time_start' => '09:00', 'time_end' => '09:30', 'title' => 'Ceremonia de inauguración', 'description' => 'Apertura oficial del 1er Simposio Internacional de Enfermedad Cerebrovascular en la Altura.', 'is_break' => false, 'sort_order' => 2],
            ['day_label' => 'Jueves 23 Jul', 'day_key' => 'd1', 'day_tag' => 'Simposio Día 1', 'time_start' => '09:30', 'time_end' => '12:30', 'title' => 'Módulo I: Enfermedad Cerebrovascular', 'description' => 'Epidemiología, fisiopatología y presentación clínica del ictus en altura. Ponentes nacionales e internacionales.', 'is_break' => false, 'sort_order' => 3],
            ['day_label' => 'Jueves 23 Jul', 'day_key' => 'd1', 'day_tag' => 'Simposio Día 1', 'time_start' => '12:30', 'time_end' => '14:00', 'title' => 'Almuerzo', 'description' => null, 'is_break' => true, 'sort_order' => 4],
            ['day_label' => 'Jueves 23 Jul', 'day_key' => 'd1', 'day_tag' => 'Simposio Día 1', 'time_start' => '14:00', 'time_end' => '17:30', 'title' => 'Módulo II: Código Ictus', 'description' => 'Protocolos de atención, trombólisis y manejo en urgencias. Casos clínicos interactivos.', 'is_break' => false, 'sort_order' => 5],

            // DÍA 2 — Viernes 24 Jul
            ['day_label' => 'Viernes 24 Jul', 'day_key' => 'd2', 'day_tag' => 'Simposio + Taller', 'time_start' => '08:30', 'time_end' => '12:30', 'title' => 'Módulo III: Prevención Cerebrovascular', 'description' => 'Factores de riesgo, prevención primaria y secundaria. Rehabilitación y continuidad de cuidados.', 'is_break' => false, 'sort_order' => 1],
            ['day_label' => 'Viernes 24 Jul', 'day_key' => 'd2', 'day_tag' => 'Simposio + Taller', 'time_start' => '09:00', 'time_end' => '17:00', 'title' => 'Seminario-Taller: Código Ictus Hospitalario', 'description' => 'Actividad práctica intensiva en Auditorio Hospital. Cupos limitados. Incluye simulación y práctica clínica.', 'is_break' => false, 'sort_order' => 2],
            ['day_label' => 'Viernes 24 Jul', 'day_key' => 'd2', 'day_tag' => 'Simposio + Taller', 'time_start' => '12:30', 'time_end' => '14:00', 'title' => 'Almuerzo', 'description' => null, 'is_break' => true, 'sort_order' => 3],
            ['day_label' => 'Viernes 24 Jul', 'day_key' => 'd2', 'day_tag' => 'Simposio + Taller', 'time_start' => '14:00', 'time_end' => '17:30', 'title' => 'Módulo IV: Urgencias Neurológicas', 'description' => 'Manejo del estado epiléptico, hipertensión intracraneal y otras urgencias frecuentes.', 'is_break' => false, 'sort_order' => 4],

            // DÍA 3 — Sábado 25 Jul
            ['day_label' => 'Sábado 25 Jul', 'day_key' => 'd3', 'day_tag' => 'Simposio Día 3', 'time_start' => '09:00', 'time_end' => '12:00', 'title' => 'Socialización: Ictus en la comunidad', 'description' => 'Educación a la comunidad, reconocimiento de síntomas y activación de cadena de supervivencia.', 'is_break' => false, 'sort_order' => 1],
            ['day_label' => 'Sábado 25 Jul', 'day_key' => 'd3', 'day_tag' => 'Simposio Día 3', 'time_start' => '09:00', 'time_end' => '11:30', 'title' => 'Ponentes internacionales', 'description' => 'Conferencias magistrales de expertos internacionales en enfermedad cerebrovascular.', 'is_break' => false, 'sort_order' => 2],
            ['day_label' => 'Sábado 25 Jul', 'day_key' => 'd3', 'day_tag' => 'Simposio Día 3', 'time_start' => '12:00', 'time_end' => '14:00', 'title' => 'Almuerzo', 'description' => null, 'is_break' => true, 'sort_order' => 3],
            ['day_label' => 'Sábado 25 Jul', 'day_key' => 'd3', 'day_tag' => 'Simposio Día 3', 'time_start' => '14:00', 'time_end' => '16:30', 'title' => 'Mesa Redonda: Neurología en Bolivia', 'description' => 'Debate multidisciplinario sobre desafíos y oportunidades de la neurología en contextos de altura y recursos limitados.', 'is_break' => false, 'sort_order' => 4],
            ['day_label' => 'Sábado 25 Jul', 'day_key' => 'd3', 'day_tag' => 'Simposio Día 3', 'time_start' => '16:30', 'time_end' => '17:30', 'title' => 'Entrega de certificados y clausura', 'description' => 'Ceremonia de clausura y entrega oficial de certificados de participación.', 'is_break' => false, 'sort_order' => 5],
        ];

        foreach ($slots as $slot) {
            ScheduleSlot::create($slot);
        }
    }
}
