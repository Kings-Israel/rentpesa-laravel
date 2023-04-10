<?php

namespace Tests\Feature;

use \App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected User $admin;
    protected User $landlord;
    protected User $agent;

    protected function setUp(): void
    {
      parent::setUp();

      $this->seed(RolesAndPermissionsSeeder::class);

      $this->user = $this->getUser('tenant');
      $this->admin = $this->getUser('admin');
      $this->landlord = $this->getUser('landlord');
      $this->agent = $this->getUser('agent');
    }

    public function test_unauthenticated_user_cannot_see_dashboard()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_dashboard()
    {
      $response = $this->actingAs($this->getUser('landlord'))->get('/');

      $response->assertStatus(200);
    }

    private function getUser($role)
    {
      $user = User::factory()->create();

      $user->assignRole($role);

      return $user;
    }
}
