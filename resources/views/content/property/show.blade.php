@extends('layouts/layoutMaster')

@section('title', 'Property')

@section('content')

  <div class="d-flex justify-content-between py-2">
    <div>
      <h4 class="fw-bold mb-2">
        <span class="text-muted fw-light"><a href="{{ route('properties.index') }}">Properties</a> /</span> {{ $property->name }}
      </h4>
    </div>
    <div class="d-flex">
      <div>
        <a href="{{ route('properties.edit', $property) }}" class="btn btn-primary">Edit {{ $property->name }}</a>
      </div>
      <span class="m-1"></span>
      <div>
        <a href="{{ route('properties.create') }}" class="btn btn-outline-secondary">Add New Property</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100">
        <img class="card-img-top" src="{{ url('/storage/cover/'.$property->cover_image) }}" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">{{ $property->name }}</h5>
          <p class="card-text">
            {{ $property->other_details }}
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-8 mb-3">
      <div class="row">
        <div class="col-md-6 col-lg-6">
          <div class="card mb-4">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">County - <strong>{{ $property->county->name }}</strong></li>
              <li class="list-group-item">Subcounty - <strong>{{ $property->subcounty->name }}</strong></li>
              @if($property->nearest_landmark)
                <li class="list-group-item">Nearest Landmark - <strong>{{ $property->nearest_landmark }}</strong></li>
              @endif
              @if($property->address)
                <li class="list-group-item">Address - <strong>{{ $property->address }}</strong></li>
              @endif
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          @if($property->is_active)
            <span class="badge bg-label-success mb-2 w-100">Active</span>
          @else
            <span class="badge bg-label-danger mb-2 w-100">Inactive</span>
          @endif
          <div class="card mb-4" @if(now()->diffInDays(Carbon\Carbon::parse($property->agreement_end_date)) < 90) style="background-color: #821f1f" @endif>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Start of Agreement - <strong>{{ Carbon\Carbon::parse($property->agreement_start_date)->format('d M Y') }}</strong></li>
              <li class="list-group-item">End of Agreement - <strong>{{ Carbon\Carbon::parse($property->agreement_end_date)->format('d M Y') }}</strong></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card">
        <h5 class="card-header">Quote</h5>
        <div class="card-body">
          {{-- TODO: Add Graphs to show occupancy status --}}
          {{-- TODO: Add Table to show units and residents --}}
          <blockquote class="blockquote mb-0">
            <p>
              {!! \Illuminate\Foundation\Inspiring::quote() !!}
            </p>
          </blockquote>
        </div>
      </div>
    </div>
  </div>
@endsection
