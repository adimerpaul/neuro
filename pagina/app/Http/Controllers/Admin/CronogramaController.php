<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScheduleSlot;
use Illuminate\Http\Request;

class CronogramaController extends Controller
{
    public function index()
    {
        $slots = ScheduleSlot::orderBy('day_key')->orderBy('sort_order')->get()->groupBy('day_key');
        return view('admin.cronograma.index', compact('slots'));
    }

    public function create()
    {
        return view('admin.cronograma.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'day_label'  => 'required|string|max:100',
            'day_key'    => 'required|string|max:10',
            'day_tag'    => 'required|string|max:100',
            'time_start' => 'required|string|max:10',
            'time_end'   => 'nullable|string|max:10',
            'title'      => 'required|string|max:200',
            'description'=> 'nullable|string',
            'is_break'   => 'boolean',
            'sort_order' => 'integer',
        ]);

        ScheduleSlot::create([
            'day_label'   => $request->day_label,
            'day_key'     => $request->day_key,
            'day_tag'     => $request->day_tag,
            'time_start'  => $request->time_start,
            'time_end'    => $request->time_end,
            'title'       => $request->title,
            'description' => $request->description,
            'is_break'    => $request->boolean('is_break'),
            'sort_order'  => $request->integer('sort_order', 0),
        ]);

        return redirect()->route('admin.cronograma.index')->with('success', 'Slot agregado correctamente.');
    }

    public function edit(ScheduleSlot $cronograma)
    {
        return view('admin.cronograma.edit', ['slot' => $cronograma]);
    }

    public function update(Request $request, ScheduleSlot $cronograma)
    {
        $request->validate([
            'day_label'  => 'required|string|max:100',
            'day_key'    => 'required|string|max:10',
            'day_tag'    => 'required|string|max:100',
            'time_start' => 'required|string|max:10',
            'time_end'   => 'nullable|string|max:10',
            'title'      => 'required|string|max:200',
            'description'=> 'nullable|string',
            'is_break'   => 'boolean',
            'sort_order' => 'integer',
        ]);

        $cronograma->update([
            'day_label'   => $request->day_label,
            'day_key'     => $request->day_key,
            'day_tag'     => $request->day_tag,
            'time_start'  => $request->time_start,
            'time_end'    => $request->time_end,
            'title'       => $request->title,
            'description' => $request->description,
            'is_break'    => $request->boolean('is_break'),
            'sort_order'  => $request->integer('sort_order', 0),
        ]);

        return redirect()->route('admin.cronograma.index')->with('success', 'Slot actualizado correctamente.');
    }

    public function destroy(ScheduleSlot $cronograma)
    {
        $cronograma->delete();
        return redirect()->route('admin.cronograma.index')->with('success', 'Slot eliminado.');
    }
}
