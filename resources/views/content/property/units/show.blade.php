@extends('layouts/layoutMaster')

@section('title', 'Unit')

@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
@endsection

@section('page-script')
  <script src="{{asset('assets/js/unit-assign-wizard.js')}}"></script>
@endsection

@section('content')
  <div class="d-flex justify-content-between py-2">
    <div>
      <h4 class="fw-bold mb-2">
        <span class="text-muted fw-light">
          <a href="{{ route('properties.index') }}">Properties</a> /
          <a class="text-bold" href="{{ route('properties.show', $unit->property) }}">{{ $unit->property->name }}</a>
          / Units
          /
        </span>
        {{ $unit->unit_number }}
      </h4>
    </div>
    <div class="d-flex">
      <div>
        <a href="{{ route('units.edit', $unit) }}" class="btn btn-primary">Edit {{ $unit->unit_number }}</a>
      </div>
      <span class="m-1"></span>
      <div>
        <a href="{{ route('units.create', $unit->property) }}" class="btn btn-outline-secondary">Add New Unit</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-lg-4 mb-3">
      @if($unit->property->is_active)
        <span class="badge bg-label-success mb-2 w-100">Active</span>
      @else
        <span class="badge bg-label-danger mb-2 w-100">Inactive</span>
      @endif
      <div class="card">
        <img class="card-img-top" src="{{ url('/storage/property/cover/'.$unit->property->cover_image) }}" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">{{ $unit->property->name }}</h5>
          <p class="card-text">
            {{ $unit->property->other_details }}
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-8 mb-3">
      @if ($unit->isOccuppied())
        <span class="badge bg-label-success mb-2 w-100">Occupied</span>
      @else
        <span class="badge bg-label-danger mb-2 w-100">Vacant</span>
      @endif
      <div class="card mb-2">
        <div class="card-body">
          @if (!$unit->isOccuppied())
            <h4 class="fw-bold py-1 mb-2">
              <span class="text-muted fw-light">Assign Unit</span>
            </h4>
            <form id="wizard-unit-form" method="POST" action="{{ route('unit.assign') }}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="unit_id" value="{{ $unit->id }}">
              <div class="row g-3">
                <div class="col-sm-12">
                  <label class="form-label" for="user">Tenant</label>
                  <select id="user_id" name="user_id" class="select2 form-select" data-allow-clear="true">
                    <option value="">Select tenant</option>
                    @foreach($users as $user)
                      <option value="{{ $user->id }}" @if(old('user_id') === $user->id) selected @endif>{{ $user->name }}</option>
                    @endforeach
                  </select>
                  @error('user_id')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label class="form-label d-block" for="lease_start_date">Start Date</label>
                  <input type="date" id="lease_start_date" name="lease_start_date" class="form-control" value="{!! old('lease_start_date') !!}" />
                  @error('lease_start_date')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="lease_end_date">End Date</label>
                  <input type="date" id="lease_end_date" name="lease_end_date" class="form-control" value="{{ old('lease_end_date') }}" />
                  @error('lease_end_date')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-lg-12">
                  <label class="form-label" for="remarks">Remarks</label>
                  <textarea id="remarks" name="remarks" class="form-control" rows="2">{{ old('remarks') }}</textarea>
                  @error('remarks')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-12 d-flex justify-content-between mt-4">
                  <a href="{{ route('properties.show', $unit->property) }}" class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i> <span class="align-middle d-sm-inline-block d-none">Cancel</span> </a>
                  <button type="submit" class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Assign</span> <i class="ti ti-arrow-right ti-xs"></i></button>
                </div>
              </div>
            </form>
          @else
            <h4 class="fw-bold py-1 mb-2">
              <span class="text-muted fw-light">Current Tenant</span>
            </h4>
            <div class="row">
              <div class="col-md-6">
                <h5>Name: <strong>{{ $unit->currentTenant()->user->name }}</strong></h5>
                <h6>Email: <strong>{{ $unit->currentTenant()->user->email }}</strong></h6>
                <h6>Phone Number: <strong>{{ $unit->currentTenant()->user->phone_number }}</strong></h6>
              </div>
              <div class="col-md-6">
                <h6>Lease Start on: <strong>{{ Carbon\Carbon::parse($unit->currentTenant()->lease_start_date)->format('d M Y') }}</strong></h6>
                <h6>Lease Ends on: <strong>{{ Carbon\Carbon::parse($unit->currentTenant()->lease_end_date)->format('d M Y') }}</strong></h6>
                <span class="text-muted">{{ $unit->currentTenant()->remarks }}</span>
              </div>
            </div>
          @endif
        </div>
      </div>
      <livewire:content.property.unit.unit-previous-tenants-list :unit="$unit" />
      {{-- TODO: Show unit inquiries --}}
    </div>
  </div>
@endsection
