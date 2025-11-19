<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        // Fijadas arriba, el resto debajo
        $notesPinned = Note::where('pinned', true)
            ->orderByDesc('updated_at')
            ->get();

        $notes = Note::where('pinned', false)
            ->orderByDesc('updated_at')
            ->get();

        return view('notes.index', compact('notesPinned', 'notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
            'color'   => 'nullable|string',
        ]);

        $data['pinned'] = $request->boolean('pinned');

        Note::create($data);

        return redirect()->route('notes.index')
            ->with('success', 'Nota creada');
    }

    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
            'color'   => 'nullable|string',
        ]);

        $data['pinned'] = $request->boolean('pinned');

        $note->update($data);

        return redirect()->route('notes.index')
            ->with('success', 'Nota actualizada');
    }

    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('notes.index')
            ->with('success', 'Nota eliminada');
    }
}
