<?php

namespace App\Http\Livewire\Content\Property\Unit;

use App\Models\Unit;
use App\Models\UserUnit;
use Livewire\Component;
use Livewire\WithPagination;

class UnitPreviousTenantsList extends Component
{
  use WithPagination;

  protected $paginationTheme = 'bootstrap';

  public $unit;

  public function mount(Unit $unit)
  {
    $this->unit = $unit;
  }

  public function render()
  {
    $users = UserUnit::with('user', 'unit')->where('unit_id', $this->unit->id)->orderBy('created_at', 'DESC')->paginate();

    return view('livewire.content.property.unit.unit-previous-tenants-list', compact('users'));
  }
}
