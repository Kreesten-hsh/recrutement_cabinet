<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\JobPosting;
use App\Models\Application;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_submit_application()
    {
        Storage::fake('public');

        $job = JobPosting::create([
            'title' => 'Test Job',
            'status' => 'en_cours',
            'type' => 'CDI',
            'description' => 'Description test',
            'published_at' => now(),
        ]);

        $response = $this->post('/candidatures', [
            'job_posting_id' => $job->id,
            'nom' => 'Doe',
            'prenom' => 'John',
            'email' => 'john@example.com',
            'telephone' => '0123456789',
            'cv' => UploadedFile::fake()->create('cv.pdf', 100),
            'diploma' => UploadedFile::fake()->create('diploma.pdf', 100),
            'motivation_letter' => UploadedFile::fake()->create('letter.pdf', 100),
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('applications', [
            'email' => 'john@example.com',
            'job_posting_id' => $job->id,
        ]);
        
        // Vérifier que les fichiers sont stockés (le chemin exact dépend de l'implémentation)
        // Mais au moins qu'il n'y a pas d'erreur
    }

    public function test_application_validation_fails()
    {
        $response = $this->post('/candidatures', []);

        $response->assertSessionHasErrors(['nom', 'prenom', 'email', 'cv']);
    }
}
