<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mini Notas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind CDN (modo sencillo para el mini proyecto) --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen">

<header class="border-b border-slate-800 bg-slate-950/80 backdrop-blur">
    <div class="max-w-5xl mx-auto flex items-center justify-between px-4 py-3">
        <a href="{{ route('notes.index') }}" class="flex items-center gap-2">
            <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-indigo-500 text-white font-bold">
                N
            </span>
            <span class="font-semibold text-lg">Mini Notas</span>
        </a>

        <a href="{{ route('notes.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-indigo-500 px-4 py-2 text-sm font-medium hover:bg-indigo-400 transition">
            <span>＋</span> Nueva nota
        </a>
    </div>
</header>

<main class="max-w-5xl mx-auto px-4 py-6">
    @if(session('success'))
        <div class="mb-4 rounded-xl bg-emerald-500/10 border border-emerald-500/40 px-4 py-3 text-sm text-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</main>

</body>
</html>
