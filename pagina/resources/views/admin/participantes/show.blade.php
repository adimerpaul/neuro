@extends('admin.layout')
@section('title', 'Participante')

@push('styles')
<style>
.back-link { display:inline-flex; align-items:center; gap:.4rem; color:#6b7280; font-size:.85rem; text-decoration:none; margin-bottom:1.25rem; }
.back-link:hover { color:#c0392b; }
.card { background:#fff; border:1px solid #e5e7eb; border-radius:.75rem; padding:1.5rem; margin-bottom:1.25rem; }
.card-title { font-family:'Sora',sans-serif; font-size:1rem; font-weight:700; color:#0d0003; margin-bottom:1rem; padding-bottom:.75rem; border-bottom:1px solid #f3f4f6; }
.info-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1px; background:#f3f4f6; border:1px solid #e5e7eb; border-radius:.5rem; overflow:hidden; }
.info-item { background:#fff; padding:.85rem 1rem; }
.info-lbl { font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.06em; color:#9ca3af; margin-bottom:.25rem; }
.info-val { font-family:'Sora',sans-serif; font-size:.9rem; font-weight:600; color:#111827; }
.badge { display:inline-block; padding:.25rem .65rem; border-radius:2rem; font-size:.72rem; font-weight:700; }
.badge-yes { background:#dcfce7; color:#166534; }
.badge-no  { background:#fef2f2; color:#991b1b; }
.actions-bar { display:flex; gap:.65rem; flex-wrap:wrap; }
.btn { display:inline-flex; align-items:center; gap:.4rem; padding:.55rem 1.1rem; border:none; border-radius:.5rem; font-size:.84rem; font-weight:600; cursor:pointer; text-decoration:none; transition:.15s; }
.btn-primary { background:#c0392b; color:#fff; }
.btn-primary:hover { background:#9b0000; }
.btn-outline { background:#f9fafb; color:#374151; border:1px solid #e5e7eb; }
.btn-outline:hover { background:#f3f4f6; }
.btn-green { background:#16a34a; color:#fff; }
.btn-green:hover { background:#15803d; }
.btn-warn { background:#f59e0b; color:#fff; }
.btn-warn:hover { background:#d97706; }
.btn-red { background:#dc2626; color:#fff; }
.btn-red:hover { background:#b91c1c; }
.comprobante-img { max-width:400px; border-radius:.5rem; border:1px solid #e5e7eb; }
@media(max-width:700px) { .info-grid { grid-template-columns:1fr 1fr; } }
</style>
@endpush

@section('admin-content')
<a href="{{ route('admin.participantes.index') }}" class="back-link">← Volver a participantes</a>

<div class="card">
    <div class="card-title" style="display:flex;align-items:center;justify-content:space-between;">
        <span>{{ $registro->nombre_completo }}</span>
        <span class="badge {{ $registro->confirmado ? 'badge-yes' : 'badge-no' }}">
            {{ $registro->confirmado ? '✅ Pago confirmado' : '⏳ Pago pendiente' }}
        </span>
    </div>

    <div class="info-grid">
        <div class="info-item"><div class="info-lbl">Nombre completo</div><div class="info-val">{{ $registro->nombre_completo }}</div></div>
        <div class="info-item"><div class="info-lbl">Carnet de Identidad</div><div class="info-val">{{ $registro->ci }}</div></div>
        <div class="info-item"><div class="info-lbl">Teléfono</div><div class="info-val">{{ $registro->phone ?: '—' }}</div></div>
        <div class="info-item"><div class="info-lbl">Correo</div><div class="info-val">{{ $registro->email ?: '—' }}</div></div>
        <div class="info-item"><div class="info-lbl">Profesión</div><div class="info-val">{{ $registro->profession }}</div></div>
        <div class="info-item"><div class="info-lbl">Departamento</div><div class="info-val">{{ $registro->departamento }}</div></div>
        <div class="info-item"><div class="info-lbl">Provincia</div><div class="info-val">{{ $registro->provincia ?: '—' }}</div></div>
        <div class="info-item"><div class="info-lbl">Dirección</div><div class="info-val">{{ $registro->direccion ?: '—' }}</div></div>
        <div class="info-item"><div class="info-lbl">Evento</div><div class="info-val">{{ $registro->cursoTaller ?: 'Simposio Internacional' }}</div></div>
        <div class="info-item"><div class="info-lbl">Modalidad</div><div class="info-val">{{ $registro->modalidad ?: 'Presencial' }}</div></div>
        <div class="info-item"><div class="info-lbl">Usuario (nickname)</div><div class="info-val">{{ $registro->user?->nickname ?? '—' }}</div></div>
        <div class="info-item"><div class="info-lbl">Fecha inscripción</div><div class="info-val">{{ $registro->created_at->format('d/m/Y H:i') }}</div></div>
    </div>

    @if($registro->observacion)
        <div style="margin-top:1rem;background:#fdf9ec;border:1px solid #fde68a;border-radius:.5rem;padding:.85rem 1rem;font-size:.85rem;color:#92400e;">
            <strong>Observación:</strong> {{ $registro->observacion }}
        </div>
    @endif
</div>

@if($registro->file)
<div class="card">
    <div class="card-title">Comprobante de pago</div>
    @php $ext = strtolower(pathinfo($registro->file, PATHINFO_EXTENSION)); @endphp
    @if(in_array($ext, ['jpg','jpeg','png','webp','gif']))
        <img src="{{ asset('storage/' . $registro->file) }}" alt="Comprobante" class="comprobante-img">
    @else
        <a href="{{ asset('storage/' . $registro->file) }}" target="_blank" class="btn btn-outline">📄 Ver comprobante</a>
    @endif
</div>
@endif

<div class="actions-bar">
    <a href="{{ route('admin.participantes.edit', $registro) }}" class="btn btn-primary">✏️ Editar</a>
    <form method="POST" action="{{ route('admin.participantes.toggle', $registro) }}">
        @csrf @method('PATCH')
        <button type="submit" class="btn {{ $registro->confirmado ? 'btn-warn' : 'btn-green' }}">
            {{ $registro->confirmado ? '↩ Desconfirmar pago' : '✔ Confirmar pago' }}
        </button>
    </form>
    <form method="POST" action="{{ route('admin.participantes.destroy', $registro) }}" onsubmit="return confirm('¿Eliminar este participante?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-red">🗑 Eliminar</button>
    </form>
</div>
@endsection
