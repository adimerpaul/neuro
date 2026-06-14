@extends('portal.layout')
@section('title', 'Cambiar Contraseña')

@push('styles')
<style>
    .pw-card {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem;
        padding: 2rem; max-width: 480px;
    }
    .pw-title {
        font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700;
        color: #0d0003; margin-bottom: 1.25rem; padding-bottom: 0.75rem;
        border-bottom: 2px solid #f3f4f6;
    }
    .field-group { margin-bottom: 1rem; }
    label { display: block; font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 0.3rem; }
    input[type="password"] {
        width: 100%; padding: 0.65rem 0.875rem;
        border: 1.5px solid #d1d5db; border-radius: 0.5rem;
        font-family: 'Mulish', sans-serif; font-size: 0.9rem;
        color: #111; outline: none; transition: border-color 0.2s;
    }
    input:focus { border-color: #c0392b; box-shadow: 0 0 0 3px rgba(192,57,43,0.1); }
    input.has-error { border-color: #f87171; }
    .field-error { color: #ef4444; font-size: 0.78rem; margin-top: 0.25rem; }
    .pw-hint { font-size: 0.78rem; color: #9ca3af; margin-top: 0.2rem; }
    .btn-save {
        background: #c0392b; color: #fff; border: none; border-radius: 0.5rem;
        padding: 0.75rem 1.5rem; font-family: 'Sora', sans-serif; font-size: 0.9rem;
        font-weight: 600; cursor: pointer; transition: background 0.2s; margin-top: 0.5rem;
    }
    .btn-save:hover { background: #a93226; }
</style>
@endpush

@section('portal-content')
<div class="pw-card">
    <div class="pw-title">Cambiar contraseña</div>

    @if($errors->any())
        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:0.5rem;padding:0.75rem 1rem;color:#991b1b;font-size:0.875rem;margin-bottom:1rem;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('portal.cambiar-password.update') }}">
        @csrf
        @method('PUT')
        <div class="field-group">
            <label>Contraseña actual</label>
            <input type="password" name="current_password" class="{{ $errors->has('current_password') ? 'has-error' : '' }}"/>
            @error('current_password')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="field-group">
            <label>Nueva contraseña</label>
            <input type="password" name="new_password" class="{{ $errors->has('new_password') ? 'has-error' : '' }}"/>
            <div class="pw-hint">Mínimo 8 caracteres.</div>
            @error('new_password')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="field-group">
            <label>Confirmar nueva contraseña</label>
            <input type="password" name="new_password_confirmation"/>
        </div>
        <button type="submit" class="btn-save">Actualizar contraseña</button>
    </form>
</div>
@endsection
