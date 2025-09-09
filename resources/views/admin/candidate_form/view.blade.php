@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
{{-- <div class="scroll-bannerr">
    <div>This Page Is In Under Development</div>
</div> --}}
<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="position: sticky;top:66px;left:0px;z-index:1000;background:white;">
                    <h3 class="card-title"> {{$title}} > {{ ucfirst($candidate->passportDetail->individual_or_company)
                        }} > {{ $candidate->passportDetail->country->name }} </h3>

                    <a href="{{ url()->previous() }}" class="btn btn-danger" style="float: right;margin-right:3px;"><i
                            class="fa fa-arrow-left fa-xs"></i>
                        {{ __('Back') }}</a>
                    <a href="{{ route('candidate_form.uploaded_document', encrypt($candidate->id)) }}"
                        class="btn btn-primary" style="float: right;margin-right:3px;"><i class="fa fa-eye"></i>
                        Attachments</a>
                    <a href="javascript:void(0)" id="added_soon" class="btn btn-success"
                        style="float: right;margin-right:3px;"><i class="fa fa-plus fa-xs"></i>
                        Emigrate Fe Id</a>
                </div>
                <div class="card-body">

                    {{-- Important Detail --}}
                    <fieldset class="border border-primary p-1 mb-3" style="border-width: 2px !important;">
                        <legend class="w-auto px-2">{{ $candidate->passportDetail->country->name }}</legend>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Passport No:</strong>
                                <span onclick="copyContent(this)" style="cursor: pointer;"> {{
                                    $candidate->passport_no }} <i class="far fa-copy text-primary"
                                        title="copy"></i></span>
                            </div>
                            <div class="col-md-3"><strong>RA Agency Name:</strong>
                                <span onclick="copyContent(this)" style="cursor: pointer;"> {{
                                    $candidate->passportDetail->raDocument->agency_name }} <i
                                        class="far fa-copy text-primary" title="copy"></i></span>
                            </div>
                            <div class="col-md-3"><strong>Ref No:</strong>
                                <span onclick="copyContent(this)" style="cursor: pointer;"> {{
                                    $candidate->passportDetail->ref_no ?? 'N/A' }} <i class="far fa-copy text-primary"
                                        title="copy"></i></span>
                            </div>
                            <div class="col-md-3"><strong>Vacancy:</strong>
                                <span onclick="copyContent(this)" style="cursor: pointer;"> {{
                                    $candidate->passportDetail->vacancy }} <i class="far fa-copy text-primary"
                                        title="copy"></i></span>
                            </div>
                        </div>
                        {{-- <div class="row mb-2">
                            <div class="col-md-4"><strong>Vacancy:</strong>
                                <span onclick="copyContent(this)" style="cursor: pointer;"> {{
                                    $candidate->passportDetail->vacancy }} <i class="far fa-copy text-primary"
                                        title="copy"></i></span>
                            </div>
                            <div class="col-md-4"><strong>PO Box :</strong>
                                <span onclick="copyContent(this)" style="cursor: pointer;"> {{ $candidate->pobox }} <i
                                        class="far fa-copy text-primary" title="copy"></i></span>
                            </div>
                            <div class="col-md-4"><strong>Pin Code:</strong>
                                <span onclick="copyContent(this)" style="cursor: pointer;"> {{ $candidate->pin_code }}
                                    <i class="far fa-copy text-primary" title="copy"></i></span>
                            </div>
                        </div> --}}

                    </fieldset>

                    <div class="row">

                        <!-- Card One -->
                        <div class="col-md-3 mb-3">
                            <div class="card h-100 mb-0">
                                <div class="card-header bg-primary" style="font-weight: bold;">(1) Services→ Find FE
                                    Registered By RA→ FE Registration (FE)

                                </div>
                                <div class="card-body p-1" style="background-color: #e6ebf1;">
                                    <p>
                                        <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Name:</strong>
                                        <span onclick="copyContent(this)" style="cursor: pointer;">
                                            {{ $candidate->passportDetail->fe_name }}
                                            <i class="far fa-copy text-primary" title="copy"></i>
                                        </span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>National Of:</strong>
                                        <span onclick="copyContent(this)" style="cursor: pointer;">
                                            {{ $candidate->passportDetail->country->name }}
                                            <i class="far fa-copy text-primary" title="copy"></i>
                                        </span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Mobile
                                            No:</strong>
                                        <span onclick="copyContent(this)" style="cursor: pointer;">
                                            {{ $candidate->passportDetail->country->phonecode
                                            }}-{{$candidate->passportDetail->fe_phone_no }}
                                            <i class="far fa-copy text-primary" title="copy"></i>
                                        </span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Govt
                                            Issued Photo ID No.:</strong>
                                        <span onclick="copyContent(this)" style="cursor: pointer;">
                                            {{ $candidate->passportDetail->fe_no }}
                                            <i class="far fa-copy text-primary" title="copy"></i>
                                        </span>
                                    </p>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>Foreign
                                            Employer Email Id:</strong>
                                        {{-- <span onclick="copyContent(this)" style="cursor: pointer;">
                                            {{ $candidate->dob }}
                                            <i class="far fa-copy text-primary" title="copy"></i>
                                        </span> --}}
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>PO Box
                                            Number:</strong>
                                        <span onclick="copyContent(this)" style="cursor: pointer;">
                                            {{ $candidate->passportDetail->pobox }}
                                            <i class="far fa-copy text-primary" title="copy"></i>
                                        </span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Postal
                                            Pincode:</strong>
                                        <span onclick="copyContent(this)" style="cursor: pointer;">
                                            {{ $candidate->passportDetail->pin_code }}
                                            <i class="far fa-copy text-primary" title="copy"></i>
                                        </span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Country:</strong>
                                        <span onclick="copyContent(this)" style="cursor: pointer;">
                                            {{ $candidate->passportDetail->country->name }}
                                            <i class="far fa-copy text-primary" title="copy"></i>
                                        </span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>State/Province:</strong>
                                        <span onclick="copyContent(this)" style="cursor: pointer;">
                                            {{ $candidate->passportDetail->country->capital }}
                                            <i class="far fa-copy text-primary" title="copy"></i>
                                        </span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>City/Town/Village:</strong>
                                        <span onclick="copyContent(this)" style="cursor: pointer;">
                                            {{ $candidate->passportDetail->country->capital }}
                                            <i class="far fa-copy text-primary" title="copy"></i>
                                        </span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Landline Phone No.:</strong>
                                        <span onclick="copyContent(this)" style="cursor: pointer;">
                                            {{ $candidate->passportDetail->country->phonecode
                                            }}-{{$candidate->passportDetail->fe_phone_no }}
                                            <i class="far fa-copy text-primary" title="copy"></i>
                                        </span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Address:</strong>
                                        <span onclick="copyContent(this)" style="cursor: pointer;">
                                            PO BOX {{ $candidate->passportDetail->pobox }}, PC {{
                                            $candidate->passportDetail->pin_code }},
                                            {{$candidate->passportDetail->country->capital }} {{
                                            $candidate->passportDetail->country->name }}
                                            <i class="far fa-copy text-primary" title="copy"></i>
                                        </span>
                                    </p>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <p><i class="fa fa-file-pdf text-danger" aria-hidden="true"></i> <strong>Doc.
                                            Upload:</strong>
                                    <ol class="text-end mb-0 mt-0">
                                        <li>Request</li>
                                        <li>ID</li>
                                        <li>Visa/Visa Platform</li>
                                    </ol>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Two -->
                        <div class="col-md-3 mb-3">
                            <div class="card h-100 mb-0">
                                <div class="card-header bg-success" style="font-weight: bold;">(2) Services→Find FE
                                    Registered By RA→ Raise Demand by RA (DM)
                                </div>
                                <div class="card-body p-1" style="background-color: #efeccf;">
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Unique
                                            ID:</strong> <span onclick="copyContent(this)"> {{
                                            $candidate->passportDetail->fe_no }}
                                            <i class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i>
                                        <strong>Category:</strong> <span onclick="copyContent(this)">Skilled <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i>
                                        <strong>Experience Level:</strong> <span onclick="copyContent(this)">Middle <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Job
                                            Role:</strong> <span
                                            onclick="copyContent(this)">{{$candidate->passportDetail->job }} <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>Period
                                            Of Contract:</strong> <span onclick="copyContent(this)">24 <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i>
                                        <strong>Description:</strong> <span onclick="copyContent(this)"> <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Vacancies:</strong> <span
                                            onclick="copyContent(this)">{{$candidate->passportDetail->vacancy }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>Age
                                            Limit:</strong> <span onclick="copyContent(this)">No Age Limit <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i>
                                        <strong>Gender:</strong> <span onclick="copyContent(this)">Male <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>Working
                                            Timings:</strong> <span onclick="copyContent(this)">8 AM- 4 PM <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>Whether
                                            Applying For Domestic:</strong> <span onclick="copyContent(this)">No <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Details Of Mode Settlement:</strong> <span
                                            onclick="copyContent(this)">AS
                                            PER
                                            {{ $candidate->passportDetail->country->name }} LABOUR LAW <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>FE
                                            ID:</strong> <span onclick="copyContent(this)">{{
                                            $candidate?->emigrate_fe_id ?? 'N/A' }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Minimum Monthly Salary:</strong> <span onclick="copyContent(this)">{{
                                            intval($candidate->passportDetail->salary) }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <p>
                                    <table style="border-collapse:collapse; border:1px solid black; width:100%">
                                        @php
                                        $yes = '✔';
                                        $no = '✘';
                                        $checked = [1,2,3,4,7,9,10,11];
                                        @endphp
                                        @for ($i = 1; $i <= 12; $i++) <tr>
                                            <td
                                                style="border:1px solid black; padding:2px 6px; line-height:1.2; text-align:center;">
                                                {{ $i }}
                                            </td>
                                            <td
                                                style="border:1px solid black; padding:2px 6px; line-height:1.2; text-align:center;">
                                                Yes {{ in_array($i, $checked) ? $yes : '' }}
                                            </td>
                                            <td
                                                style="border:1px solid black; padding:2px 6px; line-height:1.2; text-align:center;">
                                                No {{ !in_array($i, $checked) ? $yes : '' }}
                                            </td>
                                            </tr>
                                            @endfor
                                    </table>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <table style="border-collapse:collapse; border:1px solid black; width:100%">
                                        <tr>
                                            <td
                                                style="border:1px solid black; padding:2px 6px; line-height:1.2; text-align:center;">
                                                Has the Applicant arranged to obtain Employment Visa
                                            </td>
                                            <td
                                                style="border:1px solid black; padding:2px 6px; line-height:1.2; text-align:center;">
                                                Yes</td>
                                            <td
                                                style="border:1px solid black; padding:2px 6px; line-height:1.2; text-align:center;">
                                                No{{$yes}}</td>
                                        </tr>
                                    </table>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <table style="border-collapse:collapse; border:1px solid black; width:100%">
                                        <tr>
                                            <td
                                                style="border:1px solid black; padding:2px 6px; line-height:1.2; text-align:center;">
                                                Labour quota approval registration number
                                            </td>
                                            <td
                                                style="border:1px solid black; padding:2px 6px; line-height:1.2; text-align:center;">
                                                <span onclick="copyContent(this)">
                                                    {{ $candidate?->emigrate_fe_id ?? 'N/A' }} <i
                                                        class="far fa-copy text-primary"></i></span>
                                            </td>

                                        </tr>
                                    </table>
                                    </p>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <p><i class="fa fa-file-pdf text-danger" aria-hidden="true"></i> <strong>Doc.
                                            Upload:</strong>
                                    <ol class="text-end mb-0 mt-0">
                                        <li>{{ $candidate->passportDetail->individual_or_company === 'company' ? 'CR' :
                                            'Visa/Visa Platform'}}</li>
                                        <li>Power</li>
                                        <li>Demand</li>

                                    </ol>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Passport Details -->
                        <div class="col-md-3 mb-3">
                            <div class="card h-100 mb-0">
                                <div class="card-header bg-warning" style="font-weight: bold;">(3) Monthly Return→
                                    Details Of
                                    Indian Recruited→ Emigrants With
                                    ECR Passport to ECR Country (JB)</div>
                                <div class="card-body p-1" style="background-color: #d1f4e5;">
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>First
                                            Name:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->first_name_eng }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Last
                                            Name:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->last_name_eng
                                            }} <i class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i>
                                        <strong>Gender:</strong> <span onclick="copyContent(this)">Male <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Date
                                            Of
                                            Birth:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->dob }} <i class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Passport
                                            Number:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->passport_no
                                            }} <i class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Passport
                                            Expiry Date:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->passport_expiry_date }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Place
                                            Of
                                            Passport Issue:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->passport_issue_place }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Passport
                                            Issue Date:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->passport_issue_date }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Father
                                            Name:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->father_name
                                            }} <i class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Address
                                            Line 1:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->passport_address }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i>
                                        <strong>Address
                                            Line 2:</strong> <span onclick="copyContent(this)"> <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>State/UT:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->passport_issue_state }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>District:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->current_city }} <i class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>City/Town/Village:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->current_city }} <i class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Pin
                                            Code:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->passport_pin_code }} <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>23.
                                            Other
                                            Cantractual Entitlements:</strong> <span>0
                                        </span></p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>33.
                                            Mobile
                                            No. Of Emigrant:</strong> <span
                                            onclick="copyContent(this)">+91-{{$candidate->candidate_mobile_no }} <i
                                                class="far fa-copy text-primary"></i></span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Other Details (example extras, adjust as per your DB) -->
                        <div class="col-md-3 mb-3">
                            <div class="card h-100 mb-0">
                                <div class="card-header bg-danger" style="font-weight: bold;">(4) Services→Find FE
                                    Registered By RA→ RA Demand Dashboard (EN)
                                </div>
                                <div class="card-body p-1" style="background-color: #f0f2dc;">
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Passport No.:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->passport_no ?? 'N/A' }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Visa
                                            Number:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->passportDetail->all_country_id == 5 ?
                                            $candidate->en_visa_no :
                                            $candidate->visa_no }} <i class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>Visa
                                            Type:</strong> <span onclick="copyContent(this)">Employment/Work <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Date
                                            Of Issue:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->visa_issue_date ?? 'N/A' }} <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Place
                                            Of Issue:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->visa_issue_place ?? 'N/A' }} <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Date
                                            Of Expiry:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->visa_expiry_date ?? 'N/A' }} <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Designation as on Visa:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->job_on_visa ?? 'N/A' }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>Marital
                                            Status:</strong> <span onclick="copyContent(this)">
                                            {{$candidate->nominee_relation == 'Wife' ? 'Married' : 'Single'}}
                                            <i class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>2.
                                            Educational Qualification:</strong> <span onclick="copyContent(this)">Below
                                            7<sup>th</sup> Standard <i class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Place
                                            Of Birth:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->birth_place ?? 'N/A' }} <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>Whether
                                            present address is same as in Passport:</strong> <span
                                            onclick="copyContent(this)">Yes <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i> <strong>Mobile
                                            Number:</strong> <span
                                            onclick="copyContent(this)">+91-{{$candidate->alternate_no ?? 'N/A' }} <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i>
                                        <strong>Email:</strong>
                                    </p>
                                    {{--
                                    <hr class="border border-dark border-2 opacity-100" /> --}}
                                    <p><strong style="text-decoration: underline;">Emergency Contact Details in
                                            India:</strong> </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Name:</strong> <span
                                            onclick="copyContent(this)">{{$candidate->nominee_name ??
                                            'N/A' }}
                                            <i class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Relationship:</strong> <span onclick="copyContent(this)">
                                            {{ $candidate->nominee_relation }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Address:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->passport_address ?? 'N/A' }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><strong style="text-decoration: underline;">Emergency Contact Details in
                                            Destination Country:</strong></p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Name:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->passportDetail->fe_name ?? 'N/A' }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i>
                                        <strong>Relationship:</strong> <span onclick="copyContent(this)">Guardian <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Address:</strong> <span onclick="copyContent(this)"> PO BOX {{
                                            $candidate->passportDetail->pobox }}, PC {{
                                            $candidate->passportDetail->pin_code }}, {{
                                            $candidate->passportDetail->country->capital }} {{
                                            $candidate->passportDetail->country->name }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><strong style="text-decoration: underline;">Details of Nominee:</strong> </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Nominee Name:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->nominee_name ?? 'N/A' }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Nominee Relationship:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->nominee_relation ?? 'N/A' }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>Nominee
                                            Gender:</strong> <span onclick="copyContent(this)">Female <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>Nominee
                                            Bank Name:</strong> <span onclick="copyContent(this)">Nill <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-danger" aria-hidden="true"></i> <strong>Nominee
                                            Account Number:</strong> <span>0 <i
                                                class="far fa-copy text-primary"></i></span></p>
                                    <p><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                        <strong>Nominee Address:</strong> <span onclick="copyContent(this)">{{
                                            $candidate->passport_address ?? 'N/A' }} <i
                                                class="far fa-copy text-primary"></i></span>
                                    </p>
                                    <hr class="border border-dark border-2 opacity-100" />
                                    <p><i class="fa fa-file-pdf text-danger" aria-hidden="true"></i> <strong>Doc.
                                            Upload:</strong>
                                    <ol class="text-end mb-0 mt-0">
                                        <li>Agreement</li>
                                        <li>PP</li>
                                        <li>Visa</li>
                                        <li>Photo</li>
                                    </ol>
                                    </p>
                                    <p><strong>6. Optional attachment 1:</strong> AFFIDAVIT</p>
                                    <p><strong>7. Optional attachment 2:</strong> SCAN</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Download Section --}}
                    <fieldset class="border p-1">
                        <legend class="w-auto px-2">Download Section</legend>
                        @if($candidate->status !== 'completed')
                        <div class="alert alert-danger mb-0">
                            <strong>Download Denied:</strong> Before downloading, make sure the candidate form status is
                            <strong>Completed</strong>.
                        </div>
                        @elseif(!auth()->user()->can('candidate-form.download'))
                        <div class="alert alert-danger mb-0">
                            <strong>Permission Denied:</strong> You do not have permission to download documents.
                        </div>
                        @else
                        <div class="row mb-2">
                            <div class="col-md-2 mb-2">
                                <a href="{{ url('/admin/pdf_download', ['agreement_'.$candidate->passportDetail->country->name, $candidate->id]) }}"
                                    class="btn btn-primary btn-block" data-clicktodisabled="true">
                                    <i class="fa fa-download"></i> Agreement
                                </a>
                            </div>
                            <div class="col-md-2 mb-2">
                                <a href="{{ url('/admin/pdf_download', [$candidate->passportDetail->individual_or_company, $candidate->id]) }}"
                                    class="btn btn-secondary btn-block" data-clicktodisabled="true">
                                    <i class="fa fa-download"></i> Request {{
                                    ucfirst($candidate->passportDetail->individual_or_company) }}
                                </a>
                            </div>
                            <div class="col-md-2 mb-2">
                                <a href="{{ url('/admin/pdf_download', ['power_of_attorny', $candidate->id]) }}"
                                    class="btn btn-success btn-block" data-clicktodisabled="true">
                                    <i class="fa fa-download"></i> Power Of Attorny
                                </a>
                            </div>
                            <div class="col-md-2 mb-2">
                                <a href="{{ url('/admin/pdf_download', ['scan', $candidate->id]) }}"
                                    class="btn btn-info btn-block" data-clicktodisabled="true">
                                    <i class="fa fa-download"></i> Scan
                                </a>
                            </div>
                            <div class="col-md-2 mb-2">
                                <a href="{{ url('/admin/pdf_download', ['affidavit', $candidate->id]) }}"
                                    class="btn btn-warning btn-block" data-clicktodisabled="true">
                                    <i class="fa fa-download"></i> Affidavit
                                </a>
                            </div>
                            <div class="col-md-2 mb-2">
                                <a href="{{ url('/admin/pdf_download', ['demand_letter', $candidate->id]) }}"
                                    class="btn btn-danger btn-block" data-clicktodisabled="true">
                                    <i class="fa fa-download"></i> Demand Letter
                                </a>
                            </div>
                        </div>
                        @endif

                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function copyContent(element) {
            var text = element.innerText.trim();
    
            // Copy text
            navigator.clipboard.writeText(text).then(function() {
                // Change icon to check
                var icon = element.querySelector('i');
                var originalClass = icon.className;
                icon.className = 'fas fa-check text-success';
        
                // Revert icon after 1 second
                setTimeout(function() {
                    icon.className = originalClass;
                }, 1000);
            });
        }

    $(document).ready(function() {
        $('#added_soon').click(function() {
            alert('Feature coming soon!');
        });
    });
</script>
@endsection