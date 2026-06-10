<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class ProgramaController extends Controller{
    public function programa(){
        $fechas = Video::select('date')
            ->orderBy('date')
            ->orderBy('id')
            ->groupBy('date')
            ->get();
        $response = [];
        foreach ($fechas as $index=>$fecha) {
            $fecha->videos = Video::where('date', $fecha->date)
                ->orderBy('date', 'desc')
                ->orderBy('id')
                ->get();
            $response[$index] = $fecha;
        }

        return $response;
    }
}
