@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $title }}</h3>
          <a href="{{ route('banner.index') }}" type="button" class="btn btn-danger"
            style="float: right;">Back</a>
        </div>
        <form method="POST" action="{{ route('banner.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 col-sm-6 offset-3">
                <div class="form-group">
                    <label>Image </label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input  preview-image" data-preview="#showImg"
                          id="image" name="bannerImg" style="cursor: pointer;">
                        <label class="custom-file-label" for="image">Upload Banner</label>
                      </div>
                    </div>
                    <span class="image_err text-danger error"></span>
                    <small class="form-text text-muted">Allowed JPG or PNG. Max size of 1MB</small>
                    <span id="showImg"></span>
                  </div>
              </div>              
            </div>
            <div class="row">
              <div class="col-lg-12 col-sm-12 text-center">
                <div class="card-footer">
                  <a href="{{ route('banner.index') }}" class="btn btn-primary">Cancel</a>
                  <button type="submit" class="btn btn-success btn-upload-image">Submit</button>
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
@endsection