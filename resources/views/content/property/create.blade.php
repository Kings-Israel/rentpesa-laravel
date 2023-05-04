@extends('layouts/layoutMaster')

@section('title', 'Add Property')

@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection

@section('page-script')
  <script src="{{asset('assets/js/property-add-wizard.js')}}"></script>
  <script>
    function getSubcounties() {
      let subcounties = $('#plPropertyCounty').find(':selected').data('subcounties')
      let subcountyOptions = document.getElementById('plPropertySubcounty')
      while (subcountyOptions.options.length) {
        subcountyOptions.remove(0);
      }
      if (subcounties) {
        var i;
        for (i = 0; i < subcounties.length; i++) {
          var subcounty = new Option(subcounties[i].name, subcounties[i].id);
          subcountyOptions.options.add(subcounty);
        }
      }
    }
    let user = {!! json_encode(auth()->user()) !!}
    $('#plPropertyFirstName').val(user.name)
    $('#plPropertyLastName').val(user.name)
    $('#plPropertyEmail').val(user.email)
    $('#plPropertyContact').val('0707128473')
    $('#password').val('password')
    $('#password_confirmation').val('password')
    $(document).ready(function () {
      let user_type = {!! json_encode(old('plUserType')) !!}
      if (user_type == 1) {
        $('#select-landlord-section').attr('hidden', 'hidden');
      } else if (user_type == 2) {
        $('#select-landlord-section').removeAttr('hidden');
      }
    })
    function changeLandlord(value) {
      if (value === 2) {
        $('#plPropertyFirstName').val('')
        $('#plPropertyLastName').val('')
        $('#plPropertyEmail').val('')
        $('#plPropertyContact').val('')
        $('#password').val('')
        $('#password_confirmation').val('')
        $('#select-landlord-section').removeAttr('hidden');
      } else {
        $('#select-landlord-section').attr('hidden', 'hidden');
        $('#plPropertyFirstName').val(user.name)
        $('#plPropertyLastName').val(user.name)
        $('#plPropertyEmail').val(user.email)
        $('#plPropertyContact').val('0707128473')
        $('#password').val('password')
        $('#password_confirmation').val('password')
      }
    }
  </script>
@endsection

@section('content')
  <h4 class="fw-bold">
    <span class="text-muted fw-light"><a href="{{ route('properties.index') }}">Properties</a> /</span> Add Property
  </h4>
  <!-- Property Listing Wizard -->
  <div id="wizard-property-listing" class="bs-stepper wizard">
    <div class="bs-stepper-header">
      @role('admin')
      <div class="step" data-target="#landlord-details">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-circle"><i class="ti ti-users ti-sm"></i></span>
          <span class="bs-stepper-label">
            <span class="bs-stepper-title">Landlord Details</span>
          </span>
        </button>
      </div>
      <div class="line"></div>
      @endrole
      <div class="step" data-target="#property-details">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-circle"><i class="ti ti-home ti-sm"></i></span>
          <span class="bs-stepper-label">
          <span class="bs-stepper-title">Property Details</span>
        </span>
        </button>
      </div>
      <div class="line"></div>
      <div class="step" data-target="#agreement-details">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-circle"><i class="ti ti-bookmarks ti-sm"></i></span>
          <span class="bs-stepper-label">
          <span class="bs-stepper-title">Agreement Details</span>
        </span>
        </button>
      </div>
    </div>
    <div class="bs-stepper-content">
      <form id="wizard-property-listing-form" method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
        @csrf
        @role('admin')
        <!-- Landlord Details -->
        <div id="landlord-details" class="content">
          <div class="row g-3">
            <div class="col-12">
              <div class="row pb-2">
                <div class="col-md mb-md-0 mb-2">
                  <div class="form-check custom-option custom-option-icon">
                    <label class="form-check-label custom-option-content" for="customRadioOwner">
                      <span class="custom-option-body">
                        <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M29 6.25H20.25L12.5781 16.25L20.25 35L37.75 16.25L29 6.25Z" fill="currentColor" fill-opacity="0.2" />
                          <path d="M11.5 6.25H29L37.75 16.25L20.25 35L2.75 16.25L11.5 6.25Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0434 5.64131C20.8542 5.39462 20.5609 5.25 20.25 5.25C19.9391 5.25 19.6458 5.39462 19.4566 5.64131L12.0849 15.25H2.75C2.19772 15.25 1.75 15.6977 1.75 16.25C1.75 16.8023 2.19772 17.25 2.75 17.25H11.9068L19.3245 35.3787C19.4782 35.7545 19.844 36 20.25 36C20.656 36 21.0218 35.7545 21.1755 35.3787L28.5932 17.25H37.75C38.3023 17.25 38.75 16.8023 38.75 16.25C38.75 15.6977 38.3023 15.25 37.75 15.25H28.4151L21.0434 5.64131ZM25.8943 15.25L20.25 7.89287L14.6057 15.25H25.8943ZM14.0678 17.25L20.25 32.3593L26.4322 17.25H14.0678Z" fill="currentColor" />
                        </svg>
                        <span class="custom-option-title"> I am the Owner </span>
                        <small>Submit property as an Individual. Lease, Rent or Sell at the best price.</small>
                      </span>
                      <input name="plUserType" class="form-check-input" type="radio" value="1" id="customRadioOwner" {{ (old('plUserType') == 1 || old('plUserType') == '') ? 'checked' : '' }} onchange="changeLandlord(1)" />
                    </label>
                  </div>
                </div>
                <div class="col-md mb-md-0 mb-2">
                  <div class="form-check custom-option custom-option-icon">
                    <label class="form-check-label custom-option-content" for="customRadioBroker">
                      <span class="custom-option-body">
                        <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M14 33.75V11.25H6.5C6.16848 11.25 5.85054 11.3817 5.61612 11.6161C5.3817 11.8505 5.25 12.1685 5.25 12.5V32.5C5.25 32.8315 5.3817 33.1495 5.61612 33.3839C5.85054 33.6183 6.16848 33.75 6.5 33.75H14ZM26.5 33.75V11.25H34C34.3315 11.25 34.6495 11.3817 34.8839 11.6161C35.1183 11.8505 35.25 12.1685 35.25 12.5V32.5C35.25 32.8315 35.1183 33.1495 34.8839 33.3839C34.6495 33.6183 34.3315 33.75 34 33.75H26.5Z" fill="currentColor" fill-opacity="0.2" />
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5 5.25C15.5717 5.25 14.6815 5.61875 14.0251 6.27513C13.3687 6.9315 13 7.82174 13 8.75V10.25H6.5C5.25736 10.25 4.25 11.2574 4.25 12.5V32.5C4.25 33.7426 5.25736 34.75 6.5 34.75H14H26.5H34C35.2426 34.75 36.25 33.7426 36.25 32.5V12.5C36.25 11.2574 35.2426 10.25 34 10.25H27.5V8.75C27.5 7.82174 27.1313 6.9315 26.4749 6.27513C25.8185 5.61875 24.9283 5.25 24 5.25H16.5ZM25.5 10.25V8.75C25.5 8.35218 25.342 7.97064 25.0607 7.68934C24.7794 7.40804 24.3978 7.25 24 7.25H16.5C16.1022 7.25 15.7206 7.40804 15.4393 7.68934C15.158 7.97064 15 8.35218 15 8.75V10.25H25.5ZM15 12.25H25.5V32.75H15V12.25ZM13 12.25H6.5C6.36193 12.25 6.25 12.3619 6.25 12.5V32.5C6.25 32.6381 6.36193 32.75 6.5 32.75H13V12.25ZM27.5 32.75V12.25H34C34.1381 12.25 34.25 12.3619 34.25 12.5V32.5C34.25 32.6381 34.1381 32.75 34 32.75H27.5Z" fill="currentColor" />
                        </svg>
                        <span class="custom-option-title"> I am a Broker </span>
                        <small>Earn highest commission by listing your clients properties at the best price.</small>
                      </span>
                      <input name="plUserType" class="form-check-input" type="radio" value="2" id="customRadioBroker" {{ old('plUserType') == 2 ? 'checked' : '' }} onchange="changeLandlord(2)" />
                    </label>
                  </div>
                </div>
                @error('plUserType')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="col-sm-12" id="select-landlord-section" hidden>
              <label class="form-label" for="plPropertyLandlord">Select Landlord</label>
              <select id="plPropertyLandlord" name="plPropertyLandlord" class="select2 form-select" data-allow-clear="true">
                <option value="">Select Landlord</option>
                @foreach($landlords as $landlord)
                  <option value="{{ $landlord->id }}" @if(old('plPropertyLandlord') == $landlord->id) selected @endif>{{ $landlord->name }}</option>
                @endforeach
              </select>
              @error('plPropertyLandlord')
                <span class="text-danger">{{ $message }}</span>
              @enderror

              <div class="divider my-4">
                <div class="divider-text">or</div>
              </div>

              <h4 class="text-muted">Add New Landlord</h4>
              <div class="row">
                <div class="col-sm-6">
                  <label class="form-label" for="plPropertyFirstName">First Name</label>
                  <input type="text" id="plPropertyFirstName" name="plPropertyFirstName" class="form-control" placeholder="John" value="{{ old('plPropertyFirstName') }}" />
                  @error('plPropertyFirstName')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="plPropertyLastName">Last Name</label>
                  <input type="text" id="plPropertyLastName" name="plPropertyLastName" class="form-control" placeholder="Doe"  value="{{ old('plPropertyLastName') }}"/>
                  @error('plPropertyLastName')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="plPropertyEmail">Email</label>
                  <input type="text" id="plPropertyEmail" name="plPropertyEmail" class="form-control" placeholder="john.doe@example.com" value="{{ old('plPropertyEmail') }}" />
                  @error('plPropertyEmail')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="plPropertyContact">Contact</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text">KE (+254)</span>
                    <input type="text" id="plPropertyContact" name="plPropertyContact" class="form-control contact-number-mask" placeholder="202 555 0111" value="{{ old('plPropertyContact') }}" />
                    @error('plContactContact')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-sm-6 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="passwordToggler" />
                    <span id="passwordToggler" class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                  @error('password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-sm-6 form-password-toggle">
                  <label class="form-label" for="ConfirmPassword">Confirm Password</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="passwordToggler" />
                    <span id="passwordToggler" class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                  @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-12 d-flex justify-content-between mt-4">
              <button class="btn btn-label-secondary btn-prev" disabled> <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Previous</span>
              </button>
              <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right ti-xs"></i></button>
            </div>
          </div>
        </div>
        @endrole
        <!-- Property Details -->
        <div id="property-details" class="content">
          <div class="row g-3">
            <div class="col-sm-6">
              <label class="form-label" for="plName">Property Name</label>
              <input type="text" id="plName" name="plName" class="form-control" placeholder="Enter Property Name" value="{{ old('plName') }}" />
              @error('plName')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="plPropertyType">Property Type</label>
              <select id="plPropertyType" name="plPropertyType" class="select2 form-select" data-allow-clear="true">
                <option value="">Select Property Type</option>
                @foreach($property_types as $property_type)
                  <option value="{{ $property_type->id }}" @if(old('plPropertyType') == $property_type->id) selected @endif>{{ $property_type->name }}</option>
                @endforeach
              </select>
              @error('plPropertyType')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="plPropertyCounty">County</label>
              <select id="plPropertyCounty" name="plPropertyCounty" class="select2 form-select" data-allow-clear="true" onchange="getSubcounties()">
                <option value="">Select County</option>
                @foreach($counties as $county)
                  <option value="{{ $county->id }}" @if(old('plPropertyCounty') == $county->id) selected @endif data-subcounties="{{ $county->subcounties }}">{{ $county->name }}</option>
                @endforeach
              </select>
              @error('plPropertyCounty')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="plPropertySubcounty">Sub-county</label>
              <select id="plPropertySubcounty" name="plPropertySubcounty" class="select2 form-select" data-allow-clear="true">
                <option value="">Select Sub county</option>
              </select>
              @error('plPropertySubCounty')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="plStreet">Road/Street</label>
              <input type="text" id="plPropertyStreet" name="plPropertyStreet" class="form-control" placeholder="Enter Road/Street" value="{{ old('plPropertyStreet') }}" />
              @error('plStreet')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="plLandmark">Nearest Landmark</label>
              <input type="text" id="plNearestLandmark" name="plNearestLandmark" class="form-control" placeholder="Nr. Hard Rock Cafe" value="{{ old('plNearestLandmark') }}" />
              @error('plNearestLandmark')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-lg-12">
              <label class="form-label" for="plAddress">Address</label>
              <textarea id="plAddress" name="plPropertyAddress" class="form-control" rows="2" placeholder="12, Business Park">{{ old('plPropertyAddress') }}</textarea>
              @error('plPropertyAddress')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-12 d-flex justify-content-between mt-4">
              <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button>
              <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right ti-xs"></i></button>
            </div>
          </div>
        </div>

        <!-- Agreement Details -->
        <div id="agreement-details" class="content">
          <div class="row g-3">
            <div class="col-sm-6">
              <label class="form-label d-block" for="plAgreementStartDate">Agreement Start Date</label>
              <input type="date" id="plAgreementStartDate" name="plAgreementStartDate" class="form-control" value="{{ old('plAgreementStartDate') }}" />
              @error('plAgreementStartDate')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="plAgreementEndDate">Agreement End Date</label>
              <input type="date" id="plAgreementEndDate" name="plAgreementEndDate" class="form-control" value="{{ old('plAgreementEndDate') }}" />
              @error('plAgreementEndDate')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-sm-6">
              <label class="form-label d-block" for="plRentPaymentDay">Rent Payment Day</label>
              <select id="plRentPaymentDay" name="plRentPaymentDay" class="select2 form-select" data-allow-clear="true">
                <option value="">Select</option>
                @php
                  $locale = 'en_US';
                  $nf = new NumberFormatter($locale, NumberFormatter::ORDINAL);
                @endphp
                @for($i = 1; $i <= 31; $i++)
                  <option value="{{ $nf->format($i).' Day of the Month' }}" @if(old('plRentPaymentDay') === $nf->format($i).' Day of the Month') selected @endif>{{ $nf->format($i) }} Day of the Month</option>
                @endfor
              </select>
              @error('plRentPaymentDay')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="plLatePaymentCharge">Late Payment Charge(%)</label>
              <input type="number" id="plLatePaymentCharge" name="plLatePaymentCharge" class="form-control" placeholder="10" value="{{ old('plLatePaymentCharge') }}" />
              @error('plLatePaymentCharge')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="plCoverImage">Property Image</label>
              <input type="file" id="basic-default-upload-file" name="plCoverImage" accept=".jpg,.jpeg,.png" class="form-control" required />
              @error('plCoverImage')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-lg-12">
              <label class="form-label" for="plOtherDetails">Other Property Details</label>
              <textarea id="plOtherDetails" name="plOtherDetails" class="form-control" rows="2">{{ old('plOtherDetails') }}</textarea>
              @error('plOtherDetails')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-12 d-flex justify-content-between mt-4">
              <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button>
              <button class="btn btn-success btn-submit btn-next"><span class="align-middle d-sm-inline-block d-none me-sm-1">Submit</span><i class="ti ti-check ti-xs"></i></button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!--/ Property Listing Wizard -->
@endsection
