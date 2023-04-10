<?php

namespace App\Http\Livewire\Content\Property;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $status;
    public $export;

    public function updatingSearch()
    {
      $this->resetPage();
    }

    public function updatingStatus()
    {
      $this->resetPage();
    }

    public function updatedExport()
    {
      if ($this->export != '') {
        // TODO: Add export functionality (CSV, PDF and Excel)
      }
    }

    public function render()
    {
        if (auth()->user()->userRole() != 'admin') {
            $properties = Property::where('user_id', auth()->id())
                                  ->when($this->search && $this->search != '', function($query) {
                                    $query->where('name', 'LIKE', '%'.$this->search.'%');
                                  })
                                  ->when($this->status && $this->status != '', function($query) {
                                    $query->where('is_active', $this->status);
                                  })
                                  ->paginate();
        } else {
            $properties = Property::when($this->search && $this->search != '', function($query) {
                                    $query->where('name', 'LIKE', '%'.$this->search.'%');
                                  })
                                  ->when($this->status && $this->status != '', function($query) {
                                    $query->where('is_active', $this->status);
                                  })
                                  ->paginate();
        }

        return view('livewire.content.property.property-list', compact('properties'));
    }
}
