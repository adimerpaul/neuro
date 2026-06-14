<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstName'    => 'required|string|max:100',
            'firstSurname' => 'required|string|max:100',
            'email'        => 'required|email|max:150',
            'phone'        => 'required|string|max:20',
            'profession'   => 'required|string|max:150',
            'modalidad'    => 'required|string|max:50',
            'ciudad'       => 'nullable|string|max:100',
            'secondName'   => 'nullable|string|max:100',
            'secondSurname'=> 'nullable|string|max:100',
        ]);

        $registro = Registro::create($validated);

        $nombre = $registro->firstName . ' ' . $registro->firstSurname;
        $waText = urlencode(
            "Hola, me inscribí a la 4ta Jornada Nacional de Neurología.\n" .
            "Nombre: {$nombre}\n" .
            "Categoría: {$registro->profession}\n" .
            "Modalidad: {$registro->modalidad}\n" .
            "Adjunto mi comprobante de pago."
        );

        return response()->json([
            'success' => true,
            'nombre'  => $nombre,
            'category'=> $registro->profession,
            'wa_url'  => "https://wa.me/59172475801?text={$waText}",
        ]);
    }
}
