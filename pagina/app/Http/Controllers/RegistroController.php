<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RegistroController extends Controller
{
    public function show()
    {
        return view('inscripcion');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstSurname'      => 'required|string|max:100',
            'secondSurname'     => 'nullable|string|max:100',
            'firstName'         => 'required|string|max:100',
            'secondName'        => 'nullable|string|max:100',
            'ci'                => 'required|string|max:20',
            'phone'             => 'required|string|max:20',
            'email'             => 'nullable|email|max:150',
            'profession'        => 'required|string|max:150',
            'professionOther'   => 'nullable|string|max:150',
            'departamento'      => 'required|string|max:100',
            'departamentoOther' => 'nullable|string|max:100',
            'provincia'         => 'nullable|string|max:100',
            'direccion'         => 'nullable|string|max:200',
            'cursoTaller'       => 'nullable|string|max:100',
            'modalidad'         => 'nullable|string|max:50',
            'file'              => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('comprobantes', 'public');
        }

        if ($validated['profession'] === 'Otro' && $request->filled('professionOther')) {
            $validated['profession'] = 'Otro: ' . $request->professionOther;
        }
        if ($validated['departamento'] === 'Otro' && $request->filled('departamentoOther')) {
            $validated['departamento'] = 'Otro: ' . $request->departamentoOther;
        }

        unset($validated['professionOther'], $validated['departamentoOther']);

        $registro = Registro::create($validated);

        $nombre   = $registro->nombre_completo;
        $nickname = $this->generateNickname($registro->firstName, $registro->firstSurname);
        $password = $registro->ci; // CI como contraseña inicial

        $user = User::create([
            'name'        => $nombre,
            'nickname'    => $nickname,
            'email'       => $registro->email ?? $nickname . '@neurooruro.bo',
            'password'    => Hash::make($password),
            'registro_id' => $registro->id,
        ]);

        $waText = urlencode(
            "Hola, me inscribí al 1er Simposio Internacional NeuroOruro 2026.\n" .
            "Nombre: {$nombre}\n" .
            "CI: {$registro->ci}\n" .
            "Profesión: {$registro->profession}\n" .
            "Usuario: {$nickname}\n" .
            "Adjunto mi comprobante de pago."
        );

        return response()->json([
            'success'  => true,
            'nombre'   => $nombre,
            'category' => $registro->profession,
            'nickname' => $nickname,
            'password' => $password,
            'wa_url'   => "https://wa.me/59172475801?text={$waText}",
        ]);
    }

    private function generateNickname(string $firstName, string $firstSurname): string
    {
        $base = strtolower($this->removeAccents($firstName . $firstSurname));
        $base = preg_replace('/[^a-z0-9]/', '', $base);

        $nickname = $base;
        $i = 2;
        while (User::withTrashed()->where('nickname', $nickname)->exists()) {
            $nickname = $base . $i++;
        }
        return $nickname;
    }

    private function removeAccents(string $str): string
    {
        $from = ['á','é','í','ó','ú','ä','ë','ï','ö','ü','à','è','ì','ò','ù','â','ê','î','ô','û','ñ',
                 'Á','É','Í','Ó','Ú','Ä','Ë','Ï','Ö','Ü','À','È','Ì','Ò','Ù','Â','Ê','Î','Ô','Û','Ñ'];
        $to   = ['a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','n',
                 'a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','n'];
        return str_replace($from, $to, $str);
    }
}
