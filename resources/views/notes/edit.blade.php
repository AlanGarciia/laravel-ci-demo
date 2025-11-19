@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Editar nota</h1>

    <form action="{{ route('notes.update', $note) }}" method="POST" class="space-y-4 max-w-xl">
        @csrf
        @method('PUT')

        @include('notes.partials.form', ['note' => $note])

        <button type="submit"
                class="rounded-xl bg-indigo-500 px-4 py-2 text-sm font-medium hover:bg-indigo-400 transition">
            Actualizar nota
        </button>
    </form>
@endsection
