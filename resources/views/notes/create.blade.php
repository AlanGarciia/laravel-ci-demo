@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Nueva nota</h1>

    <form action="{{ route('notes.store') }}" method="POST" class="space-y-4 max-w-xl">
        @csrf

        @include('notes.partials.form', ['note' => null])

        <button type="submit"
                class="rounded-xl bg-indigo-500 px-4 py-2 text-sm font-medium hover:bg-indigo-400 transition">
            Guardar nota
        </button>
    </form>
@endsection
