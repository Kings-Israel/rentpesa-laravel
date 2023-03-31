<?php

namespace Tests\Feature;

use \App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_see_dashboard()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_dashboard()
    {
      $user = User::create([
        'name' => 'Test User',
        'email' => 'test@user.com',
        'password' => Hash::make('password'),
      ]);

      $response = $this->actingAs($user)->get('/');

      $response->assertStatus(200);
    }
}
