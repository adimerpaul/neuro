@extends('portal.layout')
@section('title', 'Mi Panel')

@push('styles')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #c0392b 0%, #7b1a1a 100%);
        border-radius: 1rem;
        padding: 2rem;
        color: #fff;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .welcome-title { font-family: 'Sora', sans-serif; font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem; }
    .welcome-sub { font-size: 0.9rem; opacity: 0.8; }
    .welcome-icon { font-size: 3rem; opacity: 0.6; }
    .status-badge {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.35rem 0.85rem; border-radius: 2rem; font-size: 0.78rem; font-weight: 700;
    }
    .badge-confirmed { background: #dcfce7; color: #166534; }
    .badge-pending   { background: #fef9c3; color: #92400e; }
    .info-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
    .info-card {
        background: #fff; border-radius: 0.75rem; padding: 1.25rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }
    .info-card-label { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #9ca3af; margin-bottom: 0.3rem; }
    .info-card-value { font-size: 1rem; font-weight: 600; color: #111; }
    .quick-links { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1rem; }
    .quick-card {
        background: #fff; border-radius: 0.75rem; padding: 1.5rem;
        border: 1px solid #e5e7eb; text-decoration: none; color: inherit;
        text-align: center; transition: box-shadow 0.2s, transform 0.15s;
        display: flex; flex-direction: column; align-items: center; gap: 0.5rem;
    }
    .quick-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.1); transform: translateY(-2px); }
    .quick-card .qc-icon { font-size: 2rem; }
    .quick-card .qc-label { font-weight: 600; font-size: 0.875rem; color: #374151; }
    .section-title { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; color: #0d0003; margin-bottom: 0.75rem; }
</style>
@endpush

@section('portal-content')
<div class="welcome-card">
    <div>
        <div class="welcome-title">¡Hola, {{ $user->registro?->firstName ?? $user->name }}!</div>
        <div class="welcome-sub">Bienvenido al portal de participantes de NeuroOruro 2026</div>
        <br>
        @if($user->registro?->confirmado)
            <span class="status-badge badge-confirmed">✓ Inscripción confirmada</span>
        @else
            <span class="status-badge badge-pending">⏳ Pendiente de confirmación de pago</span>
        @endif
    </div>
    <div class="welcome-icon">🧠</div>
</div>

@if($user->registro)
<div class="section-title">Resumen de tu inscripción</div>
<div class="info-grid">
    <div class="info-card">
        <div class="info-card-label">Nombre completo</div>
        <div class="info-card-value">{{ $user->registro->nombreCompleto }}</div>
    </div>
    <div class="info-card">
        <div class="info-card-label">Profesión</div>
        <div class="info-card-value">{{ $user->registro->profession ?: '—' }}</div>
    </div>
    <div class="info-card">
        <div class="info-card-label">Evento</div>
        <div class="info-card-value">{{ $user->registro->cursoTaller ?: 'Simposio' }}</div>
    </div>
    <div class="info-card">
        <div class="info-card-label">Modalidad</div>
        <div class="info-card-value">{{ $user->registro->modalidad ?: '—' }}</div>
    </div>
    <div class="info-card">
        <div class="info-card-label">Departamento</div>
        <div class="info-card-value">{{ $user->registro->departamento ?: '—' }}</div>
    </div>
    <div class="info-card">
        <div class="info-card-label">Fecha de inscripción</div>
        <div class="info-card-value">{{ $user->registro->created_at->format('d/m/Y') }}</div>
    </div>
</div>
@endif

<div class="section-title" style="margin-top:0.5rem;">Acceso rápido</div>
<div class="quick-links">
    <a href="{{ route('portal.cronograma') }}" class="quick-card">
        <span class="qc-icon">📅</span>
        <span class="qc-label">Cronograma</span>
    </a>
    <a href="{{ route('portal.recursos') }}" class="quick-card">
        <span class="qc-icon">📚</span>
        <span class="qc-label">Recursos</span>
    </a>
    <a href="{{ route('portal.mis-datos') }}" class="quick-card">
        <span class="qc-icon">👤</span>
        <span class="qc-label">Mis Datos</span>
    </a>
    <a href="{{ route('portal.cambiar-password') }}" class="quick-card">
        <span class="qc-icon">🔑</span>
        <span class="qc-label">Cambiar Contraseña</span>
    </a>
</div>
@endsection
