@extends('admin.layout')
@section('title', 'Cronograma')

@push('styles')
<style>
    .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
    .page-title { font-family: 'Sora', sans-serif; font-size: 1.25rem; font-weight: 700; color: #0d0003; }
    .btn-add {
        background: #c0392b; color: #fff; border: none; border-radius: 0.5rem;
        padding: 0.6rem 1.25rem; font-family: 'Sora', sans-serif; font-size: 0.875rem;
        font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;
    }
    .btn-add:hover { background: #a93226; }
    .day-section { margin-bottom: 1.5rem; }
    .day-head {
        background: linear-gradient(135deg, #1a0006, #3d0010);
        color: #fff; padding: 0.75rem 1.25rem; border-radius: 0.5rem 0.5rem 0 0;
        font-family: 'Sora', sans-serif; font-size: 0.95rem; font-weight: 700;
    }
    .table-wrap { background: #fff; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 0.5rem 0.5rem; overflow: hidden; }
    table { width: 100%; border-collapse: collapse; font-size: 0.83rem; }
    th { padding: 0.65rem 1rem; text-align: left; font-weight: 700; color: #374151; font-size: 0.73rem; text-transform: uppercase; background: #f9fafb; border-bottom: 1px solid #e5e7eb; }
    td { padding: 0.65rem 1rem; border-bottom: 1px solid #f3f4f6; color: #374151; }
    tr:last-child td { border-bottom: none; }
    .badge-break { background: #f3f4f6; color: #9ca3af; padding: 0.15rem 0.5rem; border-radius: 1rem; font-size: 0.7rem; }
    .actions { display: flex; gap: 0.5rem; }
    .btn-edit {
        padding: 0.3rem 0.65rem; background: #f3f4f6; border: none; border-radius: 0.35rem;
        color: #374151; font-size: 0.78rem; cursor: pointer; text-decoration: none;
    }
    .btn-edit:hover { background: #e5e7eb; }
    .btn-del {
        padding: 0.3rem 0.65rem; background: #fef2f2; border: none; border-radius: 0.35rem;
        color: #991b1b; font-size: 0.78rem; cursor: pointer;
    }
    .btn-del:hover { background: #fee2e2; }
</style>
@endpush

@section('admin-content')
<div class="page-header">
    <div class="page-title">Cronograma del evento</div>
    <a href="{{ route('admin.cronograma.create') }}" class="btn-add">+ Agregar slot</a>
</div>

@foreach($slots as $key => $daySlots)
<div class="day-section">
    <div class="day-head">
        {{ $daySlots->first()->day_label }} — {{ $daySlots->first()->day_tag }}
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Hora</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>¿Descanso?</th>
                    <th>Orden</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($daySlots as $slot)
                <tr>
                    <td>{{ $slot->time_start }}@if($slot->time_end) → {{ $slot->time_end }}@endif</td>
                    <td style="font-weight:600;">{{ $slot->title }}</td>
                    <td style="color:#888; max-width:280px;">{{ Str::limit($slot->description, 60) }}</td>
                    <td>@if($slot->is_break)<span class="badge-break">Sí</span>@else —@endif</td>
                    <td>{{ $slot->sort_order }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.cronograma.edit', $slot) }}" class="btn-edit">Editar</a>
                            <form method="POST" action="{{ route('admin.cronograma.destroy', $slot) }}" onsubmit="return confirm('¿Eliminar este slot?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-del">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endforeach
@endsection
