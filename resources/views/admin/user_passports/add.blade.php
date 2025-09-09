@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <a href="{{ route('user-passports.index') }}" type="button" class="btn btn-danger"
                        style="float: right;">Back</a>
                </div>
                <form id="UserPassportForm" method="POST"
                    action="{{ route('user_passports.storeOrUpdate', isset($passport) ? $passport->id : '') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="passportEditId" id="passportEditId"
                        value="{{ isset($userPassport) ? $userPassport->id : '' }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Passport No</label><span class="text-danger">*</span>
                                    <input type="text" name="passport_no" id="passport_no"
                                        class="form-control text-uppercase"
                                        oninput="this.value = this.value.toUpperCase();" minlength="5" maxlength="10"
                                        placeholder="Passport Number"
                                        value="{{ old('passport_no', $userPassport->passport_no ?? '') }}" required>
                                    <span class="passport_no_err text-danger error"></span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Choose RA <span class="text-danger">*</label>
                                    <select class="form-control select2" name="ra_document_id">
                                        <option value="">--Select RA--</option>
                                        @foreach($reSignStamps as $radocument)
                                        <option value="{{ $radocument->id }}" {{ old('ra_document_id', $userPassport->
                                            ra_document_id ?? '') == $radocument->id ? 'selected' : '' }}>
                                            {{ $radocument->agency_name }} ({{ $radocument->ra_name }})
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="ra_document_id_err text-danger error"></span>
                                </div>
                            </div>

                            {{-- Country --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Country</label><span class="text-danger">*</span>
                                    <select class="form-control" name="country" id="countryId" required>
                                        <option value="">Select a Country</option>
                                        @foreach($countries as $coun)
                                        <option value="{{ $coun->id }}" {{ isset($userPassport) && $userPassport->
                                            all_country_id == $coun->id ? 'selected' : '' }}>
                                            {{ $coun->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="country_err text-danger error"></span>
                                </div>
                            </div>

                            {{-- FE Name --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Fe Name<span class="text-danger">*</span></label>
                                    <input type="text" name="fe_name" id="fe_name_val"
                                        class="form-control text-uppercase"
                                        oninput="this.value = this.value.toUpperCase();" placeholder="Fe Name"
                                        value="{{ old('fe_name', $userPassport->fe_name ?? '') }}" required>
                                    <span class="fe_name_err text-danger error"></span>
                                </div>
                            </div>

                            {{-- FE No --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Fe No <span class="text-danger">*</span></label>
                                    <input type="text" name="fe_no" id="fe_no" class="form-control" minlength="4"
                                        maxlength="20" placeholder="Fe Number"
                                        value="{{ old('fe_no', $userPassport->fe_no ?? '') }}">
                                    <span class="fe_no_err text-danger error"></span>
                                </div>
                            </div>

                            {{-- Individual / Company --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Individual / Company</label><span class="text-danger">*</span>
                                    <select name="individual_or_company" id="individual_or_company"
                                        class="form-control">
                                        <option value="">Select</option>
                                        <option value="individual" {{ old('individual_or_company', $userPassport->
                                            individual_or_company ?? '') == 'individual' ? 'selected' : '' }}>Individual
                                        </option>
                                        <option value="company" {{ old('individual_or_company', $userPassport->
                                            individual_or_company ?? '') == 'company' ? 'selected' : '' }}>Company
                                        </option>
                                    </select>
                                    <span class="individual_or_company_err text-danger error"></span>
                                </div>
                            </div>


                            <div class="col-lg-4 col-sm-4" id="fe_stamp_div" style="display: none;">
                                <div class="form-group">
                                    <label>Fe Stamp <span class="text-danger">*</span></label>
                                    <select class="form-control" name="fe_stamp_id" id="fe_stamp_id">
                                        <option value="">Select a Fe Stamp</option>
                                        @foreach($feStamps as $festamp)
                                        <option value="{{ $festamp->id }}" {{ old('fe_stamp_id', $userPassport->
                                            fe_stamp_id ?? '') == $festamp->id ? 'selected' : '' }}>
                                            {{ $festamp->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="fe_stamp_id_err text-danger error"></span>
                                </div>
                            </div>

                            {{-- Sponsor Name --}}
                            <div class="col-lg-4 col-sm-4 sponsorDetail">
                                <div class="form-group">
                                    <label>Sponsor Name</label><span class="text-danger">*</span>
                                    <input type="text" name="sponsor_name" id="sponsor_name"
                                        class="form-control sponsorInput text-uppercase"
                                        oninput="this.value = this.value.toUpperCase();" placeholder="Sponsor Name"
                                        value="{{ old('sponsor_name', $userPassport->sponsor_name ?? '') }}">
                                    <span class="sponsor_name_err text-danger error"></span>
                                </div>
                            </div>

                            {{-- Sponsor ID No --}}
                            <div class="col-lg-4 col-sm-4 sponsorDetail">
                                <div class="form-group">
                                    <label>Sponsor id</label><span class="text-danger">*</span>
                                    <input type="text" name="sponsor_id" id="sponsor_id"
                                        class="form-control sponsorInput" placeholder="Sponsor id"
                                        value="{{ old('sponsor_id', $userPassport->sponsor_id ?? '') }}">
                                    <span class="sponsor_id_err text-danger error"></span>
                                </div>
                            </div>


                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Fe Sign <span class="text-danger">*</span></label>
                                    <select class="form-control" name="fe_sign_id" id="fe_sign_id">
                                        <option value="">Select a Fe Sign</option>
                                        @foreach($feSigns as $fesign)
                                        <option value="{{ $fesign->id }}" {{ old('fe_sign_id', $userPassport->fe_sign_id
                                            ?? '') == $fesign->id ? 'selected' : '' }}>
                                            {{ $fesign->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="fe_sign_id_err text-danger error"></span>
                                </div>
                            </div>


                            {{-- FE Age --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>FE Age <span class="text-danger">*</span></label>
                                    <input type="text" name="fe_age" id="fe_age"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                        maxlength="2" minlength="1" class="form-control" placeholder="Fe Age"
                                        value="{{ old('fe_age', $userPassport->fe_age ?? '') }}">
                                    <span class="fe_age_err text-danger error"></span>
                                </div>
                            </div>


                            {{-- PO Box No. --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label for="pobox">PO Box No. <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pobox" name="pobox"
                                        value="{{ old('pobox', $userPassport->pobox ?? '') }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                        minlength="3" maxlength="6" Placeholder="PO Box No." required>
                                    <span class="pobox_err text-danger error"></span>

                                </div>
                            </div>

                            {{-- Pin Code --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label for="pin_code">Pin Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pin_code" name="pin_code"
                                        value="{{ old('pin_code', $userPassport->pin_code ?? '') }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                        minlength="3" maxlength="6" placeholder="Pin Code" required>
                                    <span class="pin_code_err text-danger error"></span>
                                </div>
                            </div>

                            {{-- Job --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Job</label><span class="text-danger">*</span>
                                    <input type="text" name="job" class="form-control text-uppercase"
                                        oninput="this.value = this.value.toUpperCase();" placeholder="Job"
                                        value="{{ old('job', $userPassport->job ?? '') }}">
                                    <span class="job_err text-danger error"></span>
                                </div>
                            </div>

                            {{-- Vacancy --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Vacancy</label><span class="text-danger">*</span>
                                    <input type="text" id="vacancyId" name="vacancy"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                        maxlength="2" minlength="1" class="form-control" placeholder="Vacancy"
                                        value="{{ old('vacancy', $userPassport->vacancy ?? '') }}">
                                    <span class=" vacancy_err text-danger error"></span>

                                </div>
                            </div>

                            {{-- Salary --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Salary</label><span class="text-danger">*</span>
                                    <input type="number" step="0.01" min="1" name="salary" placeholder="Salary"
                                        class="form-control" value="{{ old('salary', $userPassport->salary ?? '') }}">
                                    <span class="salary_err text-danger error"></span>
                                </div>
                            </div>

                            {{-- Ref No --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label for="ref_no">Ref No</label>
                                    <input type="text" id="ref_no" name="ref_no" maxlength="50" minlength="2"
                                        oninput="this.value = this.value.toUpperCase();" class="form-control"
                                        placeholder="Ref No" value="{{ old('ref_no', $userPassport->ref_no ?? '') }}">
                                    <span class="ref_no_err text-danger error"></span>

                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Passport Document</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input preview-image"
                                                data-preview="#viewPassportPdf" id="passport" name="passport"
                                                accept=".pdf" style="cursor: pointer;">
                                            <label class="custom-file-label" for="passport">Upload Passport</label>
                                        </div>
                                    </div>
                                    <span class="passport_err text-danger error"></span>
                                    <small class="form-text text-muted">Allowed Pdf. Max size of 5MB</small>
                                    <span id="viewPassportPdf" class="mt-2 docPrevSpam">
                                        @if(isset($userPassport) && $userPassport->passport)
                                        <a href="{!! displayImage($userPassport->passport) !!}" class="mt-2"
                                            download="">Download</a>
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Visa Document</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input preview-image"
                                                data-preview="#viewVisaPdf" id="visa" name="visa" accept=".pdf"
                                                style="cursor: pointer;">
                                            <label class="custom-file-label" for="visa">Upload Visa</label>
                                        </div>
                                    </div>
                                    <span class="visa_err text-danger error"></span>
                                    <small class="form-text text-muted">Allowed Pdf. Max size of 5MB</small>
                                    <span id="viewVisaPdf" class="mt-2 docPrevSpam">
                                        @if(isset($userPassport) && $userPassport->visa)
                                        <a href={!! displayImage($userPassport->visa) !!} class="mt-2"
                                            download="">Download</a>
                                        @endif
                                    </span>
                                </div>
                            </div>

                            {{-- Candidate Sign --}}
                            <div class="col-lg-4 col-sm-4">
                                <div class="form-group">
                                    <label>Candidate Sign <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input  preview-image"
                                                data-preview="#candidateSignImg" id="candidate_sign"
                                                name="candidate_sign" accept=".png, .jpg, .jpeg"
                                                style="cursor: pointer;">
                                            <label class="custom-file-label" for="candidate_sign">Upload Candidate
                                                Sign</label>
                                        </div>

                                    </div>
                                    <span class="candidate_sign_err text-danger error"></span>
                                    <small class="form-text text-muted">Allowed JPG or PNG. Max size of 5MB</small>
                                    <span id="candidateSignImg">
                                        @if(isset($userPassport) && $userPassport->candidate_sign)
                                        <img src={!! displayImage($userPassport->candidate_sign) !!} width="100"
                                        class="mt-2">
                                        @endif
                                    </span>

                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <div class="col-lg-12 col-sm-12 text-center" id="submitSection">
                                <div class="form-group mt-4">
                                    <a href="{{ route('user-passports.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i>
                                        {{ isset($userPassport) ? 'Update' : 'Submit' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('admin-assets/scripts/user-passports.js') }}"></script>

<script>
    const checkPassportUrl = "{{ route('check.passport') }}";
    const checkFeDetailsUrl = "{{ route('check.fe.details') }}";

    function toggleFeStamp() {
        let selected = $('#individual_or_company').val();
        if (selected === 'company') {
            $('#fe_stamp_div').show();
            $('.sponsorDetail').show();
            $('.sponsorInput').attr('required', true);
            $('#fe_stamp_id').attr('required', true);
        } else  if (selected === 'individual') {
            $('#fe_stamp_div').hide();
            $('.sponsorDetail').hide();
            $('.sponsorInput').removeAttr('required');
            $('#fe_stamp_id').removeAttr('required');
        }
    }

    $(document).ready(function() {
        toggleFeStamp(); // On page load
        $('#individual_or_company').on('change', toggleFeStamp);
    });
</script>
@endsection