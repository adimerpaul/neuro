@extends('admin.layout')
@section('title', 'Usuarios')

@push('styles')
<style>
.page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.25rem; flex-wrap:wrap; gap:.75rem; }
.page-title { font-family:'Sora',sans-serif; font-size:1.25rem; font-weight:700; color:#0d0003; }
.btn { display:inline-flex; align-items:center; gap:.4rem; padding:.5rem 1rem; border:none; border-radius:.5rem; font-size:.84rem; font-weight:600; cursor:pointer; text-decoration:none; transition:.15s; }
.btn-primary { background:#c0392b; color:#fff; }
.btn-primary:hover { background:#9b0000; }
.btn-sm { padding:.3rem .65rem; font-size:.75rem; }
.btn-outline { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; }
.btn-outline:hover { background:#e5e7eb; }
.btn-red { background:#dc2626; color:#fff; }
.btn-red:hover { background:#b91c1c; }
.search-input { padding:.5rem .85rem; border:1.5px solid #d1d5db; border-radius:.5rem; font-size:.85rem; outline:none; width:250px; }
.search-input:focus { border-color:#c0392b; }
.table-wrap { background:#fff; border-radius:.75rem; border:1px solid #e5e7eb; overflow:hidden; }
table { width:100%; border-collapse:collapse; font-size:.82rem; }
thead { background:#f9fafb; }
th { padding:.7rem 1rem; text-align:left; font-weight:700; color:#374151; font-size:.72rem; text-transform:uppercase; letter-spacing:.04em; border-bottom:1px solid #e5e7eb; }
td { padding:.65rem 1rem; border-bottom:1px solid #f3f4f6; color:#374151; vertical-align:middle; }
tr:last-child td { border-bottom:0; }
tr:hover td { background:#fafafa; }
.badge { display:inline-block; padding:.2rem .6rem; border-radius:2rem; font-size:.68rem; font-weight:700; }
.badge-admin { background:#fce7f3; color:#9d174d; }
.badge-part  { background:#eff6ff; color:#1d4ed8; }
.actions { display:flex; gap:.35rem; }
.pagination-wrap { padding:1rem 1.25rem; display:flex; justify-content:center; }
.empty-msg { text-align:center; padding:3rem; color:#9ca3af; }
</style>
@endpush

@section('admin-content')
<div class="page-header">
    <div class="page-title">Usuarios <span style="font-weight:400;font-size:.9rem;color:#9ca3af;">({{ $usuarios->total() }})</span></div>
    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary">+ Nuevo usuario</a>
</div>

<form method="GET" style="margin-bottom:1rem;display:flex;gap:.5rem;">
    <input class="search-input" type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre, nick o correo…">
    <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
    @if(request('search'))
        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline btn-sm">✕</a>
    @endif
</form>

<div class="table-wrap">
    @if($usuarios->isEmpty())
        <div class="empty-msg">No hay usuarios registrados.</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Nickname</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Participante</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $u)
                <tr>
                    <td style="font-weight:600;">{{ $u->name }}</td>
                    <td><code style="font-size:.8rem;background:#f3f4f6;padding:.15rem .4rem;border-radius:.3rem;">{{ $u->nickname }}</code></td>
                    <td>{{ $u->email ?: '—' }}</td>
                    <td>
                        @foreach($u->roles as $role)
                            <span class="badge {{ $role->name === 'admin' ? 'badge-admin' : 'badge-part' }}">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @if($u->registro)
                            <a href="{{ route('admin.participantes.show', $u->registro) }}" style="color:#c0392b;text-decoration:none;font-size:.8rem;">
                                {{ $u->registro->nombre_completo }}
                            </a>
                        @else
                            <span style="color:#9ca3af;font-size:.75rem;">Sin registro</span>
                        @endif
                    </td>
                    <td style="font-size:.75rem;">{{ $u->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.usuarios.edit', $u) }}" class="btn btn-outline btn-sm">✏️ Editar</a>
                            @if($u->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.usuarios.destroy', $u) }}" onsubmit="return confirm('¿Eliminar usuario {{ $u->nickname }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-red btn-sm">🗑</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrap">{{ $usuarios->links() }}</div>
    @endif
</div>
@endsection
