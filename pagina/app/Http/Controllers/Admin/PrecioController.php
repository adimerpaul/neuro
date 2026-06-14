<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PriceTier;
use Illuminate\Http\Request;

class PrecioController extends Controller
{
    public function index()
    {
        $tiers = PriceTier::orderBy('event')->orderBy('sort_order')->get()->groupBy('event');
        return view('admin.precios.index', compact('tiers'));
    }

    public function create()
    {
        return view('admin.precios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event'      => 'required|string|in:simposio,taller',
            'category'   => 'required|string|max:150',
            'price'      => 'required|numeric|min:0',
            'note'       => 'nullable|string|max:255',
            'sort_order' => 'integer',
        ]);

        PriceTier::create($request->only('event', 'category', 'price', 'note', 'sort_order'));

        return redirect()->route('admin.precios.index')->with('success', 'Precio agregado correctamente.');
    }

    public function edit(PriceTier $precio)
    {
        return view('admin.precios.edit', compact('precio'));
    }

    public function update(Request $request, PriceTier $precio)
    {
        $request->validate([
            'event'      => 'required|string|in:simposio,taller',
            'category'   => 'required|string|max:150',
            'price'      => 'required|numeric|min:0',
            'note'       => 'nullable|string|max:255',
            'sort_order' => 'integer',
        ]);

        $precio->update($request->only('event', 'category', 'price', 'note', 'sort_order'));

        return redirect()->route('admin.precios.index')->with('success', 'Precio actualizado correctamente.');
    }

    public function destroy(PriceTier $precio)
    {
        $precio->delete();
        return redirect()->route('admin.precios.index')->with('success', 'Precio eliminado.');
    }
}
