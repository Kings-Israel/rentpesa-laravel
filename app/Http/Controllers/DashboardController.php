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
    switch ($role):
      case 'admin':
        $properties = Property::all();
        break;
      case 'landlord':
        $properties = auth()->user()->properties;
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

    return view('content.dashboard', compact('properties'));
  }
}
