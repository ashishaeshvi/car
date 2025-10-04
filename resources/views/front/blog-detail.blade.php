<!--============================== Content Start ==============================-->
@extends('front.layouts.master')

@section('maincontent')


<!--============================== Content Start ==============================-->
<div class="banner_container">
    <div class="container">
        <div class="row align-items-center" data-aos="fade-in" data-aos-duration="900">
            <div class="col-md-12">
                <h1>Blogs Details</h1>
            </div>
        </div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blogs Details</li>
        </ol>
    </div>
    <div class="banner_bg">
        <img src="{{ asset('front-assets/images/banner-img.avif')}}" alt="">
    </div>
</div>
<!--============================== Content End ==============================-->
<!--============================== Content Start ==============================-->
<div class="content-container">
    <div class="container">
        <div class="row os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
            <div class="col-lg-12">

                <!--============================== Content Start ==============================-->
                <div class="content-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="blog-inner-wrapper">
                                    <div class="blog-inner-img">
                                        <img src="{!! displayImage($blog->blog_img) !!}" alt="">
                                    </div>
                                    <div class="blog-inner-content">
                                        {!! $blog->blog_description !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="blog-right-side-wrapper">
                                    <h4>Recent Blogs</h4>
                                    <ul class="recent-post-list">
                                        @if($recentBlogs->isNotEmpty())
                                        @foreach($recentBlogs as $recent)
                                        <li class="recent-post-item">
                                            <div class="recent-post-box">
                                                <h6><a href="{{ route('news.show', $recent->slug_uri) }}" class="blog-title-right">{{ $recent->blog_title ?? '' }}1</a></h6>
                                                <div class="blog-right-date">{{ $recent->created_at->format('d, F Y') }}</div>
                                                <div class="blog-right-img">
                                                    <img src="{!! displayImage($recent->blog_thumbnail_img) !!}" alt="">
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--============================== Content End ==============================-->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('select:not(.ignore)').niceSelect();
</script>
@endsection