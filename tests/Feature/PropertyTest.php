<?php

namespace Tests\Feature;

use App\Models\BillingFrequency;
use App\Models\County;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\UnitType;
use App\Models\User;
use Database\Seeders\BillingFrequencySeeder;
use Database\Seeders\CountySeeder;
use Database\Seeders\PropertyTypeSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Database\Seeders\UnitTypeSeeder;
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
    $this->seed(UnitTypeSeeder::class);
    $this->seed(BillingFrequencySeeder::class);

    $this->user = $this->getUser('tenant');
    $this->admin = $this->getUser('admin');
    $this->landlord = $this->getUser('landlord');
    $this->agent = $this->getUser('agent');
  }

  public function test_database_has_roles()
  {
    $this->assertDatabaseHas((new Role())->getTable(), ['name' => 'admin']);
    $this->assertDatabaseHas((new Role())->getTable(), ['name' => 'landlord']);
    $this->assertDatabaseHas((new Role())->getTable(), ['name' => 'tenant']);
    $this->assertDatabaseHas((new Role())->getTable(), ['name' => 'agent']);
  }

  public function test_database_has_counties()
  {
    $this->assertDatabaseHas((new County())->getTable(), ['name' => 'Baringo']);
    $this->assertDatabaseHas((new County())->getTable(), ['name' => 'Nairobi']);
    $this->assertDatabaseHas((new County())->getTable(), ['name' => 'Mombasa']);
    $this->assertDatabaseHas((new County())->getTable(), ['name' => 'Nakuru']);
    $this->assertDatabaseHas((new County())->getTable(), ['name' => 'Uasin Gishu']);
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

  public function test_landlord_can_see_add_unit_button()
  {
    $response = $this->actingAs($this->landlord)->post('/properties', $this->addProperty());

    $response->assertStatus(200);

    $response->assertSee('Add Unit');
  }

  public function test_landlord_can_add_property_and_unit()
  {
    $property = $this->addProperty();

    $unit = $this->addUnit($this->landlord);

    $response = $this->actingAs($this->landlord)->post('/properties', $property);

    $unit_response = $this->actingAs($this->landlord)->post('units/store', $unit);

    $response->assertStatus(200);
    $response->assertSee('Sample');

    $unit_response->assertStatus(200);
    $unit_response->assertSee('A-001');
  }

  private function getUser($role)
  {
    $user = User::factory()->create();

    $user->assignRole($role);

    return $user;
  }

  private function addProperty()
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

    return $property;
  }

  private function addUnit($user)
  {
    $unit_type_id = UnitType::find(1);
    $billing_frequency_id = BillingFrequency::find(1);

    $property_type = PropertyType::find(1);
    $county = County::with('subcounties')->find(2);
    $subcounty = $county->subcounties->first();

    $property = [
      'user_id' => $user->id,
      'name' => 'Sample',
      'property_type_id' => $property_type->id,
      'county_id' => $county->id,
      'subcounty_id' => $subcounty->id,
      'address' => 'Utawala',
      'street' => 'Utawala Rd',
      'cover_image' => \Illuminate\Http\UploadedFile::fake()->image('test.jpg'),
      'agreement_start_date' => now()->addMonth(),
      'agreement_end_date' => now()->addYears(2),
      'rent_payment_day' => '4th Day of the Month',
      'late_payment_charge' => 15,
      'nearest_landmark' => 'Deliverance Church'
    ];

    $property = Property::create($property);

    $unit = [
      'property_id' => $property->id,
      'unit_number' => 'A-001',
      'unit_type_id' => $unit_type_id->id,
      'billing_frequency_id' => $billing_frequency_id->id,
      'floor_number' => '2',
      'rent' => '12000',
      'deposit' => '12000'
    ];

    return $unit;
  }
}
