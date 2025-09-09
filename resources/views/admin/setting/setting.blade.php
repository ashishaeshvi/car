@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $title }}</h3>
          <a href="{{route('home')}}" class="btn btn-danger" style="float: right;margin-right:3px;"><i
              class="fa fa-arrow-left fa-xs"></i></a>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('updatesetting') }}" id="settingForm" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group mb-3">
                  <label for="simpleinput">Company Name </label>
                  <input type="text" name="company_name" id="company_name" class="form-control"
                    placeholder="Company Name" value="{{ trim($settings['company_name'] ?? '') !== '' ? trim($settings['company_name']) : '' }}">
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Mobile Number</label>
                  <input type="text" name="web_mobile_number" id="web_mobile_number"
                    class="form-control" placeholder="Mobile Number"
                    value="{{ trim($settings['web_mobile_number'] ?? '') !== '' ? trim($settings['web_mobile_number']) : '' }}">
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Address</label>
                  <textarea name="company_address" id="company_address" class="form-control" placeholder="Address">@if(!empty($settings['company_address'])){{$settings['company_address']}}@endif</textarea>
                </div>

                <div class="form-group mb-3">
                  <label for="simpleinput">Footer Copyright Text</label>
                  <textarea name="copyright_text" id="copyright_text"
                    class="form-control"
                    placeholder="Footer Copyright Text">@if(!empty($settings['copyright_text'])){{$settings['copyright_text']}}@endif</textarea>
                </div>
                <!-- <div class="form-group mb-3">
                  <label for="simpleinput">Footer Description</label>
                  <textarea name="footer_description" id="footer_description"
                    class="form-control"
                    placeholder="Footer Description">@if(!empty($settings['footer_description'])){{$settings['footer_description']}}@endif</textarea>
                </div> -->
              </div>
              <div class="col-lg-6">
                <div class="form-group mb-3">
                  <label for="simpleinput">Email Id</label>
                  <input type="text" name="web_email_id" id="web_email_id"
                    class="form-control" placeholder="Email Id" value="{{ trim($settings['web_email_id'] ?? '') !== '' ? trim($settings['web_email_id']) : '' }}">
                </div>

                
                <div class="form-group mb-3">
                  <label for="exampleInputFile">Logo</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input preview-image" data-preview="#LogoImg" name="website_logo" id="customFile" accept="image/*">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                  </div>
                  <span > &nbsp;</span>
                 
                  <div id="LogoImg">
                    @isset($settings['website_logo'])
                    @php $website_logo = $settings['website_logo']; @endphp                   
                    <img src="{{ displayImage($website_logo) }}" width="100" height="100" />
                    @endisset
                  </div>
                </div>                
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-sm-12 text-center">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}"
                  class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
    <!-- /.col-->
</section>
@endsection


@section('scripts')
<script src="{{ asset('admin-assets/scripts/settings.js') }}"></script>
</script>
@endsection