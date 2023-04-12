<?php

namespace App\Http\Livewire\Content\Property;

use App\Models\Property;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyUnitsList extends Component
{
  use WithPagination;

  protected $paginationTheme = 'bootstrap';

  public $property;
  public $search;

  public function mount(Property $property)
  {
    $this->property = $property;
  }

  public function updatingSearch()
  {
    $this->resetPage();
  }

  public function render()
  {
    $units = Unit::where('property_id', $this->property->id)
                  ->when($this->search && $this->search != '', function($query) {
                    $query->where('unit_number', 'LIKE', '%'.$this->search.'%');
                  })
                  ->paginate();

    return view('livewire.content.property.property-units-list', compact('units'));
  }
}
