@extends('layouts/layoutMaster')

@section('title', 'DataTables - Advanced Tables')

@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
  <!-- Flat Picker -->
  <script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>

@endsection

@section('page-script')
  {{--  <script src="{{asset('assets/js/tables-datatables-advanced.js')}}"></script>--}}
  <script>
    var dt_ajax_table = $('.datatables-ajax')
    if (dt_ajax_table.length) {
      var dt_ajax = dt_ajax_table.dataTable({
        processing: true,
        ajax: assetsPath + 'json/ajax.php',
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
      });
    }
  </script>
@endsection

@section('content')
  <div class="d-flex justify-content-between">
    <h4 class="fw-bold py-1 mb-2">
      <span class="text-muted fw-light">My Properties</span>
    </h4>
    <a href="{{ route('properties.create') }}">
      <button class="btn btn-primary">Add Property</button>
    </a>
  </div>

  <!-- Ajax Sourced Server-side -->
  <div class="card">
    {{--    <h5 class="card-header">Ajax Sourced Server-side</h5>--}}
    <div class="card-datatable text-nowrap">
      <table class="datatables-ajax table">
        <thead>
        <tr>
          <th>Full name</th>
          <th>Email</th>
          <th>Position</th>
          <th>Office</th>
          <th>Start date</th>
          <th>Salary</th>
        </tr>
        </thead>
      </table>
    </div>
  </div>
  <!--/ Ajax Sourced Server-side -->

@endsection
