<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_log_in_and_is_redirected_to_admin(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@gmail.com',
            'password' => 'admin',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }
}
