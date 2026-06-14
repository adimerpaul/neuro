@extends('admin.layout')
@section('title', 'Agregar precio')

@push('styles')
<style>
    .form-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 2rem; max-width: 520px; }
    .form-title { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; color: #0d0003; margin-bottom: 1.5rem; }
    .field-group { margin-bottom: 1rem; }
    label { display: block; font-size: 0.83rem; font-weight: 600; color: #374151; margin-bottom: 0.3rem; }
    input[type="text"], input[type="number"], select {
        width: 100%; padding: 0.6rem 0.875rem; border: 1.5px solid #d1d5db; border-radius: 0.5rem;
        font-family: 'Mulish', sans-serif; font-size: 0.875rem; color: #111; outline: none;
    }
    input:focus, select:focus { border-color: #c0392b; }
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
    <div class="form-title">Agregar nuevo precio</div>
    @if($errors->any())
        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:0.5rem;padding:0.75rem 1rem;color:#991b1b;font-size:0.875rem;margin-bottom:1rem;">
            {{ $errors->first() }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.precios.store') }}">
        @csrf
        <div class="field-group">
            <label>Evento</label>
            <select name="event">
                <option value="simposio" {{ old('event') == 'simposio' ? 'selected' : '' }}>Simposio</option>
                <option value="taller" {{ old('event') == 'taller' ? 'selected' : '' }}>Taller</option>
            </select>
        </div>
        <div class="field-group">
            <label>Categoría profesional</label>
            <input type="text" name="category" value="{{ old('category') }}" placeholder="Ej: Médicos Generales"/>
            @error('category')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="field-group">
            <label>Precio (Bs.)</label>
            <input type="number" name="price" value="{{ old('price') }}" min="0" step="0.01" placeholder="200"/>
            @error('price')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="field-group">
            <label>Nota (opcional)</label>
            <input type="text" name="note" value="{{ old('note') }}" placeholder="Ej: Con carnet universitario vigente"/>
        </div>
        <div class="field-group">
            <label>Orden</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"/>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-save">Guardar precio</button>
            <a href="{{ route('admin.precios.index') }}" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>
@endsection
