<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registro;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function stats()
    {
        return response()->json([
            'total_registros' => Registro::count(),
            'confirmados'     => Registro::where('confirmado', true)->count(),
            'por_evento'      => Registro::groupBy('cursoTaller')
                ->selectRaw('cursoTaller as label, count(*) as total')
                ->get(),
            'por_profesion'   => Registro::groupBy('profession')
                ->selectRaw('profession as label, count(*) as total')
                ->get(),
            'por_departamento'=> Registro::groupBy('departamento')
                ->selectRaw('departamento as label, count(*) as total')
                ->get(),
            'por_modalidad'   => Registro::groupBy('modalidad')
                ->selectRaw('modalidad as label, count(*) as total')
                ->get(),
            'recientes'       => Registro::latest()->take(5)->get(['firstName', 'firstSurname', 'profession', 'created_at']),
        ]);
    }
}
