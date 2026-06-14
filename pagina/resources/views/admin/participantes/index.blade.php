@extends('admin.layout')
@section('title', 'Participantes')

@push('styles')
<style>
.page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.25rem; flex-wrap:wrap; gap:.75rem; }
.page-title { font-family:'Sora',sans-serif; font-size:1.25rem; font-weight:700; color:#0d0003; }
.filters { display:flex; gap:.5rem; flex-wrap:wrap; align-items:center; }
.search-input { padding:.5rem .85rem; border:1.5px solid #d1d5db; border-radius:.5rem; font-family:'Mulish',sans-serif; font-size:.85rem; outline:none; width:230px; }
.search-input:focus { border-color:#c0392b; }
.filter-select { padding:.5rem .75rem; border:1.5px solid #d1d5db; border-radius:.5rem; font-size:.85rem; outline:none; }
.btn { display:inline-flex; align-items:center; gap:.35rem; padding:.45rem .85rem; border:none; border-radius:.45rem; font-size:.8rem; font-weight:600; cursor:pointer; text-decoration:none; transition:.15s; }
.btn-primary { background:#c0392b; color:#fff; }
.btn-primary:hover { background:#9b0000; }
.btn-sm { padding:.3rem .65rem; font-size:.75rem; }
.btn-outline { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; }
.btn-outline:hover { background:#e5e7eb; }
.btn-green { background:#16a34a; color:#fff; }
.btn-green:hover { background:#15803d; }
.btn-red { background:#dc2626; color:#fff; }
.btn-red:hover { background:#b91c1c; }
.btn-warn { background:#f59e0b; color:#fff; }
.btn-warn:hover { background:#d97706; }
.table-wrap { background:#fff; border-radius:.75rem; border:1px solid #e5e7eb; overflow:hidden; }
table { width:100%; border-collapse:collapse; font-size:.82rem; }
thead { background:#f9fafb; }
th { padding:.7rem 1rem; text-align:left; font-weight:700; color:#374151; font-size:.72rem; text-transform:uppercase; letter-spacing:.04em; border-bottom:1px solid #e5e7eb; white-space:nowrap; }
td { padding:.65rem 1rem; border-bottom:1px solid #f3f4f6; color:#374151; vertical-align:middle; }
tr:last-child td { border-bottom:0; }
tr:hover td { background:#fafafa; }
.badge { display:inline-block; padding:.2rem .55rem; border-radius:2rem; font-size:.68rem; font-weight:700; }
.badge-yes { background:#dcfce7; color:#166534; }
.badge-no  { background:#fef2f2; color:#991b1b; }
.actions { display:flex; gap:.35rem; flex-wrap:nowrap; }
.pagination-wrap { padding:1rem 1.25rem; display:flex; justify-content:center; }
.empty-msg { text-align:center; padding:3rem; color:#9ca3af; }
.name-cell { font-weight:600; color:#0d0003; }
.nick-cell { font-size:.7rem; color:#9ca3af; }
</style>
@endpush

@section('admin-content')
<div class="page-header">
    <div class="page-title">Participantes <span style="font-weight:400;font-size:.9rem;color:#9ca3af;">({{ $registros->total() }})</span></div>
</div>

<form method="GET" action="{{ route('admin.participantes.index') }}" style="margin-bottom:1rem;">
    <div class="filters">
        <input class="search-input" type="text" name="search" value="{{ request('search') }}" placeholder="Nombre, apellido, CI o correo…">
        <select class="filter-select" name="evento">
            <option value="">Todos los eventos</option>
            <option value="Seminario-Taller" {{ request('evento')==='Seminario-Taller'?'selected':'' }}>Seminario-Taller</option>
            <option value="Simposio" {{ request('evento')==='Simposio'?'selected':'' }}>Simposio</option>
        </select>
        <select class="filter-select" name="confirmado">
            <option value="">Todos</option>
            <option value="1" {{ request('confirmado')==='1'?'selected':'' }}>Confirmados</option>
            <option value="0" {{ request('confirmado')==='0'?'selected':'' }}>Sin confirmar</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
        @if(request()->hasAny(['search','evento','confirmado']))
            <a href="{{ route('admin.participantes.index') }}" class="btn btn-outline btn-sm">Limpiar</a>
        @endif
    </div>
</form>

<div class="table-wrap">
    @if($registros->isEmpty())
        <div class="empty-msg">No se encontraron participantes.</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>CI</th>
                    <th>Profesión</th>
                    <th>Depto.</th>
                    <th>Evento</th>
                    <th>Modalidad</th>
                    <th>Pago</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registros as $r)
                <tr>
                    <td style="color:#9ca3af;font-size:.75rem;">{{ $r->id }}</td>
                    <td>
                        <div class="name-cell">{{ $r->firstName }} {{ $r->firstSurname }}</div>
                        @if($r->user)<div class="nick-cell">@{{ $r->user->nickname }}</div>@endif
                    </td>
                    <td>{{ $r->ci }}</td>
                    <td>{{ Str::limit($r->profession, 25) }}</td>
                    <td>{{ $r->departamento }}</td>
                    <td>{{ $r->cursoTaller ?: 'Simposio' }}</td>
                    <td>{{ $r->modalidad ?: '—' }}</td>
                    <td>
                        <span class="badge {{ $r->confirmado ? 'badge-yes' : 'badge-no' }}">
                            {{ $r->confirmado ? '✅ Sí' : '⏳ No' }}
                        </span>
                    </td>
                    <td style="white-space:nowrap;font-size:.75rem;">{{ $r->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.participantes.show', $r) }}" class="btn btn-outline btn-sm">👁</a>
                            <a href="{{ route('admin.participantes.edit', $r) }}" class="btn btn-outline btn-sm">✏️</a>
                            <form method="POST" action="{{ route('admin.participantes.toggle', $r) }}" style="display:inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $r->confirmado ? 'btn-warn' : 'btn-green' }}" title="{{ $r->confirmado ? 'Desconfirmar' : 'Confirmar pago' }}">
                                    {{ $r->confirmado ? '↩' : '✔' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.participantes.destroy', $r) }}" style="display:inline" onsubmit="return confirm('¿Eliminar este participante?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-red btn-sm">🗑</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrap">{{ $registros->links() }}</div>
    @endif
</div>
@endsection
