@extends('admin.layout')
@section('title', 'Recursos')

@push('styles')
<style>
    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; align-items: start; }
    @media (max-width: 900px) { .two-col { grid-template-columns: 1fr; } }
    .panel-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; }
    .panel-title { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; color: #0d0003; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid #f3f4f6; }
    table { width: 100%; border-collapse: collapse; font-size: 0.83rem; }
    th { padding: 0.6rem 0.75rem; text-align: left; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; color: #9ca3af; border-bottom: 1px solid #f3f4f6; }
    td { padding: 0.6rem 0.75rem; border-bottom: 1px solid #f9fafb; color: #374151; vertical-align: middle; }
    tr:last-child td { border-bottom: none; }
    .type-badge { display: inline-block; padding: 0.15rem 0.5rem; border-radius: 1rem; font-size: 0.7rem; font-weight: 700; }
    .type-link  { background: #eff6ff; color: #1d4ed8; }
    .type-file  { background: #f0fdf4; color: #166534; }
    .type-video { background: #fef2f2; color: #991b1b; }
    .btn-del { padding: 0.3rem 0.6rem; background: #fef2f2; border: none; border-radius: 0.35rem; color: #991b1b; font-size: 0.75rem; cursor: pointer; }
    .btn-del:hover { background: #fee2e2; }
    /* Form */
    .field-group { margin-bottom: 0.875rem; }
    label { display: block; font-size: 0.83rem; font-weight: 600; color: #374151; margin-bottom: 0.3rem; }
    input[type="text"], input[type="url"], input[type="number"], select, textarea {
        width: 100%; padding: 0.55rem 0.75rem; border: 1.5px solid #d1d5db; border-radius: 0.5rem;
        font-family: 'Mulish', sans-serif; font-size: 0.875rem; color: #111; outline: none;
    }
    input:focus, select:focus, textarea:focus { border-color: #c0392b; }
    textarea { min-height: 60px; resize: vertical; }
    .field-error { color: #ef4444; font-size: 0.78rem; margin-top: 0.2rem; }
    .btn-save { background: #c0392b; color: #fff; border: none; border-radius: 0.5rem; padding: 0.65rem 1.25rem; font-family: 'Sora', sans-serif; font-size: 0.875rem; font-weight: 600; cursor: pointer; width: 100%; margin-top: 0.5rem; }
    .btn-save:hover { background: #a93226; }
    .empty-msg { text-align: center; padding: 2rem; color: #9ca3af; font-size: 0.875rem; }
</style>
@endpush

@section('admin-content')
<div class="two-col">
    <!-- Lista de recursos -->
    <div class="panel-card">
        <div class="panel-title">Recursos existentes ({{ $recursos->count() }})</div>
        @if($recursos->isEmpty())
            <div class="empty-msg">No hay recursos aún.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Público</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recursos as $r)
                    <tr>
                        <td>
                            <div style="font-weight:600; font-size:0.83rem;">{{ $r->title }}</div>
                            @if($r->url) <a href="{{ $r->url }}" target="_blank" style="font-size:0.73rem; color:#c0392b;">↗ ver</a> @endif
                        </td>
                        <td>
                            <span class="type-badge type-{{ $r->type }}">{{ $r->type }}</span>
                        </td>
                        <td>{{ $r->is_public ? 'Sí' : 'No' }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.recursos.destroy', $r) }}" onsubmit="return confirm('¿Eliminar recurso?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-del">✕</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Formulario para agregar -->
    <div class="panel-card">
        <div class="panel-title">Agregar nuevo recurso</div>
        @if($errors->any())
            <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:0.5rem;padding:0.65rem 0.875rem;color:#991b1b;font-size:0.8rem;margin-bottom:0.875rem;">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.recursos.store') }}">
            @csrf
            <div class="field-group">
                <label>Título</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Ej: Presentación Dr. Pérez"/>
                @error('title')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label>Descripción (opcional)</label>
                <textarea name="description">{{ old('description') }}</textarea>
            </div>
            <div class="field-group">
                <label>Tipo</label>
                <select name="type">
                    <option value="link" {{ old('type') == 'link' ? 'selected' : '' }}>Enlace (link)</option>
                    <option value="file" {{ old('type') == 'file' ? 'selected' : '' }}>Archivo (file)</option>
                    <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                </select>
            </div>
            <div class="field-group">
                <label>URL</label>
                <input type="url" name="url" value="{{ old('url') }}" placeholder="https://..."/>
                @error('url')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label>Orden</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"/>
            </div>
            <button type="submit" class="btn-save">Agregar recurso</button>
        </form>
    </div>
</div>
@endsection
