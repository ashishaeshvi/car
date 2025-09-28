@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')

<section @class(['content-header'])>
    <div @class(['row'])>
        <div @class(['col-md-12'])>
            <div @class(['card'])>
                <div @class(['card-header'])>
                    <h3 @class(['card-title'])>{{ $title }}</h3>
                    <a href="{{ route('cars.index') }}" type="button" @class(['btn', 'btn-danger' , 'float-right' ])>Back</a>
                </div>
                <form method="POST" action="{{  route('cars.add-gallery', $carId)  }}"  enctype="multipart/form-data">
                    @csrf
                    <div @class(['card-body'])>
                        <div @class(['row'])>
                            <div @class(['col-lg-6'])>
                                <div @class(['form-group'])>
                                    <label>Gallery Image</label>
                                    <input type="file" name="gallery_image"
                                        @class(['form-control-file']) accept=".jpg,.jpeg,.png">
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div @class(['card-footer', 'text-center' ])>
                        <a href="{{ route('cars.index') }}" @class(['btn', 'btn-secondary' ])>Cancel</a>
                        <button type="submit" @class(['btn', 'btn-success' ])>
                            <i @class(['fa', 'fa-check-circle' ])></i> {{ 'Add Image' }}
                        </button>
                    </div>
                </form>
                <div @class(['col-md-12'])>
                    @if(isset($carGallery) && $carGallery && $carGallery->count())
                    <div @class(['row', 'mt-3' ])>
                        @foreach($carGallery as $gallery)
                        <div @class(['col-lg-3', 'col-md-4' , 'col-sm-6' , 'mb-3' , 'position-relative' ])>
                            <img src="{{ asset('storage/' . $gallery->image) }}"
                                @class(['img-fluid', 'rounded' , 'border' ])
                                alt="Car Image">

                            <form action="{{ route('car-galleries.destroy', encrypt($gallery->id)) }}"
                                method="POST"
                                @class(['position-absolute'])
                                style="top:5px; right:5px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" @class(['btn', 'btn-sm' , 'btn-danger' ])
                                    onclick="return confirm('Are you sure you want to delete this image?')">
                                    <i @class(['fa', 'fa-trash' ])></i>
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection