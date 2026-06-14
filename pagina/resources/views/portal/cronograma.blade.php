@extends('portal.layout')
@section('title', 'Cronograma')

@push('styles')
<style>
    .day-tabs { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
    .day-tab {
        padding: 0.5rem 1.25rem;
        border-radius: 2rem;
        border: 2px solid #e5e7eb;
        background: #fff;
        color: #555;
        cursor: pointer;
        font-family: 'Sora', sans-serif;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.2s;
    }
    .day-tab.active { border-color: #c0392b; background: #c0392b; color: #fff; }
    .day-tab:hover:not(.active) { border-color: #c0392b; color: #c0392b; }
    .day-panel { display: none; }
    .day-panel.active { display: block; }
    .day-header {
        background: linear-gradient(135deg, #1a0006, #3d0010);
        color: #fff;
        border-radius: 0.75rem 0.75rem 0 0;
        padding: 1rem 1.5rem;
    }
    .day-header .dh-label { font-family: 'Sora', sans-serif; font-size: 1.1rem; font-weight: 700; }
    .day-header .dh-tag { font-size: 0.8rem; opacity: 0.7; margin-top: 0.1rem; }
    .slots-table {
        background: #fff;
        border-radius: 0 0 0.75rem 0.75rem;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        border-top: none;
        margin-bottom: 1.5rem;
    }
    .slot-row {
        display: grid;
        grid-template-columns: 130px 1fr;
        border-bottom: 1px solid #f3f4f6;
    }
    .slot-row:last-child { border-bottom: none; }
    .slot-row.is-break { background: #f9fafb; }
    .slot-time {
        padding: 0.875rem 1rem;
        font-size: 0.8rem;
        font-weight: 700;
        color: #c0392b;
        border-right: 1px solid #f3f4f6;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .slot-info { padding: 0.875rem 1.25rem; }
    .slot-title { font-weight: 600; color: #111; font-size: 0.9rem; }
    .slot-desc { font-size: 0.8rem; color: #666; margin-top: 0.25rem; }
    .break-badge {
        display: inline-block; padding: 0.2rem 0.6rem;
        background: #f3f4f6; color: #9ca3af;
        border-radius: 1rem; font-size: 0.7rem; font-weight: 600;
        margin-top: 0.25rem;
    }
</style>
@endpush

@section('portal-content')
<div class="day-tabs">
    @foreach($slots as $key => $daySlots)
        <button class="day-tab {{ $loop->first ? 'active' : '' }}" onclick="switchDay('{{ $key }}')">
            {{ $daySlots->first()->day_label }}
        </button>
    @endforeach
</div>

@foreach($slots as $key => $daySlots)
    <div class="day-panel {{ $loop->first ? 'active' : '' }}" id="panel-{{ $key }}">
        <div class="day-header">
            <div class="dh-label">{{ $daySlots->first()->day_label }}</div>
            <div class="dh-tag">{{ $daySlots->first()->day_tag }}</div>
        </div>
        <div class="slots-table">
            @foreach($daySlots as $slot)
                <div class="slot-row {{ $slot->is_break ? 'is-break' : '' }}">
                    <div class="slot-time">
                        {{ $slot->time_start }}
                        @if($slot->time_end) <span style="color:#9ca3af; font-weight:400;">→ {{ $slot->time_end }}</span> @endif
                    </div>
                    <div class="slot-info">
                        <div class="slot-title">{{ $slot->title }}</div>
                        @if($slot->description)
                            <div class="slot-desc">{{ $slot->description }}</div>
                        @endif
                        @if($slot->is_break)
                            <span class="break-badge">Pausa / Descanso</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach

<script>
function switchDay(key) {
    document.querySelectorAll('.day-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.day-tab').forEach(t => t.classList.remove('active'));
    document.getElementById('panel-' + key).classList.add('active');
    event.currentTarget.classList.add('active');
}
</script>
@endsection
