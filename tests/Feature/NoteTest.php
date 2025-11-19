<?php

namespace Tests\Feature;

use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_homepage_loads()
    {
        // La home redirige a /notes
        $this->get('/')
            ->assertStatus(302)
            ->assertRedirect(route('notes.index'));

        // La página principal de notas carga correctamente
        $this->get(route('notes.index'))
            ->assertStatus(200)
            ->assertSee('Mini Notas');
    }

    public function test_we_can_create_a_note()
    {
        $response = $this->post('/notes', [
            'title'   => 'Probar creación',
            'content' => 'Contenido de prueba',
            'color'   => '#f97316', // por ejemplo
            // no mandamos 'pinned' -> debería ser 0 en BD
        ]);

        $response->assertRedirect(route('notes.index'));

        $this->assertDatabaseHas('notes', [
            'title'  => 'Probar creación',
            'pinned' => 0,
        ]);
    }

    public function test_we_can_pin_a_note()
    {
        $note = Note::create([
            'title'   => 'Nota a fijar',
            'content' => 'Texto de prueba',
            'color'   => '#e5e7eb',
            'pinned'  => 0,
        ]);

        // Estado inicial: no fijada
        $this->assertEquals(0, $note->pinned);

        // Simulamos marcarla como fijada usando nuestro update
        $response = $this->put("/notes/{$note->id}", [
            'title'   => $note->title,
            'content' => $note->content,
            'color'   => $note->color,
            'pinned'  => 1,
        ]);

        $response->assertRedirect(route('notes.index'));

        $note = $note->fresh();

        // Ahora debe estar fijada
        $this->assertEquals(1, $note->pinned);

        // Y en la base de datos también
        $this->assertDatabaseHas('notes', [
            'id'     => $note->id,
            'pinned' => 1,
        ]);
    }
}
