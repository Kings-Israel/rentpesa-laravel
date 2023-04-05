<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;
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

    public function create(): View
    {
        $property_types = PropertyType::all();
        $counties = County::with('subcounties')->get();

        return view('content.property.create', compact('property_types', 'counties'));
    }

    public function store(Request $request)
    {
        // TODO: Add functionality to store a new property
    }

    public function view(Property $property)
    {
        //TODO: Add view for viewing a property
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
