<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SymposiumResource;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    public function index()
    {
        $recursos = SymposiumResource::orderBy('sort_order')->get();
        return view('admin.recursos.index', compact('recursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:200',
            'description' => 'nullable|string',
            'type'        => 'required|string|in:link,file,video',
            'url'         => 'nullable|url|max:500',
            'is_public'   => 'boolean',
            'sort_order'  => 'integer',
        ]);

        SymposiumResource::create([
            'title'       => $request->title,
            'description' => $request->description,
            'type'        => $request->type,
            'url'         => $request->url,
            'is_public'   => $request->boolean('is_public', true),
            'sort_order'  => $request->integer('sort_order', 0),
        ]);

        return redirect()->route('admin.recursos.index')->with('success', 'Recurso agregado correctamente.');
    }

    public function destroy(SymposiumResource $r)
    {
        $r->delete();
        return redirect()->route('admin.recursos.index')->with('success', 'Recurso eliminado.');
    }
}
