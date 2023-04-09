<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Resources\PropertiesResource;
use App\Jobs\StoreImage;
use App\Models\County;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:view property', ['only' => ['index', 'show']]);
      $this->middleware('can:create property', ['only' => ['create', 'store']]);
      $this->middleware('can:edit property', ['only' => ['edit', 'update']]);
      $this->middleware('can:delete property', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('content.property.index');
    }

    public function propertiesResource()
    {
        return new PropertiesResource();
    }

    public function create(): View
    {
        $property_types = PropertyType::all();
        $counties = County::with('subcounties')->get();

        return view('content.property.create', compact('property_types', 'counties'));
    }

    public function store(StorePropertyRequest $request)
    {
        $property = auth()->user()->properties()->create([
          'property_type_id' => $request->plPropertyType,
          'name' => $request->plName,
          'cover_image' => pathinfo($request->plCoverImage->store('cover', 'property'), PATHINFO_BASENAME),
          'rent_payment_day' => $request->plRentPaymentDay,
          'late_payment_charge' => $request->plLatePaymentCharge,
          'county_id' => $request->plPropertyCounty,
          'subcounty_id' => $request->plPropertySubcounty,
          'nearest_landmark' => $request->has('plNearestLandmark') && $request->plNearestLandmark != null ? $request->plNearestLandmark : NULL,
          'street' => $request->has('plPropertyStreet') && $request->plPropertyStreet != null ? $request->plPropertyStreet : NULL,
          'address' => $request->has('plPropertyAddress') && $request->plPropertyAddress != null ? $request->plPropertyAddress : NULL,
          'agreement_start_date' => $request->plAgreementStartDate,
          'agreement_end_date' => $request->plAgreementEndDate,
          'other_details' => $request->has('plOtherDetails') && $request->plOtherDetails != null ? $request->plOtherDetails : NULL,
        ]);

//        return view('content.property.show', compact('property'));
      return redirect()->route('properties.index')->with('success', 'Property added successfully');
    }

    public function show(Property $property)
    {
        //TODO: Add view for showing a property
    }

    public function edit(Property $property)
    {
        //TODO: Add view for editing a property
    }

    public function update(Request $request, Property $property)
    {
        //TODO: Add functionality to update property
    }

    public function destroy(Property $property)
    {
        // TODO: Add functionality to delete a property
    }
}
