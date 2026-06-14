<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registro;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    public function index(Request $request)
    {
        $query = Registro::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('firstName', 'like', "%{$search}%")
                  ->orWhere('firstSurname', 'like', "%{$search}%")
                  ->orWhere('secondSurname', 'like', "%{$search}%")
                  ->orWhere('ci', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('evento')) {
            $query->where('cursoTaller', $request->evento);
        }

        if ($request->filled('confirmado')) {
            $query->where('confirmado', $request->confirmado === '1');
        }

        $registros = $query->latest()->paginate(25)->withQueryString();

        return view('admin.participantes.index', compact('registros'));
    }

    public function show(Registro $registro)
    {
        $registro->load('user');
        return view('admin.participantes.show', compact('registro'));
    }

    public function edit(Registro $registro)
    {
        return view('admin.participantes.edit', compact('registro'));
    }

    public function update(Request $request, Registro $registro)
    {
        $request->validate([
            'firstName'    => 'required|string|max:100',
            'secondName'   => 'nullable|string|max:100',
            'firstSurname' => 'required|string|max:100',
            'secondSurname'=> 'nullable|string|max:100',
            'ci'           => 'required|string|max:30',
            'phone'        => 'nullable|string|max:20',
            'email'        => 'nullable|email|max:150',
            'profession'   => 'required|string|max:100',
            'departamento' => 'required|string|max:100',
            'provincia'    => 'nullable|string|max:100',
            'direccion'    => 'nullable|string|max:200',
            'cursoTaller'  => 'nullable|string|max:100',
            'modalidad'    => 'nullable|string|max:50',
            'observacion'  => 'nullable|string',
            'confirmado'   => 'boolean',
        ]);

        $registro->update($request->except('_token', '_method'));

        return redirect()->route('admin.participantes.show', $registro)->with('success', 'Participante actualizado.');
    }

    public function destroy(Registro $registro)
    {
        $registro->delete();
        return redirect()->route('admin.participantes.index')->with('success', 'Participante eliminado.');
    }

    public function toggleConfirmado(Registro $registro)
    {
        $registro->update(['confirmado' => !$registro->confirmado]);
        $estado = $registro->confirmado ? 'confirmado' : 'desconfirmado';
        return back()->with('success', "Pago {$estado} correctamente.");
    }
}
