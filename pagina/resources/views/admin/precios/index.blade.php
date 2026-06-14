@extends('admin.layout')
@section('title', 'Precios')

@push('styles')
<style>
    .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
    .page-title { font-family: 'Sora', sans-serif; font-size: 1.25rem; font-weight: 700; color: #0d0003; }
    .btn-add { background: #c0392b; color: #fff; border: none; border-radius: 0.5rem; padding: 0.6rem 1.25rem; font-family: 'Sora', sans-serif; font-size: 0.875rem; font-weight: 600; text-decoration: none; }
    .btn-add:hover { background: #a93226; }
    .event-section { margin-bottom: 1.75rem; }
    .event-head { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; color: #0d0003; margin-bottom: 0.75rem; text-transform: capitalize; }
    .table-wrap { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden; }
    table { width: 100%; border-collapse: collapse; font-size: 0.83rem; }
    th { padding: 0.65rem 1rem; text-align: left; font-weight: 700; color: #374151; font-size: 0.73rem; text-transform: uppercase; background: #f9fafb; border-bottom: 1px solid #e5e7eb; }
    td { padding: 0.65rem 1rem; border-bottom: 1px solid #f3f4f6; color: #374151; }
    tr:last-child td { border-bottom: none; }
    .price-val { font-weight: 700; color: #c0392b; }
    .actions { display: flex; gap: 0.5rem; }
    .btn-edit { padding: 0.3rem 0.65rem; background: #f3f4f6; border: none; border-radius: 0.35rem; color: #374151; font-size: 0.78rem; cursor: pointer; text-decoration: none; }
    .btn-edit:hover { background: #e5e7eb; }
    .btn-del { padding: 0.3rem 0.65rem; background: #fef2f2; border: none; border-radius: 0.35rem; color: #991b1b; font-size: 0.78rem; cursor: pointer; }
    .btn-del:hover { background: #fee2e2; }
</style>
@endpush

@section('admin-content')
<div class="page-header">
    <div class="page-title">Tarifas y precios</div>
    <a href="{{ route('admin.precios.create') }}" class="btn-add">+ Agregar precio</a>
</div>

@foreach($tiers as $event => $eventTiers)
<div class="event-section">
    <div class="event-head">{{ ucfirst($event) }}</div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Precio (Bs.)</th>
                    <th>Nota</th>
                    <th>Orden</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eventTiers as $tier)
                <tr>
                    <td style="font-weight:600;">{{ $tier->category }}</td>
                    <td class="price-val">{{ number_format($tier->price, 0) }}</td>
                    <td>{{ $tier->note ?: '—' }}</td>
                    <td>{{ $tier->sort_order }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.precios.edit', $tier) }}" class="btn-edit">Editar</a>
                            <form method="POST" action="{{ route('admin.precios.destroy', $tier) }}" onsubmit="return confirm('¿Eliminar este precio?')">
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
