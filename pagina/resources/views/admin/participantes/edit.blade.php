@extends('admin.layout')
@section('title', 'Editar Participante')

@push('styles')
<style>
.back-link { display:inline-flex; align-items:center; gap:.4rem; color:#6b7280; font-size:.85rem; text-decoration:none; margin-bottom:1.25rem; }
.back-link:hover { color:#c0392b; }
.card { background:#fff; border:1px solid #e5e7eb; border-radius:.75rem; padding:1.5rem; }
.card-title { font-family:'Sora',sans-serif; font-size:1rem; font-weight:700; color:#0d0003; margin-bottom:1.25rem; padding-bottom:.75rem; border-bottom:1px solid #f3f4f6; }
.form-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem; }
.form-group { display:flex; flex-direction:column; gap:.3rem; }
.form-label { font-size:.78rem; font-weight:700; color:#374151; font-family:'Sora',sans-serif; }
.form-input, .form-select, .form-textarea {
    font-family:'Mulish',sans-serif; font-size:.9rem; padding:.6rem .85rem;
    border:1.5px solid #d1d5db; border-radius:.5rem; background:#f9fafb; color:#111827; outline:none; transition:.2s;
}
.form-input:focus, .form-select:focus, .form-textarea:focus { border-color:#c0392b; background:#fff; box-shadow:0 0 0 3px rgba(192,57,43,.1); }
.form-textarea { resize:vertical; min-height:80px; }
.form-check { display:flex; align-items:center; gap:.5rem; cursor:pointer; font-size:.9rem; }
.form-check input { width:18px; height:18px; accent-color:#c0392b; cursor:pointer; }
.error-msg { color:#dc2626; font-size:.75rem; margin-top:.2rem; }
.btn-row { display:flex; gap:.65rem; margin-top:1.5rem; }
.btn { display:inline-flex; align-items:center; gap:.4rem; padding:.6rem 1.25rem; border:none; border-radius:.5rem; font-size:.87rem; font-weight:600; cursor:pointer; text-decoration:none; transition:.15s; }
.btn-primary { background:#c0392b; color:#fff; }
.btn-primary:hover { background:#9b0000; }
.btn-outline { background:#f9fafb; color:#374151; border:1px solid #e5e7eb; }
.btn-outline:hover { background:#f3f4f6; }
@media(max-width:640px) { .form-row { grid-template-columns:1fr; } }
</style>
@endpush

@section('admin-content')
<a href="{{ route('admin.participantes.show', $registro) }}" class="back-link">← Volver al perfil</a>

<div class="card">
    <div class="card-title">Editar: {{ $registro->nombre_completo }}</div>

    @if($errors->any())
        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:.5rem;padding:.75rem 1rem;margin-bottom:1rem;color:#991b1b;font-size:.85rem;">
            <ul style="margin:0;padding-left:1.25rem;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.participantes.update', $registro) }}">
        @csrf @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Primer nombre *</label>
                <input class="form-input" name="firstName" value="{{ old('firstName', $registro->firstName) }}" required>
                @error('firstName')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Segundo nombre</label>
                <input class="form-input" name="secondName" value="{{ old('secondName', $registro->secondName) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Primer apellido *</label>
                <input class="form-input" name="firstSurname" value="{{ old('firstSurname', $registro->firstSurname) }}" required>
                @error('firstSurname')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Segundo apellido</label>
                <input class="form-input" name="secondSurname" value="{{ old('secondSurname', $registro->secondSurname) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">CI *</label>
                <input class="form-input" name="ci" value="{{ old('ci', $registro->ci) }}" required>
                @error('ci')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Teléfono</label>
                <input class="form-input" name="phone" value="{{ old('phone', $registro->phone) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Correo electrónico</label>
                <input class="form-input" type="email" name="email" value="{{ old('email', $registro->email) }}">
            </div>
            <div class="form-group">
                <label class="form-label">Profesión *</label>
                <input class="form-input" name="profession" value="{{ old('profession', $registro->profession) }}" required>
                @error('profession')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Departamento *</label>
                <input class="form-input" name="departamento" value="{{ old('departamento', $registro->departamento) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Provincia</label>
                <input class="form-input" name="provincia" value="{{ old('provincia', $registro->provincia) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Dirección</label>
                <input class="form-input" name="direccion" value="{{ old('direccion', $registro->direccion) }}">
            </div>
            <div class="form-group">
                <label class="form-label">Evento</label>
                <select class="form-select" name="cursoTaller">
                    <option value="">Simposio Internacional</option>
                    <option value="Seminario-Taller" {{ $registro->cursoTaller === 'Seminario-Taller' ? 'selected' : '' }}>Seminario-Taller</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Modalidad</label>
                <select class="form-select" name="modalidad">
                    <option value="Presencial" {{ $registro->modalidad === 'Presencial' ? 'selected' : '' }}>Presencial</option>
                    <option value="Virtual" {{ $registro->modalidad === 'Virtual' ? 'selected' : '' }}>Virtual</option>
                </select>
            </div>
            <div class="form-group" style="justify-content:flex-end;padding-bottom:.5rem;">
                <label class="form-check">
                    <input type="hidden" name="confirmado" value="0">
                    <input type="checkbox" name="confirmado" value="1" {{ $registro->confirmado ? 'checked' : '' }}>
                    <span>Pago confirmado</span>
                </label>
            </div>
        </div>
        <div class="form-group" style="margin-bottom:0">
            <label class="form-label">Observaciones</label>
            <textarea class="form-textarea" name="observacion">{{ old('observacion', $registro->observacion) }}</textarea>
        </div>

        <div class="btn-row">
            <button type="submit" class="btn btn-primary">💾 Guardar cambios</button>
            <a href="{{ route('admin.participantes.show', $registro) }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>
@endsection
