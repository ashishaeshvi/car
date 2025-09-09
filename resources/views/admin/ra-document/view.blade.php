@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
<section class="content-header">
    @if(session()->has("success"))
    <div class="alert alert-success alert-dismissible fade show fw-bold mt-2" role="alert">
        {{session("success")}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" title="Close"></button>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> </h3>
                    <a href="{{ route('ra-document.index') }}" class="btn btn-danger"
                        style="float: right;margin-right:3px;"><i class="fa fa-arrow-left fa-xs"></i>
                        {{ __('Back') }}</a>
                </div>
                <div class="card-body">
                    {{-- Personal Details --}}
                    <fieldset class="border p-3 mb-4">

                        <div class="row mb-2">
                            <div class="col-md-4"><strong>RA Name:</strong>
                                <span onclick="copyContent(this)" style="cursor: pointer;"> {{ $raDocument->ra_name }}
                                    <i class="far fa-copy text-primary" title="copy"></i></span>
                            </div>
                            <div class="col-md-4"><strong>RA Name Hindi:</strong>
                                <span onclick="copyContent(this)" style="cursor: pointer;"> {{
                                    $raDocument->ra_name_hindi }} <i class="far fa-copy text-primary"
                                        title="copy"></i></span>
                            </div>
                            <div class="col-md-4"><strong>Agency Name:</strong>
                                <span onclick="copyContent(this)" style="cursor: pointer;"> {{ $raDocument->agency_name
                                    }}
                                    <i class="far fa-copy text-primary" title="copy"></i></span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4"><strong>Registration No:</strong>
                                <span onclick="copyContent(this)" style="cursor: pointer;"> {{
                                    $raDocument->registration_no
                                    }} <i class="far fa-copy text-primary" title="copy"></i></span>
                            </div>
                            <div class="col-md-4"><strong>Status:</strong>
                                <span onclick="copyContent(this)" style="cursor: pointer;"> {{
                                    ucfirst($raDocument->status)
                                    }} <i class="far fa-copy text-primary" title="copy"></i></span>
                            </div>
                            <div class="col-md-4"><strong>Address:</strong>
                                <span onclick="copyContent(this)" style="cursor: pointer;"> {{ $raDocument->address
                                    }} <i class="far fa-copy text-primary" title="copy"></i></span>
                            </div>

                        </div>

                    </fieldset>



                    {{-- Attachments --}}
                    <fieldset class="border p-3">
                        <legend class="w-auto px-2">Attachment</legend>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="mb-2"><strong>RA Sign:</strong></div>
                                <div><img src="{{ displayImage($raDocument->ra_sign) }}" width="200px">

                                    <div class="card-body  ">
                                        <a href="{{ displayImage($raDocument->ra_sign) }}" download="RA Sign"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2"><strong>RA Stamp:</strong></div>
                                <div><img src="{{ displayImage($raDocument->ra_stamp) }}" width="200px">

                                    <div class="card-body  ">
                                        <a href="{{ displayImage($raDocument->ra_stamp) }}" download="RA Stamp"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-2">

                            <div class="col-md-6">
                                <div class="mb-2"><strong>Letterpad Header:</strong></div>
                                <div><img src="{{ displayImage($raDocument->letterpad_logo) }}" width="200px">
                                    <div class="card-body  ">
                                        <a href="{{ displayImage($raDocument->letterpad_logo) }}"
                                            download="Letterpad Header" class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2"><strong>Letterpad Footer:</strong></div>
                                <div><img src="{{ displayImage($raDocument->letterpad_footer) }}" width="200px">

                                    <div class="card-body  ">
                                        <a href="{{ displayImage($raDocument->letterpad_footer) }}"
                                            download="Letterpad Footer" class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <fieldset class="border p-3">
                            <legend class="w-auto px-2">Affidavit Uploaded</legend>
                            <div class="row">
                                @foreach($raDocument->affidavit_notary ?? [] as $image)
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
                                @foreach($raDocument->scan_notary ?? [] as $image)
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
</script>
@endsection