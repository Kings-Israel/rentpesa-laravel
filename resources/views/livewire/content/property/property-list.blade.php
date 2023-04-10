<div>
  <h4 class="fw-bold py-1 mb-2">
    <span class="text-muted fw-light">My Properties</span>
  </h4>
  <div class="d-flex justify-content-between py-1 mb-2">
    <div class="d-flex">
      <div class="mx-1">
        <input class="form-control" name="search" wire:model="search" placeholder="Search Properties" />
      </div>
      <div class="mx-1">
        <select class="form-select select2" wire:model="status">
          <option value="">Select Status</option>
          <option value="1">Active</option>
          <option value="false">Inactive</option>
        </select>
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
        <a href="{{ route('properties.create') }}">
          <button class="btn btn-primary">Add Property</button>
        </a>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
        <tr>
          <th>Name</th>
          <th>Date Added</th>
          <th>Agreement Start Date</th>
          <th>Agreement End Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach($properties as $property)
          <tr>
            <td>
              <strong>{{ $property->name }}</strong>
            </td>
            <td>{{ $property->created_at->format('d M Y') }}</td>
            <td>
              {{ Carbon\Carbon::parse($property->agreement_start_date)->format('d M Y') }}
            </td>
            <td>
              {{ Carbon\Carbon::parse($property->agreement_end_date)->format('d M Y') }}
            </td>
            <td>
              @if($property->is_active)
                <span class="badge bg-label-success me-1">Active</span>
              @else
                <span class="badge bg-label-danger me-1">Inactive</span>
              @endif
            </td>
            <td>
              <button class="btn btn-primary btn-sm">
                <a href="{{ route('properties.show', $property) }}" class="text-white">View</a>
              </button>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="mx-2 my-1 float-end">
    {{ $properties->links() }}
  </div>
</div>
