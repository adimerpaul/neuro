@extends('admin.layout')
@section('title', 'Editar slot')

@push('styles')
<style>
    .form-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 2rem; max-width: 680px; }
    .form-title { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; color: #0d0003; margin-bottom: 1.5rem; }
    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
    .field-group { margin-bottom: 1rem; }
    label { display: block; font-size: 0.83rem; font-weight: 600; color: #374151; margin-bottom: 0.3rem; }
    input[type="text"], input[type="number"], select, textarea {
        width: 100%; padding: 0.6rem 0.875rem; border: 1.5px solid #d1d5db; border-radius: 0.5rem;
        font-family: 'Mulish', sans-serif; font-size: 0.875rem; color: #111; outline: none;
    }
    input:focus, select:focus, textarea:focus { border-color: #c0392b; }
    textarea { min-height: 80px; resize: vertical; }
    .check-row { display: flex; align-items: center; gap: 0.5rem; }
    .check-row input { width: auto; }
    .field-error { color: #ef4444; font-size: 0.78rem; margin-top: 0.25rem; }
    .form-actions { display: flex; gap: 0.75rem; margin-top: 1.5rem; }
    .btn-save { background: #c0392b; color: #fff; border: none; border-radius: 0.5rem; padding: 0.7rem 1.5rem; font-family: 'Sora', sans-serif; font-size: 0.9rem; font-weight: 600; cursor: pointer; }
    .btn-save:hover { background: #a93226; }
    .btn-cancel { padding: 0.7rem 1.25rem; background: #f3f4f6; border: none; border-radius: 0.5rem; color: #555; font-size: 0.875rem; text-decoration: none; display: inline-flex; align-items: center; }
    .btn-cancel:hover { background: #e5e7eb; }
</style>
@endpush

@section('admin-content')
<div class="form-card">
    <div class="form-title">Editar slot del cronograma</div>
    @if($errors->any())
        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:0.5rem;padding:0.75rem 1rem;color:#991b1b;font-size:0.875rem;margin-bottom:1rem;">
            {{ $errors->first() }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.cronograma.update', $slot) }}">
        @csrf
        @method('PUT')
        <div class="field-row">
            <div class="field-group">
                <label>Día (etiqueta)</label>
                <input type="text" name="day_label" value="{{ old('day_label', $slot->day_label) }}"/>
                @error('day_label')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label>Clave del día</label>
                <select name="day_key">
                    <option value="d1" {{ old('day_key', $slot->day_key) == 'd1' ? 'selected' : '' }}>d1 — Día 1</option>
                    <option value="d2" {{ old('day_key', $slot->day_key) == 'd2' ? 'selected' : '' }}>d2 — Día 2</option>
                    <option value="d3" {{ old('day_key', $slot->day_key) == 'd3' ? 'selected' : '' }}>d3 — Día 3</option>
                </select>
            </div>
        </div>
        <div class="field-group">
            <label>Etiqueta del día</label>
            <input type="text" name="day_tag" value="{{ old('day_tag', $slot->day_tag) }}"/>
            @error('day_tag')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="field-row">
            <div class="field-group">
                <label>Hora inicio</label>
                <input type="text" name="time_start" value="{{ old('time_start', $slot->time_start) }}"/>
                @error('time_start')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label>Hora fin (opcional)</label>
                <input type="text" name="time_end" value="{{ old('time_end', $slot->time_end) }}"/>
            </div>
        </div>
        <div class="field-group">
            <label>Título del slot</label>
            <input type="text" name="title" value="{{ old('title', $slot->title) }}"/>
            @error('title')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="field-group">
            <label>Descripción (opcional)</label>
            <textarea name="description">{{ old('description', $slot->description) }}</textarea>
        </div>
        <div class="field-row">
            <div class="field-group">
                <label>Orden</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $slot->sort_order) }}" min="0"/>
            </div>
            <div class="field-group">
                <label>&nbsp;</label>
                <div class="check-row">
                    <input type="checkbox" id="is_break" name="is_break" value="1" {{ old('is_break', $slot->is_break) ? 'checked' : '' }}/>
                    <label for="is_break" style="margin:0; font-weight:400;">¿Es descanso/almuerzo?</label>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-save">Guardar cambios</button>
            <a href="{{ route('admin.cronograma.index') }}" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>
@endsection
