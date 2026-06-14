@extends('portal.layout')
@section('title', 'Mis Datos')

@push('styles')
<style>
    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    @media (max-width: 768px) { .two-col { grid-template-columns: 1fr; } }
    .panel-card {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem;
    }
    .panel-title {
        font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700;
        color: #0d0003; margin-bottom: 1.25rem; padding-bottom: 0.75rem;
        border-bottom: 2px solid #f3f4f6;
    }
    .data-row { display: flex; flex-direction: column; margin-bottom: 1rem; }
    .data-label { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.04em; color: #9ca3af; margin-bottom: 0.2rem; }
    .data-value { font-size: 0.9rem; font-weight: 600; color: #111; }
    .field-group { margin-bottom: 1rem; }
    label { display: block; font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 0.3rem; }
    input[type="text"], input[type="email"] {
        width: 100%; padding: 0.65rem 0.875rem;
        border: 1.5px solid #d1d5db; border-radius: 0.5rem;
        font-family: 'Mulish', sans-serif; font-size: 0.9rem;
        color: #111; outline: none; transition: border-color 0.2s;
    }
    input:focus { border-color: #c0392b; box-shadow: 0 0 0 3px rgba(192,57,43,0.1); }
    .field-error { color: #ef4444; font-size: 0.78rem; margin-top: 0.25rem; }
    .btn-save {
        background: #c0392b; color: #fff; border: none; border-radius: 0.5rem;
        padding: 0.75rem 1.5rem; font-family: 'Sora', sans-serif; font-size: 0.9rem;
        font-weight: 600; cursor: pointer; transition: background 0.2s;
    }
    .btn-save:hover { background: #a93226; }
</style>
@endpush

@section('portal-content')
<div class="two-col">
    <!-- Datos del registro (readonly) -->
    <div class="panel-card">
        <div class="panel-title">Datos de inscripción</div>
        @if($registro)
            <div class="data-row"><span class="data-label">Nombre completo</span><span class="data-value">{{ $registro->nombreCompleto }}</span></div>
            <div class="data-row"><span class="data-label">CI</span><span class="data-value">{{ $registro->ci }}</span></div>
            <div class="data-row"><span class="data-label">Profesión</span><span class="data-value">{{ $registro->profession }}</span></div>
            <div class="data-row"><span class="data-label">Evento</span><span class="data-value">{{ $registro->cursoTaller ?: 'Simposio' }}</span></div>
            <div class="data-row"><span class="data-label">Modalidad</span><span class="data-value">{{ $registro->modalidad ?: '—' }}</span></div>
            <div class="data-row"><span class="data-label">Departamento</span><span class="data-value">{{ $registro->departamento }}</span></div>
            <div class="data-row"><span class="data-label">Usuario (nickname)</span><span class="data-value">{{ $user->nickname }}</span></div>
        @else
            <p style="color:#9ca3af; font-size:0.875rem;">No hay datos de inscripción asociados.</p>
        @endif
    </div>

    <!-- Datos editables -->
    <div class="panel-card">
        <div class="panel-title">Datos actualizables</div>
        <form method="POST" action="{{ route('portal.mis-datos.update') }}">
            @csrf
            @method('PUT')
            <div class="field-group">
                <label>Teléfono / WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone', $registro?->phone) }}" placeholder="591 7xxxxxxx"/>
                @error('phone')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $registro?->email) }}" placeholder="correo@ejemplo.com"/>
                @error('email')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label>Provincia</label>
                <input type="text" name="provincia" value="{{ old('provincia', $registro?->provincia) }}"/>
                @error('provincia')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label>Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion', $registro?->direccion) }}"/>
                @error('direccion')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn-save">Guardar cambios</button>
        </form>
    </div>
</div>
@endsection
