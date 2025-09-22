@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <a href="{{ route('dealers.index') }}" type="button" class="btn btn-danger"
                        style="float: right;">Back</a>
                </div>

                <form id="DealerForm" method="POST"
                    action="{{ route('dealers.storeOrUpdate', isset($dealer) ? $dealer->id : '') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="dealerEditId" id="dealerEditId"
                        value="{{ isset($dealer) ? $dealer->id : '' }}">
                    
                    <div class="card-body">
                        <div class="row">

                            {{-- Dealer Name --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Dealer Name <span class="text-danger">*</span></label>
                                    <input type="text" name="dealer_name" class="form-control"
                                        placeholder="Enter Dealer Name"
                                        value="{{ old('dealer_name', isset($dealer) ? $dealer->name : '') }}" required>
                                        <span class="text-danger">{{ $errors->first('dealer_name') }}</span>
                                </div>
                            </div>

                            {{-- Contact Person --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Contact Person Name <span class="text-danger">*</span></label>
                                    <input type="text" name="contact_person" class="form-control"
                                        placeholder="Enter Contact Person"
                                        value="{{ old('contact_person',  isset($dealer) ? $dealer->metaValue('contact_person') : '') }}" required>
                                        <span class="text-danger">{{ $errors->first('contact_person') }}</span>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Enter Email"
                                        value="{{ old('email', isset($dealer) ? $dealer->email : '') }}" required>
                                         <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                               
                            </div>

                            {{-- Mobile --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Mobile Number <span class="text-danger">*</span></label>
                                    <input type="text" name="mobile" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                         class="form-control"
                                        placeholder="Enter Mobile"
                                        value="{{ old('mobile', isset($dealer) ? $dealer->mobile : '') }}" required>
                                         <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                </div>
                            </div>

                            {{-- Alternate Phone --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Alternate Phone</label>
                                    <input type="text" name="alternate_phone" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                         class="form-control"
                                        placeholder="Enter Alternate Phone"
                                        value="{{ old('alternate_phone', isset($dealer) ? $dealer->metaValue('alternate_phone') : '') }}">
                                </div>
                            </div>

                            {{-- Password --}}
                            


                             <div class="col-lg-4 col-sm-4">
              <div class="form-group">
                <label for="enablePasswordEdit">
                  <input type="checkbox" id="enablePasswordEdit" onchange="toggleShowPassword('Edit')"> Set Password
                </label>
                <label for="passwordEdit">Password <span class="required">{{ isset($dealer) ? '' : '*' }}</span></label>
                <div style="position: relative;">
                  <input type="password" class="form-control pr-5" id="passwordEdit" name="password" maxlength="15"
                    placeholder="Password" {{ isset($dealer) ? 'disabled' : '' }}>
                  <span onclick="togglePassword('Edit')" id="toggleIconEdit" class="eye-icon">👁️</span>
                </div>
              </div>
            </div>

                            {{-- Dealership Name --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Dealership Name <span class="text-danger">*</span></label>
                                    <input type="text" name="dealership_name" class="form-control"
                                        placeholder="Enter Dealership Name"
                                        value="{{ old('dealership_name', isset($dealer) ? $dealer->metaValue('dealership_name') : '') }}" required>
                                         <span class="text-danger">{{ $errors->first('dealership_name') }}</span>
                                </div>
                            </div>

                            {{-- Dealer Code --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Dealer Code</label>
                                    <input type="text" name="dealer_code" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                        maxlength="6" class="form-control"
                                        placeholder="Enter Dealer Code"
                                        value="{{ old('dealer_code',  isset($dealer) ? $dealer->metaValue('dealer_code') : '') }}">
                                           <span class="text-danger">{{ $errors->first('dealer_code') }}</span>
                                </div>
                            </div>

                            {{-- Dealer Type --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Dealer Type <span class="text-danger">*</span></label>
                                    <select name="dealer_type" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        <option value="new" {{ old('dealer_type', isset($dealer) ? $dealer->dealer_type : '')=='new' ? 'selected' : '' }}>New Car</option>
                                        <option value="used" {{ old('dealer_type', isset($dealer) ?  $dealer->dealer_type : '')=='used' ? 'selected' : '' }}>Used Car</option>
                                        <option value="both" {{ old('dealer_type', isset($dealer) ?  $dealer->dealer_type : '')=='both' ? 'selected' : '' }}>Both</option>
                                    </select>
                                      <span class="text-danger">{{ $errors->first('dealer_type') }}</span>
                                </div>
                            </div>

                            {{-- Address --}}
                            <div class="col-lg-8 col-sm-8">
                                <div class="form-group">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control"
                                        placeholder="Enter Address"
                                        value="{{ old('address', isset($dealer) ? $dealer->address : '') }}" required>
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                </div>
                            </div>

                            

                            {{-- City --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>City <span class="text-danger">*</span></label>
                                     <select name="city" class="form-control" required>
            <option value="">-- Select City --</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}" {{ old('city', isset($dealer) ? $dealer->city : '') == $city->id ? 'selected' : '' }}>
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
                                          <span class="text-danger">{{ $errors->first('city') }}</span>
                                </div>
                            </div>

                           

                            {{-- Pincode --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Pincode <span class="text-danger">*</span></label>
                                    <input type="text" name="pincode" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                          class="form-control"
                                        placeholder="Enter Pincode"
                                        value="{{ old('pincode', isset($dealer) ? $dealer->pincode : '') }}" required>
                                         <span class="text-danger">{{ $errors->first('pincode') }}</span>
                                </div>
                            </div>

                            {{-- Business Info --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Established Year</label>
                                    <input type="text" maxlength="4" name="established_year" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                          class="form-control"
                                        placeholder="Year"
                                        value="{{ old('established_year', isset($dealer) ? $dealer->metaValue('established_year') : '') }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>No. of Employees</label>
                                    <input type="text" name="employees" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                        maxlength="5"  class="form-control"
                                        placeholder="No. of Employees"
                                        value="{{ old('employees', isset($dealer) ? $dealer->metaValue('employees') : '') }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Monthly Car Sales Capacity</label>
                                    <input type="number" name="monthly_sales" class="form-control"
                                        placeholder="Monthly Sales"
                                        value="{{ old('monthly_sales', isset($dealer) ? $dealer->metaValue('monthly_sales') : '') }}">
                                </div>
                            </div>

                            {{-- File Uploads --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Dealer Logo</label>
                                    <input type="file" class="form-control-file" name="dealer_logo">
                                    @if(isset($dealer) && $dealer->profile_image)
                                        <img src="{{ asset('storage/'.$dealer->profile_image) }}" width="100" class="mt-2">
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Trade License / RERA Certificate</label>
                                    <input type="file" class="form-control-file" name="trade_license">
                                    @if(isset($dealer) && $dealer->metaValue('trade_license'))
                                        <a href="{{ asset('storage/'.$dealer->metaValue('trade_license')) }}" target="_blank" class="mt-2">View File</a>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>PAN Card</label>
                                    <input type="file" class="form-control-file" name="pan_card">
                                    @if(isset($dealer) && $dealer->id_proof)
                                        <a href="{{ asset('storage/'.$dealer->id_proof) }}" target="_blank" class="mt-2">View File</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <a href="{{ route('dealers.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check-circle"></i> {{ isset($dealer) ? 'Update Dealer' : 'Add Dealer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
