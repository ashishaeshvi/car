@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
<!-- Content Header (Page header) -->
<style>
  .note-editable {
    height: 204.719px;
  }
</style>
<style>
  .fileinput-button input {
    position: absolute;
    top: 29px;
    opacity: 0;
    cursor: pointer;
    width: inherit;
    height: 44px;
    left: 0px;
  }
</style>
<section @class(['content-header'])>
  <div @class(['container-fluid'])>
    <div @class(['row', 'mb-2' ])>
      <div @class(['col-sm-6'])>
        <h1>{{ $title }}</h1>
      </div>
      <div @class(['col-sm-6'])>
        <ol @class(['breadcrumb', 'float-sm-right' ])>
          <li @class(['breadcrumb-item'])><a href="#">Home</a></li>
          <li @class(['breadcrumb-item', 'active' ])>{{ $title }}</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section @class(['content'])>
  <div @class(['row'])>
    <div @class(['col-md-12'])>
      @if (\Session::has('error'))
      @else
      @if (count($errors) < 0)
        @include('notify')
        @endif
        @endif
        <div @class(['card', 'card-outline' , 'card-info' ])>

        <form method="POST" action="{{ url('blog')}}" enctype="multipart/form-data">
          @csrf
          <div @class(['card-body', 'pad' ])>
            <input type="hidden" name="_url" id="_url" value="{{url('/')}}">

            <div @class(['row'])>
              <div @class(['col-lg-6', 'col-sm-6' ])>
                <div @class(['form-group'])>
                  <label for="exampleInputEmail1">Title </label><span @class(['required'])>*</span>
                  <input type="" name="blog_title" id="title" value="" onblur="MakeSeoNameLink();" @class(['form-control']) placeholder="Blog Title" required />
                </div>
              </div>
              <div @class(['col-lg-6', 'col-sm-6' ])>
                <div @class(['form-group'])>
                  <label for="exampleInputEmail1">Slug Url </label><span @class(['required'])>*</span>
                  <input type="" name="slug_uri" id="slug_uri" value="" onblur="MakeSeoLink(this.value)" @class(['form-control']) placeholder="Slug Url" required />
                  @if ($errors->has('slug_uri'))
                  <span @class(['text-danger'])>{{ $errors->first('slug_uri') }}</span>
                  @endif
                </div>
              </div>
            </div>



            <div @class(['row'])>
              <div @class(['col-lg-12', 'col-sm-12' ])>
                <div @class(['form-group'])>
                  <label for="exampleInputEmail1">Short Description </label><span @class(['required'])>*</span>
                  <textarea @class(['form-control']) name="short_description">{{{ old('short_description')   }}}</textarea>
                </div>
              </div>
            </div>
            <div @class(['row'])>

              <div @class(['row'])>
                <div @class(['col-lg-12', 'col-sm-12' ])>
                  <div @class(['form-group'])>
                    <label for="exampleInputEmail1">Description </label><span @class(['required'])>*</span>
                    <textarea @class(['ckeditor', 'form-control' ]) name="description">{{{ old('description')   }}}</textarea>
                  </div>
                </div>
                <div @class(['col-lg-6', 'col-sm-6' ])>
                  <div @class(['form-group'])>
                    <label for="exampleInputFile">Meta Title</label>
                    <textarea name="meta_title" id="meta_title" @class(['form-control']) placeholder="Meta Title"></textarea>
                  </div>
                </div>
                <div @class(['col-lg-6', 'col-sm-6' ])>
                  <div @class(['form-group'])>
                    <label for="exampleInputFile">Meta Keyword</label>
                    <textarea name="meta_keyword" id="meta_keyword" @class(['form-control']) placeholder="Meta Keyword"></textarea>
                  </div>
                </div>
                <div @class(['col-lg-6', 'col-sm-6' ])>
                  <div @class(['form-group'])>
                    <label for="exampleInputFile">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" @class(['form-control']) placeholder="Meta Description"></textarea>
                  </div>
                </div>
              </div>
              <div @class(['row'])>
                <div @class(['col-lg-6', 'col-sm-6' ])>
                  <div @class(['form-group'])>
                    <label for="exampleInputEmail1">Upload Image</label><span
                      @class(['required'])></span>
                    <br />
                    <input type="file" name="blog_img" accept=".jpg,.jpeg,.png">

                  </div>
                </div>


                <div @class(['col-lg-6', 'col-sm-6' ])>
                  <div @class(['form-group'])>
                    <label for="exampleInputEmail1">Thumbnail Image</label><span
                      @class(['required'])></span>
                    <br />
                    <input type="file" name="blog_thumbnail_img" accept=".jpg,.jpeg,.png">

                  </div>
                </div>

              </div>
            </div>

            <div @class(['row'])>
              <div @class(['col-lg-12', 'col-sm-12' , 'text-center' ])>
                <a href="{{redirect()->getUrlGenerator()->previous()}}" @class(['btn', 'btn-primary' ])>Cancel</a>
                <button type="submit" @class(['btn', 'btn-success' , 'btn-upload-image' ])>Submit</button>
              </div>
            </div><br />
        </form>

    </div>
  </div>
  </div>
  <!-- /.col-->
  </div>


</section>

@endsection