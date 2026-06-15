<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller{
    public function inscritosPorProfesion(){
        $data = Registro::select('profession', \DB::raw('COUNT(*) as total'))
            ->groupBy('profession')
            ->orderByDesc('total')
            ->get();

        return response()->json($data);
    }
    function index(){
        $registros = Registro::orderBy('id', 'desc')->get();
        return $registros;
    }
    public function store(Request $request)
    {
        $request->validate([
            'firstSurname' => 'required|string',
            'firstName' => 'required|string',
            'ci' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'profession' => 'required|string',
            'departamento' => 'required|string',
            'provincia' => 'required|string',
            'direccion' => 'required|string',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png',
//            'file2' => 'nullable|file|mimes:pdf,jpg,jpeg,png'
            'observacion' => 'nullable|string',
        ],[
            'file.required' => 'Se debe mandar el documento de comprobante.',
            'file.mimes' => 'El comprobante debe ser un archivo en formato PDF, JPG, JPEG o PNG.',
        ]);

        // Guardar archivos
        $path1 = $request->file('file')->store('comprobantes', 'public');
        $path2 = $request->hasFile('file2') ? $request->file('file2')->store('comprobantes', 'public') : null;

        $registro = Registro::create([
            ...$request->only([
                'firstSurname', 'secondSurname', 'firstName', 'secondName',
                'ci', 'phone', 'email', 'profession', 'professionOther',
                'departamento', 'provincia', 'direccion', 'cursoTaller'
            ]),
//            'cursoTaller' => $request->cursoTaller ? 1 : 0,
            'file' => $path1,
            'file2' => $path2,
            'observacion' => $request->observacion,

        ]);

        return response()->json(['success' => true, 'data' => $registro], 201);
    }
    function destroy($id){
        $registro = Registro::find($id);
        if ($registro) {
            $registro->delete();
            return response()->json(['success' => true, 'message' => 'Registro eliminado correctamente.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado.'], 404);
        }
    }
    function update(Request $request, $id){
//        quitar re requeser file y file 2 si no se manda
        $file = $request->file('file');
        $file2 = $request->file('file2');
        $registro = Registro::find($id);
        if ($file) {
            $path1 = $file->store('comprobantes', 'public');
            $registro->file = $path1;
        }
        if ($file2) {
            $path2 = $file2->store('comprobantes', 'public');
            $registro->file2 = $path2;
        }
        error_log('firstName: ' . $request->firstName);
        $registro->firstSurname = $request->firstSurname ?? '';
        $registro->secondSurname = $request->secondSurname ?? '';
        $registro->firstName = $request->firstName ?? '';
        $registro->secondName = $request->secondName ?? '';
        $registro->ci = $request->ci ?? '';
        $registro->phone = $request->phone ?? '';
        $registro->email = $request->email ?? '';
        $registro->profession = $request->profession ?? '';
        $registro->professionOther = $request->professionOther ?? '';
        $registro->departamento = $request->departamento ?? '';
        $registro->provincia = $request->provincia ?? '';
        $registro->direccion = $request->direccion ?? '';
        $registro->cursoTaller = $request->cursoTaller ?? '';
        $registro->observacion = $request->observacion ?? '';

        $registro->save();

    }
    public function crearUsuarioDesdeRegistro(Request $request)
    {
        $registro = Registro::findOrFail($request->id);

        $yaExiste = User::where('ci', $registro->ci)
//            ->orWhere('email', $registro->email)
            ->exists();

        if ($yaExiste) {
            return response()->json([
                'success' => false,
                'message' => 'Este usuario ya fue creado.'
            ], 409);
        }
        //return '1';

        $user = User::create([
            'firstName' => $registro->firstName?? '',
            'secondName' => $registro->secondName ?? '',
            'lastName' => $registro->firstSurname ?? '',
            'secondLastName' => $registro->secondSurname ?? '',
            'ci' => $registro->ci ?? '',
            'phone' => $registro->phone ?? '',
            'celular' => $registro->phone ?? '',
            'email' => $registro->email ?? '',
            'correo' => $registro->email ?? '',
            'profession' => $registro->profession ?? '',
            'departamento' => $registro->departamento ?? '',
            'provincia' => $registro->provincia ?? '',
            'direccion' => $registro->direccion ?? '',
            'password' => Hash::make($registro->ci) ?? '',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado correctamente.',
            'data' => $user
        ]);
    }
}
