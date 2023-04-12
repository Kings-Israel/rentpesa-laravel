@extends('layouts/layoutMaster')

@section('title', 'Add Unit')

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
  <script src="{{asset('assets/js/unit-add-wizard.js')}}"></script>
@endsection

@section('content')
  <h4 class="fw-bold">
    <span class="text-muted fw-light"><a href="{{ route('properties.index') }}">Units</a> /</span> Add Unit
  </h4>
  <!-- Unit Listing Wizard -->
  <div class="card">
    <div class="card-body">
      <form id="wizard-unit-form" method="POST" action="{{ route('units.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Unit Details -->
        <div id="unit-details" class="content">
          <div class="row g-3">
            @if (!$property)
              <div class="col-sm-6">
                <label class="form-label" for="property">Property</label>
                <select id="property_id" name="property_id" class="select2 form-select" data-allow-clear="true">
                  <option value="">Select Property</option>
                  @foreach($properties as $property)
                    <option value="{{ $property->id }}" @if(old('property_id') === $property->id) selected @endif>{{ $property->name }}</option>
                  @endforeach
                </select>
                @error('property_id')
                <span class="text-danger">{{ $message }}</span>
              @enderror
              </div>
            @else
              <input type="hidden" name="property_id" value="{{ $property->id }}">
            @endif
            <div class="col-sm-6">
              <label class="form-label" for="unit_number">Unit Number</label>
              <input type="text" id="unit_number" name="unit_number" class="form-control" placeholder="Enter Unit Number" value="{{ old('unit_number') }}" />
              @error('unit_number')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="unit_type">Unit Type</label>
              <select id="unit_type" name="unit_type_id" class="select2 form-select" data-allow-clear="true">
                <option value="">Select Unit Type</option>
                @foreach($unit_types as $unit_type)
                  <option value="{{ $unit_type->id }}" @if(old('unit_type_id') == $unit_type->id) selected @endif>{{ $unit_type->name }}</option>
                @endforeach
              </select>
              @error('unit_type')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="billing_frequency">Billing Frequency</label>
              <select id="billing_frequency" name="billing_frequency_id" class="select2 form-select" data-allow-clear="true">
                <option value="">Select Billing Frequency</option>
                @foreach($billing_frequencies as $billing_frequency)
                  <option value="{{ $billing_frequency->id }}" @if(old('billing_frequency_id') == $billing_frequency->id) selected @endif>{{ $billing_frequency->name }}</option>
                @endforeach
              </select>
              @error('billing_frequency')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="floor_number">Floor Number</label>
              <input type="text" id="floor_number" name="floor_number" class="form-control" placeholder="Enter Road/Street" value="{{ old('floor_number') }}" />
              @error('floor_number')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="rent">Rent</label>
              <input type="number" id="rent" name="rent" class="form-control" placeholder="10000" value="{{ old('rent') }}" />
              @error('rent')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-lg-6">
              <label class="form-label" for="deposit">Deposit</label>
              <input type="number" id="deposit" name="deposit" class="form-control" placeholder="12" value="{{ old('deposit') }}" />
              @error('deposit')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-12 d-flex justify-content-between mt-4">
              <a href="{{ url()->previous() }}" class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i> <span class="align-middle d-sm-inline-block d-none">Cancel</span> </a>
              <button type="submit" class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Submit</span> <i class="ti ti-arrow-right ti-xs"></i></button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!--/ Property Listing Wizard -->
@endsection
