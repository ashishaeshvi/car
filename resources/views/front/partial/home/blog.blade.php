@if($blogs && $blogs->count() > 0)
<div class="content-container">
    <div class="container">
        <div class="row os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
            <div class="col-lg-12">
                <div class="heading">
                    <h3>News to help choose your car</h3>
                </div>

                <ul class="blog-list">
                    @foreach($blogs->take(3) as $blog) {{-- Show only first 3 --}}
                    <li class="blog-item os-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.1s">
                        <div class="blog-box">
                            <div class="blog-img">
                                <img src="{!! displayImage($blog->blog_thumbnail_img) !!}" alt="">
                                <span class="blog-post-data">{{ $blog->created_at->format('F d, Y') }}</span>
                                <span class="blog-post-by">{{ $blog->author ?? 'Admin' }}</span>
                            </div>
                            <div class="blog-content">
                                <h5>{{ $blog->blog_title ?? '' }}</h5>
                                <p>{{ limit_words($blog->short_description, 200) }}</p>
                            </div>
                            <div class="blog-cta">
                                <a href="{{ route('news.show', $blog->slug_uri) }}" class="blog-btn">Know More</a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

                {{-- Show button only if more than 3 blogs exist --}}
                @if($blogs->count() > 3)
                <div class="blog-cta text-center mt-3">
                    <a href="{{ route('news.index') }}" class="cars-category-btn">View More Blog</a>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endif

