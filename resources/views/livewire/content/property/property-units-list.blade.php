<div class="card">
  <div class="card-body">
    <h4 class="fw-bold py-1 mb-2">
      <span class="text-muted fw-light">Units</span>
    </h4>
    <div class="d-flex justify-content-between py-1 mb-2">
      <div class="d-flex">
        <div class="mx-1">
          <input class="form-control" name="search" wire:model="search" placeholder="Search Units" />
        </div>
      </div>

      <div class="d-flex">
        <div class="mx-1">
          <select class="form-select select2" wire:model="export">
            <option value="">Export</option>
            <option value="csv">CSV</option>
            <option value="excel">Excel</option>
            <option value="pdf">Pdf</option>
          </select>
        </div>
        <div>
          <a href="{{ route('units.create', $property) }}">
            <button class="btn btn-primary">Add Unit</button>
          </a>
        </div>
      </div>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
        <tr>
          <th>Unit Number</th>
          <th>Date Added</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach($units as $unit)
          <tr>
            <td>
              <strong>{{ $unit->unit_number }}</strong>
            </td>
            <td>{{ $unit->created_at->format('d M Y') }}</td>
            <td>Vacant/Occupied</td>
            <td>
              <a href="{{route('units.edit', $unit)}}" class="text-white btn btn-secondary btn-sm">Edit</a>
              <a href="{{route('units.show', $unit)}}" class="text-white btn btn-info btn-sm">Assign</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <div class="mx-2 my-1 float-end">
      {{ $units->links() }}
    </div>
  </div>
</div>

