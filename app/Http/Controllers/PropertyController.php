<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Resources\PropertiesResource;
use App\Jobs\StoreImage;
use App\Models\County;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use MongoDB\Driver\Session;

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

        // Flash message
        toastr()->success('', 'Property created');

        return view('content.property.show', compact('property'));
    }

    public function show(Property $property)
    {
        return view('content.property.show', compact('property'));
    }

    public function edit(Property $property)
    {
        $property_types = PropertyType::all();
        $counties = County::with('subcounties')->get();
        $subcounties = County::with('subcounties')->find($property->county_id)->subcounties;

        return view('content.property.edit', compact('property', 'property_types', 'counties', 'subcounties'));
    }

    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $property->update([
            'property_type_id' => $request->plPropertyType,
            'name' => $request->plName,
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

        if($request->hasFile('cover')) {
          Storage::disk('property')->delete('cover/'.$property->cover_image);
          $property->update([
            'cover_image' => pathinfo($request->plCoverImage->store('cover', 'property'), PATHINFO_BASENAME)
          ]);
        }

        // Flash message
        toastr()->success('', 'Property updated');

        return view('content.property.show', compact('property'));
    }

    public function destroy(Property $property)
    {
        // TODO: Add functionality to delete a property
    }
}
