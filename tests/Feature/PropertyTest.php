<?php

namespace Tests\Feature;

use App\Models\County;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Database\Seeders\CountySeeder;
use Database\Seeders\PropertyTypeSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PropertyTest extends TestCase
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
        $this->seed(CountySeeder::class);
        $this->seed(PropertyTypeSeeder::class);

        $this->user = $this->getUser('tenant');
        $this->admin = $this->getUser('admin');
        $this->landlord = $this->getUser('landlord');
        $this->agent = $this->getUser('agent');
    }

    public function test_admin_can_view_all_properties()
    {
        $response = $this->actingAs($this->admin)->get('/properties');

        $response->assertStatus(200);
    }

    public function test_landlord_can_see_add_property_button()
    {
        $response = $this->actingAs($this->landlord)->get('/properties/create');

        $response->assertStatus(200);

        $response->assertSee('Submit');
    }

    public function test_landlord_can_add_property()
    {
        $property_type = PropertyType::find(1);
        $county = County::with('subcounties')->find(2);
        $subcounty = $county->subcounties->first();

        $property = [
          'plName' => 'Sample',
          'plPropertyType' => $property_type->id,
          'plPropertyCounty' => $county->id,
          'plPropertySubcounty' => $subcounty->id,
          'plPropertyAddress' => 'Utawala',
          'plPropertyStreet' => 'Utawala Rd',
          'plCoverImage' => \Illuminate\Http\UploadedFile::fake()->image('test.jpg'),
          'plAgreementStartDate' => now()->addMonth(),
          'plAgreementEndDate' => now()->addYears(2),
          'plRentPaymentDay' => '4th Day of the Month',
          'plLatePaymentCharge' => 15,
          'plNearestLandmark' => 'Deliverance Church'
        ];

        $response = $this->actingAs($this->landlord)->post('/properties', $property);

        $response->assertStatus(200);
        $response->assertSee($property['plName']);
    }
//
//    public function test_landlord_can_view_all_properties()
//    {
//
//    }
//
//    public function test_agent_can_view_all_properties()
//    {
//
//    }
//
//    public function test_tenant_can_view_all_properties()
//    {
//
//    }
//
//    public function test_agent_can_add_property()
//    {
//
//    }
//
//    public function test_tenant_cannot_add_property()
//    {
//
//    }

  private function getUser($role)
  {
    $user = User::factory()->create();

    $user->assignRole($role);

    return $user;
  }
}
