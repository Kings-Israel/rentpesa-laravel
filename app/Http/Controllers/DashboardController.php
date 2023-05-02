<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $role = auth()->user()->getRoleNames()[0];
    $properties = [];
    $occupied_units = [];
    $units = [];
    $occupied_units_percentage = 0;
    switch ($role):
      case 'admin':
        $properties = Property::all();
        foreach ($properties as $property) {
          foreach ($property->units as $unit) {
            array_push($units, $unit);
            if ($unit->isOccuppied()) {
              array_push($occupied_units, $unit);
            }
          }
        }
        $occupied_units_percentage = count($occupied_units) / count($units) * 100;
        break;
      case 'landlord':
        $properties = auth()->user()->properties;
        $properties = Property::all();
        foreach ($properties as $property) {
          foreach ($property->units as $unit) {
            array_push($units, $unit);
            if ($unit->isOccuppied()) {
              array_push($occupied_units, $unit);
            }
          }
        }
        $occupied_units_percentage = (count($occupied_units) / count($units)) * 100;
        break;
      case 'tenant':
        // TODO: Add functionality to get tenant assigned property
        break;
      case 'agent':
        // TODO: Add functionality to get agent property assigned by landlord
        break;
      default:
        $properties = [];
        break;
    endswitch;

    return view('content.dashboard', compact('properties', 'occupied_units', 'units', 'occupied_units_percentage'));
  }
}
