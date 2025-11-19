@php
    $color = $note->color ?: '#e5e7eb';
@endphp

<div class="group relative rounded-2xl border border-slate-800 bg-slate-900/60 p-4 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition">
    <div class="absolute right-3 top-3 h-3 w-3 rounded-full border border-slate-900"
         style="background-color: {{ $color }}"></div>

    @if($note->pinned)
        <span class="inline-flex items-center gap-1 rounded-full bg-yellow-400/10 border border-yellow-400/40 px-2 py-0.5 text-[11px] text-yellow-200 mb-2">
            📌 Fijada
        </span>
    @endif

    <h3 class="font-semibold text-slate-50 mb-1 line-clamp-1">
        {{ $note->title }}
    </h3>

    <p class="text-sm text-slate-300 mb-3 line-clamp-4">
        {{ $note->content }}
    </p>

    <div class="flex items-center justify-between text-xs text-slate-400 mt-2">
        <span>Actualizada: {{ $note->updated_at->format('d/m/Y H:i') }}</span>

        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition">
            <a href="{{ route('notes.edit', $note) }}" class="hover:text-indigo-300">Editar</a>

            <form action="{{ route('notes.destroy', $note) }}" method="POST"
                  onsubmit="return confirm('¿Eliminar nota?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="hover:text-red-300">Borrar</button>
            </form>
        </div>
    </div>
</div>
