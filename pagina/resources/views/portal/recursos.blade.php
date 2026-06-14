@extends('portal.layout')
@section('title', 'Recursos')

@push('styles')
<style>
    .recursos-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem; }
    .recurso-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 1.25rem;
        display: flex;
        gap: 1rem;
        align-items: flex-start;
        transition: box-shadow 0.2s;
    }
    .recurso-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.08); }
    .recurso-icon {
        width: 44px; height: 44px;
        border-radius: 0.5rem;
        background: #fef2f2;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }
    .recurso-title { font-weight: 700; color: #111; font-size: 0.9rem; margin-bottom: 0.25rem; }
    .recurso-desc { font-size: 0.8rem; color: #666; margin-bottom: 0.5rem; }
    .recurso-link {
        display: inline-flex; align-items: center; gap: 0.3rem;
        font-size: 0.8rem; font-weight: 600; color: #c0392b;
        text-decoration: none;
    }
    .recurso-link:hover { text-decoration: underline; }
    .empty-state {
        background: #fff;
        border: 2px dashed #e5e7eb;
        border-radius: 1rem;
        padding: 3rem;
        text-align: center;
        color: #9ca3af;
    }
    .empty-state .es-icon { font-size: 3rem; margin-bottom: 1rem; }
    .empty-state .es-title { font-family: 'Sora', sans-serif; font-size: 1.1rem; font-weight: 600; color: #6b7280; margin-bottom: 0.5rem; }
</style>
@endpush

@section('portal-content')
@if($recursos->isEmpty())
    <div class="empty-state">
        <div class="es-icon">📚</div>
        <div class="es-title">Recursos próximamente</div>
        <p>Los recursos del simposio estarán disponibles aquí una vez que el evento comience.</p>
    </div>
@else
    <div class="recursos-grid">
        @foreach($recursos as $recurso)
            <div class="recurso-card">
                <div class="recurso-icon">
                    @if($recurso->type === 'video') 🎥
                    @elseif($recurso->type === 'file') 📄
                    @else 🔗
                    @endif
                </div>
                <div>
                    <div class="recurso-title">{{ $recurso->title }}</div>
                    @if($recurso->description)
                        <div class="recurso-desc">{{ $recurso->description }}</div>
                    @endif
                    @if($recurso->url)
                        <a href="{{ $recurso->url }}" target="_blank" rel="noopener" class="recurso-link">
                            Abrir ↗
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
