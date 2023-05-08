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
    $vacant_units_percentage = 0;
    // Total Units Value
    $total_units_value = 0;
    switch ($role):
      case 'admin':
        $properties = Property::all();
        foreach ($properties as $property) {
          foreach ($property->units as $unit) {
            array_push($units, $unit);
            $total_units_value += $unit->rent;
            if ($unit->isOccuppied()) {
              array_push($occupied_units, $unit);
            }
          }
        }
        // Occupied Units Percentage
        $occupied_units_percentage = (count($occupied_units) / count($units)) * 100;
        $vacant_units_percentage = 100 - $occupied_units_percentage;
        // Occupied Units Value
        $occupied_units_value = 0;
        foreach ($occupied_units as $occupied_unit) {
          $occupied_units_value += $occupied_unit->rent;
        }
        // Vacant Units Value
        $vacant_units_value = $total_units_value - $occupied_units_value;
        break;
      case 'landlord':
        // Landlord Properties
        $properties = auth()->user()->properties;
        // Units and Occupied Units
        foreach ($properties as $property) {
          foreach ($property->units as $unit) {
            array_push($units, $unit);
            $total_units_value += $unit->rent;
            if ($unit->isOccuppied()) {
              array_push($occupied_units, $unit);
            }
          }
        }
        if (count($occupied_units) > 0 && count($units) > 0) {
          // Occupied Units Percentage
          $occupied_units_percentage = (int)((count($occupied_units) / count($units)) * 100);
          $vacant_units_percentage = 100 - $occupied_units_percentage;
          // Occupied Units Value
        }
        $occupied_units_value = 0;
        foreach ($occupied_units as $occupied_unit) {
          $occupied_units_value += $occupied_unit->rent;
        }
        // Vacant Units Value
        $vacant_units_value = $total_units_value - $occupied_units_value;
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

    return view('content.dashboard', compact('properties', 'occupied_units', 'units', 'occupied_units_percentage', 'vacant_units_percentage', 'total_units_value', 'occupied_units_value', 'vacant_units_value'));
  }
}
