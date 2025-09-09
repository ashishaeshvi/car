@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> {{$title}} > {{ ucfirst($candidate->passportDetail->individual_or_company)
                        }} > {{ $candidate->passportDetail->country->name }}</h3>
                    <a href="{{ url()->previous() }}" class="btn btn-danger" style="float: right;margin-right:3px;"><i
                            class="fa fa-arrow-left fa-xs"></i>
                        {{ __('Back') }}</a>
                </div>
                <div class="card-body">
                    {{-- Attachments --}}
                    <fieldset class="border p-3">
                        <legend class="w-auto px-2">Attachment</legend>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <div class="mb-2"><strong>RA Sign:</strong></div>
                                <div><img src="{{ displayImage($candidate->passportDetail->raDocument->ra_sign) }}"
                                        width="200px"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-2"><strong>RA Stamp:</strong></div>
                                <div><img src="{{ displayImage($candidate->passportDetail->raDocument->ra_stamp) }}"
                                        width="200px"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-2"><strong>Fe Sign:</strong></div>
                                <div><img src="{{ displayImage($candidate->passportDetail->feSign->attachment) }}"
                                        width="200px"></div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            @if($candidate->passportDetail->individual_or_company == 'company')
                            <div class="col-md-4">
                                <div class="mb-2"><strong>Fe Stamp:</strong></div>
                                <div>
                                    <img src="{{ displayImage($candidate->passportDetail->feStamp->attachment) }}"
                                        width="200px">
                                </div>
                            </div>
                            @endif
                            <div class="col-md-4">
                                <div class="mb-2"><strong>Letterpad Banner:</strong></div>
                                <div><img
                                        src="{{ displayImage($candidate->passportDetail->raDocument->letterpad_logo) }}"
                                        width="200px"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-2"><strong>Letterpad Footer:</strong></div>
                                <div><img
                                        src="{{ displayImage($candidate->passportDetail->raDocument->letterpad_footer) }}"
                                        width="200px"></div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4">
                                <div class="mb-2"><strong>Candidate Sign:</strong></div>
                                <div><img src="{{ displayImage($candidate->passportDetail->candidate_sign) }}"
                                        width="200px"></div>
                            </div>
                            <div class="col-md-4"><strong>Passport: </strong><a
                                    href="{{ displayImage($candidate->passportDetail->passport) }}"
                                    class="btn btn-sm btn-primary" download><i class="fa fa-download"></i> Download</a>
                            </div>
                            <div class="col-md-4"><strong>Visa: </strong> <a
                                    href="{{ displayImage($candidate->passportDetail->visa) }}"
                                    class="btn btn-sm btn-primary" download><i class="fa fa-download"></i> Download</a>
                            </div>
                        </div>

                        <fieldset class="border p-3">
                            <legend class="w-auto px-2">Affidavit Uploaded</legend>
                            <div class="row">
                                @foreach($candidate->passportDetail->raDocument->affidavit_notary ?? [] as $image)
                                <div class="col-md-4 mb-4">
                                    <div class="card overflow-hidden" style="height: 300px;">
                                        <div class="img-hover-zoom" style="height: 80%; overflow: hidden;">
                                            <img src="{{ displayImage($image) }}" class="img-fluid w-100">
                                        </div>
                                        <div class="card-body p-2 text-center">
                                            <a href="{{ displayImage($image) }}" download="Affidavit"
                                                class="btn btn-primary btn-block">
                                                <i class="fa fa-download"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </fieldset>

                        <fieldset class="border p-3">
                            <legend class="w-auto px-2">Scan Uploaded</legend>
                            <div class="row">
                                @foreach($candidate->passportDetail->raDocument->scan_notary ?? [] as $image)
                                <div class="col-md-4 mb-4">
                                    <div class="card overflow-hidden" style="height: 300px;">
                                        <div class="img-hover-zoom" style="height: 100%; overflow: hidden;">
                                            <img src="{{ displayImage($image) }}" class="img-fluid w-100">
                                        </div>
                                        <div class="card-body p-2 text-center">
                                            <a href="{{ displayImage($image) }}" download="Scan"
                                                class="btn btn-primary btn-block">
                                                <i class="fa fa-download"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </fieldset>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection