<?php

namespace Tests\Feature;

use App\Models\JobPosting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminJobPostingCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_update_and_delete_a_job_posting(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $createData = [
            'title' => 'Poste Test',
            'status' => 'en_cours',
            'type' => 'CDD',
            'description' => 'Description de test.',
            'published_at' => now()->format('Y-m-d H:i:s'),
            'attributions' => ['Tache 1', ''],
            'aptitudes' => ['Aptitude 1'],
            'pieces_required' => ['Piece 1'],
        ];

        $this->post('/admin/postes', $createData)->assertRedirect();

        $jobPosting = JobPosting::first();
        $this->assertNotNull($jobPosting);
        $this->assertSame(['Tache 1'], $jobPosting->attributions);

        $updateData = [
            'title' => 'Poste Modifié',
            'status' => 'cloture',
            'type' => 'CDI',
            'description' => 'Description mise à jour.',
            'published_at' => now()->addDay()->format('Y-m-d H:i:s'),
            'attributions' => ['Nouvelle tache'],
            'aptitudes' => ['Nouvelle aptitude', ''],
            'pieces_required' => ['Piece 1', 'Piece 2'],
        ];

        $this->put("/admin/postes/{$jobPosting->id}", $updateData)->assertRedirect();
        $jobPosting->refresh();

        $this->assertSame('Poste Modifié', $jobPosting->title);
        $this->assertSame(['Nouvelle aptitude'], $jobPosting->aptitudes);

        $this->delete("/admin/postes/{$jobPosting->id}")->assertRedirect();
        $this->assertDatabaseMissing('job_postings', ['id' => $jobPosting->id]);
    }
}
