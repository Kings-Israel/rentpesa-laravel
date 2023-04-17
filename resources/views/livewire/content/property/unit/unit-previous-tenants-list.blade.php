<div class="card">
  <div class="card-body">
    <h4 class="fw-bold py-1 mb-2">
      <span class="text-muted fw-light">Previous Tenants</span>
    </h4>
    <div class="d-flex justify-content-between py-1 mb-2">
      <div class="d-flex">
        <div class="mx-1">
          <input class="form-control" name="search" wire:model="search" placeholder="Search Tenants" />
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
      </div>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
        <tr>
          <th>Name</th>
          <th>Lease Start</th>
          <th>Lease End</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach($users as $user)
          <tr @if($user->user->email === $user->unit->currentTenant()->user->email) style="background: rgba(0, 255, 0, 0.2);" @endif>
            <td>
              <strong>{{ $user->user->name }}</strong>
            </td>
            <td>{{ Carbon\Carbon::parse($user->lease_start_date)->format('d M Y') }}</td>
            <td>{{ Carbon\Carbon::parse($user->lease_end_date)->format('d M Y') }}</td>
            <td>
              @if (!$unit->isOccuppied())
                <a href="#" class="text-white btn btn-info btn-sm">Assign</a>
              @endif
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <div class="mx-2 my-1 float-end">
      {{ $users->links() }}
    </div>
  </div>
</div>

