<?php

namespace App\Http\Controllers;

use App\Models\ScheduleSlot;
use App\Models\SymposiumResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PortalController extends Controller
{
    /** SPA container for all /portal/* routes */
    public function spa()
    {
        return view('portal.app');
    }

    // ─── JSON API ────────────────────────────────────────────────────────────

    public function apiMe()
    {
        $user = auth()->user()->load('registro');
        return response()->json([
            'id'       => $user->id,
            'name'     => $user->name,
            'nickname' => $user->nickname,
            'email'    => $user->email,
            'is_admin' => $user->hasRole('admin'),
            'registro' => $user->registro,
        ]);
    }

    public function apiCronograma()
    {
        $slots = ScheduleSlot::orderBy('day_key')->orderBy('sort_order')->get();

        $grouped = $slots->groupBy('day_key')->map(function ($items) {
            return $items->map(function ($s) {
                return [
                    'id'          => $s->id,
                    'title'       => $s->title,
                    'description' => $s->description,
                    'time_start'  => $s->time_start,
                    'time_end'    => $s->time_end,
                    'is_break'    => (bool) $s->is_break,
                    'day_label'   => $s->day_label,
                    'day_tag'     => $s->day_tag,
                ];
            })->values();
        });

        return response()->json($grouped);
    }

    public function apiRecursos()
    {
        $recursos = SymposiumResource::where('is_public', true)
            ->orderBy('sort_order')
            ->get(['id', 'title', 'description', 'type', 'url', 'file_path']);

        return response()->json($recursos);
    }

    public function apiUpdateMisDatos(Request $request)
    {
        $data = $request->validate([
            'phone'     => 'nullable|string|max:20',
            'email'     => 'nullable|email|max:150',
            'provincia' => 'nullable|string|max:100',
            'direccion' => 'nullable|string|max:200',
        ]);

        $registro = auth()->user()->registro;
        if ($registro) {
            $registro->update($data);
        }

        return response()->json(['ok' => true, 'message' => 'Datos actualizados correctamente.']);
    }

    public function apiUpdatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'La contraseña actual no es correcta.',
                'errors'  => ['current_password' => ['La contraseña actual no es correcta.']],
            ], 422);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return response()->json(['ok' => true, 'message' => 'Contraseña actualizada correctamente.']);
    }
}
