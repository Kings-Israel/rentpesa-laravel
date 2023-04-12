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
                    <label class="form-check-label custom-option-content" for="customRadioBuilder">
                    <span class="custom-option-body">
                      <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.75 33.75V6.25C22.75 5.91848 22.6183 5.60054 22.3839 5.36612C22.1495 5.1317 21.8315 5 21.5 5H6.5C6.16848 5 5.85054 5.1317 5.61612 5.36612C5.3817 5.60054 5.25 5.91848 5.25 6.25V33.75" fill="currentColor" fill-opacity="0.2" />
                        <path d="M2.75 32.75C2.19772 32.75 1.75 33.1977 1.75 33.75C1.75 34.3023 2.19772 34.75 2.75 34.75V32.75ZM37.75 34.75C38.3023 34.75 38.75 34.3023 38.75 33.75C38.75 33.1977 38.3023 32.75 37.75 32.75V34.75ZM21.75 33.75C21.75 34.3023 22.1977 34.75 22.75 34.75C23.3023 34.75 23.75 34.3023 23.75 33.75H21.75ZM21.5 5V4V5ZM5.25 6.25H4.25H5.25ZM4.25 33.75C4.25 34.3023 4.69772 34.75 5.25 34.75C5.80228 34.75 6.25 34.3023 6.25 33.75H4.25ZM34.25 33.75C34.25 34.3023 34.6977 34.75 35.25 34.75C35.8023 34.75 36.25 34.3023 36.25 33.75H34.25ZM22.75 14C22.1977 14 21.75 14.4477 21.75 15C21.75 15.5523 22.1977 16 22.75 16V14ZM10.25 10.25C9.69772 10.25 9.25 10.6977 9.25 11.25C9.25 11.8023 9.69772 12.25 10.25 12.25V10.25ZM15.25 12.25C15.8023 12.25 16.25 11.8023 16.25 11.25C16.25 10.6977 15.8023 10.25 15.25 10.25V12.25ZM12.75 20.25C12.1977 20.25 11.75 20.6977 11.75 21.25C11.75 21.8023 12.1977 22.25 12.75 22.25V20.25ZM17.75 22.25C18.3023 22.25 18.75 21.8023 18.75 21.25C18.75 20.6977 18.3023 20.25 17.75 20.25V22.25ZM10.25 26.5C9.69772 26.5 9.25 26.9477 9.25 27.5C9.25 28.0523 9.69772 28.5 10.25 28.5V26.5ZM15.25 28.5C15.8023 28.5 16.25 28.0523 16.25 27.5C16.25 26.9477 15.8023 26.5 15.25 26.5V28.5ZM27.75 26.5C27.1977 26.5 26.75 26.9477 26.75 27.5C26.75 28.0523 27.1977 28.5 27.75 28.5V26.5ZM30.25 28.5C30.8023 28.5 31.25 28.0523 31.25 27.5C31.25 26.9477 30.8023 26.5 30.25 26.5V28.5ZM27.75 20.25C27.1977 20.25 26.75 20.6977 26.75 21.25C26.75 21.8023 27.1977 22.25 27.75 22.25V20.25ZM30.25 22.25C30.8023 22.25 31.25 21.8023 31.25 21.25C31.25 20.6977 30.8023 20.25 30.25 20.25V22.25ZM2.75 34.75H37.75V32.75H2.75V34.75ZM23.75 33.75V6.25H21.75V33.75H23.75ZM23.75 6.25C23.75 5.65326 23.5129 5.08097 23.091 4.65901L21.6768 6.07322C21.7237 6.12011 21.75 6.18369 21.75 6.25H23.75ZM23.091 4.65901C22.669 4.23705 22.0967 4 21.5 4V6C21.5663 6 21.6299 6.02634 21.6768 6.07322L23.091 4.65901ZM21.5 4H6.5V6H21.5V4ZM6.5 4C5.90326 4 5.33097 4.23705 4.90901 4.65901L6.32322 6.07322C6.37011 6.02634 6.4337 6 6.5 6V4ZM4.90901 4.65901C4.48705 5.08097 4.25 5.65326 4.25 6.25H6.25C6.25 6.1837 6.27634 6.12011 6.32322 6.07322L4.90901 4.65901ZM4.25 6.25V33.75H6.25V6.25H4.25ZM36.25 33.75V16.25H34.25V33.75H36.25ZM36.25 16.25C36.25 15.6533 36.013 15.081 35.591 14.659L34.1768 16.0732C34.2237 16.1201 34.25 16.1837 34.25 16.25H36.25ZM35.591 14.659C35.169 14.2371 34.5967 14 34 14V16C34.0663 16 34.1299 16.0263 34.1768 16.0732L35.591 14.659ZM34 14H22.75V16H34V14ZM10.25 12.25H15.25V10.25H10.25V12.25ZM12.75 22.25H17.75V20.25H12.75V22.25ZM10.25 28.5H15.25V26.5H10.25V28.5ZM27.75 28.5H30.25V26.5H27.75V28.5ZM27.75 22.25H30.25V20.25H27.75V22.25Z" fill="currentColor" />
                      </svg>

                      <span class="custom-option-title">I am the Builder</span>
                      <small>List property as Builder, list your project and get highest reach.</small>
                    </span>
                      <input name="plUserType" class="form-check-input" type="radio" value="1" id="customRadioBuilder" checked />
                    </label>
                  </div>
                </div>
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
                      <input name="plUserType" class="form-check-input" type="radio" value="2" id="customRadioOwner" />
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
                      <input name="plUserType" class="form-check-input" type="radio" value="3" id="customRadioBroker" />
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="plFirstName">First Name</label>
              <input type="text" id="plFirstName" name="plFirstName" class="form-control" placeholder="John" />
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="plLastName">Last Name</label>
              <input type="text" id="plLastName" name="plLastName" class="form-control" placeholder="Doe" />
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="plUserName">Username</label>
              <input type="text" id="plUserName" name="plUserName" class="form-control" placeholder="john.doe" />
            </div>
            <div class="col-sm-6 form-password-toggle">
              <label class="form-label" for="plPassWord">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="plPassWord" class="form-control" name="plPassWord" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="passwordToggler" />
                <span id="passwordToggler" class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="plEmail">Email</label>
              <input type="text" id="plEmail" name="plEmail" class="form-control" placeholder="john.doe@example.com" />
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="plContact">Contact</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text">US (+1)</span>
                <input type="text" id="plContact" name="plContact" class="form-control contact-number-mask" placeholder="202 555 0111" />
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
