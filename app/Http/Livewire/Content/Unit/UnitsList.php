<?php

namespace App\Http\Livewire\Content\Unit;

use App\Models\Unit;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class UnitsList extends Component
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

  /**
    * Create paginator for collection.
    *
    * @param array|Collection      $items
    * @param int   $perPage
    * @param int  $page
    * @param array $options
    *
    * @return LengthAwarePaginator
   */
  public function paginate($items, $perPage = 15, $page = null, $options = [])
  {
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

    $items = $items instanceof Collection ? $items : Collection::make($items);

    return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
  }

  public function render()
  {
    if (auth()->user()->userRole() != 'admin') {
        $units = auth()->user()->ownedUnits
                              ->when($this->search && $this->search != '', function($query) {
                                $query->where('unit_number', 'LIKE', '%'.$this->search.'%');
                              });
        $units = $this->paginate($units);
    } else {
        $units = Unit::when($this->search && $this->search != '', function($query) {
                                $query->where('unit_number', 'LIKE', '%'.$this->search.'%');
                              })
                              ->paginate();
    }

    return view('livewire.content.unit.units-list', compact('units'));
  }
}
