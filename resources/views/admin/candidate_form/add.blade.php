@extends('admin.layouts.master')

@section('title', __('Admin | ' . $title))

@section('maincontent')
<section class="content-header">
    <div class="row">
        <!-- Left Column -->
        <div class="col-md-9">
            <div class="card mb-0" style="position:sticky; top:70px;">
                <div class="card-body">
                    <form action="{{ route('get_passport_info') }}" method="POST" id="passport_search_form"
                        autocomplete="off" novalidate>
                        <div class="row g-2 align-items-start mb-3">
                            <div class="form-group col-md-10 mb-0">
                                <input type="search" value="{{ old('passport_no', $candidates->passport_no ?? '') }}"
                                    class="form-control" id="passport" name="passport" minlength="5" maxlength="10"
                                    placeholder="Enter Passport No." required>
                                <span class="passport_err text-danger error"></span>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" id="passport_search_trigger"
                                    class="btn btn-warning w-100">Search</button>
                            </div>
                        </div>
                    </form>
                    <!-- Tabs section (initially hidden) -->
                    <div id="tab-section" style="">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="visa-tab" data-toggle="tab" data-target="#visa_tab"
                                    type="button" role="tab">Visa</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="passport-tab" data-toggle="tab" data-target="#passport_tab"
                                    type="button" role="tab">Passport</button>
                            </li>
                        </ul>
                        <div class="tab-content border py-1 px-2" id="myTabContent"
                            style="overflow: auto; cursor: grab; width: 100%; max-height: 61vh; overflow-y:auto;">
                            <div class="tab-pane fade show active text-center" id="visa_tab" role="tabpanel">
                                <div id="visa_canvas_container"></div>
                            </div>
                            <div class="tab-pane fade text-center" id="passport_tab" role="tabpanel">
                                <div id="passport_canvas_container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /col-md-8 -->
        <!-- Right Column -->
        <div class="col-md-3">
            <div class="card mb-0" style="max-height: 79vh; overflow-y:auto;">
                <form method="POST" action="{{ route('candidate_form.store') }}" id="candidateForm" autocomplete="off"
                    novalidate>
                    <div class="card-body p-2">
                        <!-- 1. VISA DETAILS -->
                        <fieldset class="border px-3 mb-4">
                            <legend class="w-auto px-2">Visa Detail</legend>
                            <input type="hidden" name="id" id="id" value="{{ $candidates->id ?? ''}}" />
                            @if(auth()->user()->can('emigrate-fe-id.edit') && isset($candidates->status) &&
                            $candidates->status == 'completed')
                            <div class="mb-1 form-group">
                                <label for="emigrate_fe_id" class="form-label mb-0">Emigrate Fe Id :</label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="emigrate_fe_id"
                                    value="{{ old('visa_no', $candidates->emigrate_fe_id ?? '') }}" maxlength="50"
                                    name="emigrate_fe_id">
                                <span class="emigrate_fe_id_err text-danger error"></span>
                            </div>
                            @endif
                            <div class="mb-1 form-group">
                                <label for="visa_no" class="form-label" id="visa_field_name_change">Visa No <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="visa_no"
                                    value="{{ old('visa_no', $candidates->visa_no ?? '') }}" minlength="8"
                                    maxlength="50" name="visa_no">
                                <span class="visa_no_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group d-none" id="en_visa_no_div">
                                <label for="en_visa_no" class="form-label">EN Visa No<strong
                                        class="text-danger">*</strong>: <small><em>(Only for Saudi
                                            Arabia)</em></small></label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                    id="en_visa_no" value="{{ old('en_visa_no', $candidates->en_visa_no ?? '') }}"
                                    minlength="8" maxlength="40" name="en_visa_no">
                                <span class="en_visa_no_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="issue_date" class="form-label">Issue Date <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control" name="visa_issue_date" id="visa_issue_date"
                                    value="{{ old('visa_issue_date', $candidates->visa_issue_date ?? '') }}"
                                    oninput="this.value = formatDate(this.value)"
                                    pattern="^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-\d{4}$" placeholder="dd-mm-yyyy"
                                    maxlength="10" required>
                                <span class="visa_issue_date_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="expiry_date" class="form-label mb-0">Expiry Date <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control" id="visa_expiry_date" name="visa_expiry_date"
                                    value="{{ old('visa_expiry_date', $candidates->visa_expiry_date ?? '') }}"
                                    oninput="this.value = formatDate(this.value)"
                                    pattern="^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-\d{4}$" placeholder="dd-mm-yyyy"
                                    maxlength="10" required>
                                <span class="visa_expiry_date_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="visa_issue_place" class="form-label mb-0">Place Of Issue <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="visa_issue_place"
                                    name="visa_issue_place"
                                    value="{{ old('visa_issue_place', $candidates->visa_issue_place ?? '') }}"
                                    pattern="[a-zA-Z\s]+" minlength="3" maxlength="20" required>
                                <span class="visa_issue_place_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="job_on_visa" class="form-label mb-0">Job On Visa <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="job_on_visa" name="job_on_visa"
                                    value="{{ old('job_on_visa', $candidates->job_on_visa ?? '') }}"
                                    pattern="[a-zA-Z\s]+" minlength="3" maxlength="40" required>
                                <span class="job_on_visa_err text-danger error"></span>
                            </div>
                        </fieldset>
                        <!-- 2. PASSPORT DETAILS -->
                        <fieldset class="border px-3 mb-4">
                            <legend class="w-auto px-2">Passport Detail</legend>
                            <div class="mb-1 form-group">
                                <label for="passport_no" class="form-label mb-0">Passport No <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="passport_no" name="passport_no"
                                    value="{{ old('passport_no', $candidates->passport_no ?? '') }}"
                                    pattern="[a-zA-Z0-9]+" minlength="5" maxlength="12" required readonly="true">
                                <span class="passport_no_err text-danger error"></span>
                            </div>
                            <input type="hidden" class="form-control" id="user_passport_id" name="user_passport_id"
                                value="{{ old('user_passport_id', $candidates->user_passport_id ?? '') }}">
                            <div class="mb-1 form-group">
                                <label for="last_name_eng" class="form-label mb-0">Last Name (English):</label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="last_name_eng"
                                    value="{{ old('last_name_eng', $candidates->last_name_eng ?? '') }}" minlength="3"
                                    maxlength="25" name="last_name_eng">
                                <span class="last_name_eng_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="first_name_eng" class="form-label mb-0">First Name (English) <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="first_name_eng"
                                    value="{{ old('first_name_eng', $candidates->first_name_eng ?? '') }}" minlength="3"
                                    maxlength="35" name="first_name_eng" required>
                                <span class="first_name_eng_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="name_hindi" class="form-label mb-0">Full Name (Hindi) <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control" id="name_hindi" name="name_hindi"
                                    value="{{ old('name_hindi', $candidates->name_hindi ?? '') }}" minlength="3"
                                    maxlength="50" required>
                                <span class="name_hindi_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="dob" class="form-label mb-0">Date of Birth <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control" id="dob" name="dob"
                                    value="{{ old('dob', $candidates->dob ?? '') }}"
                                    oninput="this.value = formatDate(this.value)"
                                    pattern="^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-\d{4}$" placeholder="dd-mm-yyyy"
                                    minlength="10" maxlength="10" required>
                                <span class="candidate_dob_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="birth_place" class="form-label mb-0">Birth Place <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="birth_place" name="birth_place"
                                    value="{{ old('birth_place', $candidates->birth_place ?? '') }}" minlength="3"
                                    maxlength="20" required>
                                <span class="birth_place_hindi_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="passport_issue_place" class="form-label mb-0">Place of Issue <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="passport_issue_place"
                                    value="{{ old('passport_issue_place', $candidates->passport_issue_place ?? '') }}"
                                    minlength="3" maxlength="20" name="passport_issue_place" required>
                                <span class="passport_issue_place_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="passport_issue_date" class="form-label mb-0">Issue Date <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control" id="passport_issue_date"
                                    name="passport_issue_date"
                                    value="{{ old('passport_issue_date', $candidates->passport_issue_date ?? '') }}"
                                    oninput="this.value = formatDate(this.value)"
                                    pattern="^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-\d{4}$" placeholder="dd-mm-yyyy"
                                    minlength="10" maxlength="10" required>
                                <span class="passport_issue_date_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="passport_expiry_date" class="form-label mb-0">Expiry Date <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control" id="passport_expiry_date"
                                    name="passport_expiry_date"
                                    value="{{ old('passport_expiry_date', $candidates->passport_expiry_date ?? '') }}"
                                    oninput="this.value = formatDate(this.value)"
                                    pattern="^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-\d{4}$" placeholder="dd-mm-yyyy"
                                    minlength="10" maxlength="10" required>
                                <span class="passport_expiry_date_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="father_name" class="form-label mb-0">Father Name <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="father_name" name="father_name"
                                    value="{{ old('father_name', $candidates->father_name ?? '') }}" minlength="3"
                                    maxlength="35" Placeholder="Father Name" required>
                                <span class="father_name_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label class="form-label mb-0 d-block">Nominee Relation<strong
                                        class="text-danger">*</strong>:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="nominee_relation"
                                        id="relation_mother" value="Mother" {{ old('nominee_relation',
                                        $candidates->nominee_relation ?? 'Wife') == 'Mother' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="relation_mother">Mother</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="nominee_relation"
                                        id="relation_wife" value="Wife" {{ old('nominee_relation',
                                        $candidates->nominee_relation ?? 'Wife') == 'Wife' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="relation_wife">Wife</label>
                                </div>
                            </div>

                            <div class="mb-1 form-group">
                                <label for="nominee_name" class="form-label mb-0">Nominee Name<strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="nominee_name"
                                    name="nominee_name"
                                    value="{{ old('nominee_name', $candidates->nominee_name ?? '') }}" minlength="3"
                                    maxlength="35" Placeholder="Nominee Name" required>
                                <span class="nominee_name_err text-danger error"></span>
                            </div>

                            <div class="mb-1 form-group">
                                <label for="passport_address" class="form-label mb-0">Full Address <strong
                                        class="text-danger">*</strong>:</label>
                                <textarea class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="passport_address"
                                    name="passport_address" minlength="10" maxlength="120" rows="2"
                                    required>{{ old('passport_address', $candidates->passport_address ?? '') }}</textarea>
                                <span class="passport_address_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="passport_pin_code" class="form-label mb-0">Pin Code <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control" id="passport_pin_code" name="passport_pin_code"
                                    value="{{ old('passport_pin_code', $candidates->passport_pin_code ?? '') }}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                    maxlength="6" minlength="6" placeholder="Passport Pin Code" required>
                                <span class="passport_pin_code_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="current_city" class="form-label mb-0">Current City <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="current_city"
                                    name="current_city"
                                    value="{{ old('current_city', $candidates->current_city ?? '') }}" minlength="3"
                                    maxlength="20" placeholder="Current City" required>
                                <span class="passport_pin_code_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="passport_issue_state" class="form-label mb-0">State <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control text-uppercase"
                                    oninput="this.value = this.value.toUpperCase();" id="passport_issue_state"
                                    minlength="3"
                                    value="{{ old('passport_issue_state', $candidates->passport_issue_state ?? '') }}"
                                    maxlength="20" name="passport_issue_state" required>
                                <span class="passport_issue_state_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="candidate_mobile_no" class="form-label mb-0">Mobile No <strong
                                        class="text-danger">*</strong>:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+91</span>
                                    </div>
                                    <input type="tel" class="form-control" id="candidate_mobile_no"
                                        name="candidate_mobile_no"
                                        value="{{ old('candidate_mobile_no', $candidates->candidate_mobile_no ?? '') }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                        minlength="10" maxlength="10" inputmode="numeric" placeholder="Mobile number"
                                        aria-describedby="basic-addon1" required>
                                    <span class="candidate_mobile_no_err text-danger error"></span>
                                </div>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="alternate_no" class="form-label mb-0">Alternate Mobile No:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2">+91</span>
                                    </div>
                                    <input type="tel" class="form-control" id="alternate_no" name="alternate_no"
                                        value="{{ old('alternate_no', $candidates->alternate_no ?? '') }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                        minlength="10" maxlength="10" required placeholder="Alternate mobile number"
                                        aria-describedby="basic-addon2">
                                    <span class="alternate_no_err text-danger error"></span>
                                </div>
                            </div>
                        </fieldset>
                        <!-- 3. Fe DETAILS -->
                        {{-- <fieldset class="border px-3 mb-4">
                            <legend class="w-auto px-2">Fe Detail</legend>
                            <div class="mb-1 form-group">
                                <label for="pobox" class="form-label mb-0">PO Box No. <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control" id="pobox" name="pobox"
                                    value="{{ old('pobox', $candidates->pobox ?? '') }}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                    minlength="3" maxlength="6" Placeholder="PO Box No." required>
                                <span class="pobox_err text-danger error"></span>
                            </div>
                            <div class="mb-1 form-group">
                                <label for="pin_code" class="form-label mb-0">Pin Code <strong
                                        class="text-danger">*</strong>:</label>
                                <input type="text" class="form-control" id="pin_code" name="pin_code"
                                    value="{{ old('pin_code', $candidates->pin_code ?? '') }}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric"
                                    minlength="3" maxlength="6" placeholder="Pin Code" required>
                                <span class="pin_code_err text-danger error"></span>
                            </div>
                        </fieldset> --}}
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /col-md-4 -->
    </div> <!-- /row -->
</section>
@endsection

@section('scripts')
<script src="{{ asset('admin-assets/scripts/candidate_form.js') }}"></script>
@endsection