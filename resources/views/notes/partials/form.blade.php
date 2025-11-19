@php
    $selectedColor = old('color', $note->color ?? '#e5e7eb');
    $colors = [
        '#f97316', // naranja
        '#22c55e', // verde
        '#3b82f6', // azul
        '#a855f7', // morado
        '#eab308', // amarillo
        '#ec4899', // rosa
        '#e5e7eb', // gris
    ];
@endphp

<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium mb-1">Título</label>
        <input type="text" name="title"
               value="{{ old('title', $note->title ?? '') }}"
               class="w-full rounded-xl border border-slate-700 bg-slate-900/60 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('title')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Contenido</label>
        <textarea name="content" rows="4"
                  class="w-full rounded-xl border border-slate-700 bg-slate-900/60 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('content', $note->content ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Color</label>

        <input type="hidden" name="color" id="color-input" value="{{ $selectedColor }}">

        <div class="flex flex-wrap gap-2">
            @foreach($colors as $color)
                <button type="button"
                        onclick="document.getElementById('color-input').value='{{ $color }}'; document.querySelectorAll('.color-option').forEach(el => el.classList.remove('ring-2','ring-offset-2','ring-indigo-400')); this.classList.add('ring-2','ring-offset-2','ring-indigo-400');"
                        class="color-option h-8 w-8 rounded-full border border-slate-900 @if($selectedColor === $color) ring-2 ring-offset-2 ring-indigo-400 @endif"
                        style="background-color: {{ $color }}"></button>
            @endforeach
        </div>
    </div>

    <div class="flex items-center gap-2">
        <input type="checkbox" id="pinned" name="pinned" value="1"
               @checked(old('pinned', $note->pinned ?? false))>
        <label for="pinned" class="text-sm">Fijar arriba 📌</label>
    </div>
</div>
