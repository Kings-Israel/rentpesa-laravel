<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignUnitRequest;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\BillingFrequency;
use App\Models\Property;
use App\Models\Unit;
use App\Models\UnitType;
use App\Models\User;
use App\Models\UserUnit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:view unit', ['only' => ['index', 'show']]);
    $this->middleware('can:create unit', ['only' => ['create', 'store']]);
    $this->middleware('can:edit unit', ['only' => ['edit', 'update']]);
    // $this->middleware('can:delete unit', ['only' => ['destroy']]);
  }

  public function index()
  {
    // TODO: Create view for all units, separated according to roles(admin can view all units, landlord and agents can only see their units)
  }

  public function create(Property $property = null)
  {
    $unit_types = UnitType::all();
    $billing_frequencies = BillingFrequency::all();
    $properties = [];

    if (!$property) {
      if (auth()->user()->userRole() === 'admin') {
        $properties = Property::all();
      } elseif (auth()->user()->userRole() === 'landlord') {
        $properties = Property::where('user_id', auth()->id())->get();
      }
    }

    return view('content.property.units.create', compact('property', 'properties', 'unit_types', 'billing_frequencies'));
  }

  public function store(StoreUnitRequest $request)
  {
    $unit = Unit::create($request->all());

    $property = Property::find($request->property_id);

    // Flash message
    toastr()->success('', 'Unit added');

    return view('content.property.show', compact('property'));
  }

  public function show(Unit $unit)
  {
    // Get Users
    $users = User::all()->filter(function($user) {
      return $user->getRoleNames()[0] === 'tenant';
    });

    return view('content.property.units.show', compact('unit', 'users'));
  }

  public function edit(Unit $unit)
  {
    if (auth()->user()->userRole() === 'admin') {
      $properties = Property::all();
    } else {
      $properties = auth()->user()->properties;
    }

    $unit_types = UnitType::all();
    $billing_frequencies = BillingFrequency::all();

    return view('content.property.units.edit', compact('unit', 'properties', 'unit_types', 'billing_frequencies'));
  }

  public function update(UpdateUnitRequest $request, Unit $unit)
  {
    $unit->update($request->all());

    $property = Property::find($request->property_id);

    // Flash message
    toastr()->success('', 'Unit updated');

    return view('content.property.show', compact('property'));
  }

  public function delete(Unit $unit)
  {
    $unit->delete();

    // Flash message
    toastr()->success('', 'Unit updated');

    return view('content.property.show')->with('property', $unit->property);
  }

  public function assignUnit(AssignUnitRequest $request)
  {
    $assign_unit = UserUnit::create($request->all());

    // Flash message
    toastr()->success('', 'Unit assigned');

    return back();
  }
}
