@extends('admin.layout')
@section('title', 'Nuevo Usuario')

@push('styles')
<style>
.back-link { display:inline-flex; align-items:center; gap:.4rem; color:#6b7280; font-size:.85rem; text-decoration:none; margin-bottom:1.25rem; }
.back-link:hover { color:#c0392b; }
.card { background:#fff; border:1px solid #e5e7eb; border-radius:.75rem; padding:1.5rem; max-width:680px; }
.card-title { font-family:'Sora',sans-serif; font-size:1rem; font-weight:700; color:#0d0003; margin-bottom:1.25rem; padding-bottom:.75rem; border-bottom:1px solid #f3f4f6; }
.form-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem; }
.form-group { display:flex; flex-direction:column; gap:.3rem; margin-bottom:1rem; }
.form-label { font-size:.78rem; font-weight:700; color:#374151; font-family:'Sora',sans-serif; }
.form-input, .form-select { font-family:'Mulish',sans-serif; font-size:.9rem; padding:.6rem .85rem; border:1.5px solid #d1d5db; border-radius:.5rem; background:#f9fafb; color:#111827; outline:none; transition:.2s; width:100%; }
.form-input:focus, .form-select:focus { border-color:#c0392b; background:#fff; box-shadow:0 0 0 3px rgba(192,57,43,.1); }
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
<a href="{{ route('admin.usuarios.index') }}" class="back-link">← Volver a usuarios</a>

<div class="card">
    <div class="card-title">Crear nuevo usuario</div>

    @if($errors->any())
        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:.5rem;padding:.75rem 1rem;margin-bottom:1rem;color:#991b1b;font-size:.85rem;">
            <ul style="margin:0;padding-left:1.25rem;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.usuarios.store') }}">
        @csrf
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Nombre completo *</label>
                <input class="form-input" name="name" value="{{ old('name') }}" required placeholder="Ej. Juan Pérez">
                @error('name')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Nickname (usuario) *</label>
                <input class="form-input" name="nickname" value="{{ old('nickname') }}" required placeholder="Ej. juanperez">
                @error('nickname')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Correo electrónico</label>
            <input class="form-input" type="email" name="email" value="{{ old('email') }}" placeholder="opcional">
            @error('email')<div class="error-msg">{{ $message }}</div>@enderror
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Contraseña *</label>
                <input class="form-input" type="password" name="password" required placeholder="Mínimo 8 caracteres">
                @error('password')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Confirmar contraseña *</label>
                <input class="form-input" type="password" name="password_confirmation" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Rol *</label>
            <select class="form-select" name="role" required>
                <option value="participante" {{ old('role','participante')==='participante'?'selected':'' }}>Participante</option>
                <option value="admin" {{ old('role')==='admin'?'selected':'' }}>Administrador</option>
            </select>
            @error('role')<div class="error-msg">{{ $message }}</div>@enderror
        </div>
        <div class="btn-row">
            <button type="submit" class="btn btn-primary">✅ Crear usuario</button>
            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>
@endsection
