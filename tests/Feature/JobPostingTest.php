<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\JobPosting;

class JobPostingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_job_postings()
    {
        $job = JobPosting::create([
            'title' => 'Test Job',
            'status' => 'en_cours',
            'type' => 'CDI',
            'description' => 'Description test',
            'published_at' => now(),
        ]);

        $response = $this->get('/avis');

        $response->assertStatus(200);
        $response->assertSee('Test Job');
    }

    public function test_can_filter_by_search()
    {
        JobPosting::create([
            'title' => 'Développeur PHP',
            'status' => 'en_cours',
            'type' => 'CDI',
            'description' => 'Test',
            'published_at' => now(),
        ]);

        JobPosting::create([
            'title' => 'Designer',
            'status' => 'en_cours',
            'type' => 'CDI',
            'description' => 'Test',
            'published_at' => now(),
        ]);

        $response = $this->get('/avis?search=PHP');

        $response->assertSee('Développeur PHP');
        $response->assertDontSee('Designer');
    }

    public function test_can_view_job_details()
    {
        $job = JobPosting::create([
            'title' => 'Test Job Detail',
            'status' => 'en_cours',
            'type' => 'CDI',
            'description' => 'Description détaillée',
            'published_at' => now(),
        ]);

        $response = $this->get("/avis/{$job->id}");

        $response->assertStatus(200);
        $response->assertSee('Test Job Detail');
        $response->assertSee('Description détaillée');
    }
}
