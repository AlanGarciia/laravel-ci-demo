@extends('layouts.app')

@section('content')
    @if($notesPinned->isNotEmpty())
        <h2 class="text-sm font-semibold text-slate-400 mb-2">Fijadas</h2>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 mb-6">
            @foreach($notesPinned as $note)
                @include('notes.partials.card', ['note' => $note])
            @endforeach
        </div>
    @endif

    <h2 class="text-sm font-semibold text-slate-400 mb-2">Todas las notas</h2>

    @if($notes->isEmpty() && $notesPinned->isEmpty())
        <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6 text-center text-slate-400">
            No hay notas todavía. Crea una con el botón de arriba ✨
        </div>
    @else
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($notes as $note)
                @include('notes.partials.card', ['note' => $note])
            @endforeach
        </div>
    @endif
@endsection
