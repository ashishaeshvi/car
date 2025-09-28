@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $title }}</h3>
          <a href="{{ route('adsbanner.index') }}" type="button" class="btn btn-danger" style="float: right;">Back</a>
        </div>
        <form method="POST" action="{{ route('adsbanner.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="card-body">

            <!-- Banner Image -->
            <div class="row">
              <div class="col-lg-6 col-sm-6 offset-3">
                <div class="form-group">
                    <label>Banner Image <span @class(['text-danger'])>*</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input preview-image" data-preview="#showImg"
                          id="image" name="adsImg" accept=".png, .jpg, .jpeg" style="cursor: pointer;">
                        <label class="custom-file-label" for="image">Upload Banner</label>
                      </div>
                    </div>
                    <span class="image_err text-danger error"></span>
                    <small class="form-text text-muted">Allowed JPG or PNG. Max size of 1MB</small>
                    <span id="showImg"></span>
                </div>
              </div>              
            </div>

            <!-- Banner Position -->
            <div class="row">
              <div class="col-lg-6 col-sm-6 offset-3">
                <div class="form-group">
                  <label>Banner Position <span @class(['text-danger'])>*</span></label>
                  <select name="position" class="form-control" required>
                    <option value="">Select Position</option>
                    <option value="home_top">Home Page Top</option>
                    <option value="home_left">Home Page Left</option>
                    <option value="home_right">Home Page Right</option>
                    <option value="sidebar_top">Sidebar Top</option>
                    <option value="sidebar_bottom">Sidebar Bottom</option>
                    <!-- Add more positions if needed -->
                  </select>
                  <span class="position_err text-danger error"></span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12 col-sm-12 text-center">
                <div class="card-footer">
                  <a href="{{ route('adsbanner.index') }}" class="btn btn-primary">Cancel</a>
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
<script>
  // Preview image before upload
  $('.preview-image').on('change', function(){
      let previewId = $(this).data('preview');
      let file = this.files[0];
      if(file){
          let reader = new FileReader();
          reader.onload = function(e){
              $(previewId).html('<img src="'+e.target.result+'" alt="banner" class="img-fluid mt-2" style="max-height:200px;">');
          }
          reader.readAsDataURL(file);
      }
  });
</script>
@endsection
