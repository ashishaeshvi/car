<!--============================== Content Start ==============================-->
@extends('front.layouts.master')

@section('maincontent')

<div class="content-container hero-banner">
    <div class="container">
        <div class="row os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
            <div class="col-lg-10 offset-lg-1">
                <div class="hero-content">
                    <h1>Find your right car</h1>
                    <div class="hero-tb">
                        <div class="radio-tabs" role="tablist">
                            <label class="radio-tab active">
                                <input type="radio" name="property-type" value="rent" checked data-bs-target="#nav-rent">
                                <span>New</span>
                            </label>
                            <label class="radio-tab">
                                <input type="radio" name="property-type" value="sale" data-bs-target="#nav-sale">
                                <span>Used</span>
                            </label>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-rent" role="tabpanel" aria-labelledby="nav-rent-tab">
                                <div class="search-box">
                                    <div class="search-wrapper">
                                        <div class="search-box-list">
                                            <div class="search-box-item">
                                                <div class="search-box-input">
                                                    <select class="form-control">
                                                        <option value="">Select Budget</option>
                                                        <option value="">1.2 Lakh to 2.3Lakh</option>
                                                        <option value="">1.2 Lakh to 2.3Lakh</option>
                                                        <option value="">1.2 Lakh to 2.3Lakh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="search-box-item">
                                                <div class="search-box-input">
                                                    <select class="form-control">
                                                        <option value="">All Vehicle Type</option>
                                                        <option value="">1.2 Lakh to 2.3Lakh</option>
                                                        <option value="">1.2 Lakh to 2.3Lakh</option>
                                                        <option value="">1.2 Lakh to 2.3Lakh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="search-box-item">
                                                <div class="search-box-btn">
                                                    <button class="btn btn-primary btn-block">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-sale" role="tabpanel" aria-labelledby="nav-sale-tab">
                                <div class="search-box">
                                    <div class="search-wrapper">
                                        <div class="search-box-list">
                                            <div class="search-box-item">
                                                <div class="search-box-input">
                                                    <select class="form-control">
                                                        <option value="">Select Budget</option>
                                                        <option value="">1.2 Lakh to 2.3Lakh</option>
                                                        <option value="">1.2 Lakh to 2.3Lakh</option>
                                                        <option value="">1.2 Lakh to 2.3Lakh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="search-box-item">
                                                <div class="search-box-input">
                                                    <select class="form-control">
                                                        <option value="">Select All Vehicle Type</option>
                                                        <option value="">1.2 Lakh to 2.3Lakh</option>
                                                        <option value="">1.2 Lakh to 2.3Lakh</option>
                                                        <option value="">1.2 Lakh to 2.3Lakh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="search-box-item">
                                                <div class="search-box-btn">
                                                    <button class="btn btn-primary btn-block">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-img">
        
       <img src="{{ $banner && $banner->bannerImg ? asset('storage/' . $banner->bannerImg) : asset('front-assets/images/banner-img.avif') }}" alt="Banner">

    </div>
</div>
<!--============================== Content End ==============================-->
<!--============================== Content Start ==============================-->
<div class="content-container">
    <div class="container">
        <div class="row os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
            <div class="col-lg-12">
                <div class="heading">
                    <h3>Cars by Budget</h3>
                </div>
                <div class="cars-category">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Cars Under 10 Lakh</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">10-20 Lakh</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">20-30 Lakh</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="cars-category-list pb-0 cars-category-slider">
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="cars-category-list pb-0 cars-category-slider">
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="cars-category-list pb-0 cars-category-slider">
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--============================== Content End ==============================-->
<!--============================== Content Start ==============================-->
<div class="content-container py-5 grey-bg overflow-hidden">
    <div class="container">
        <div class="row os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
            <div class="col-lg-12">
                <div class="heading">
                    <h3>Recent View</h3>
                </div>
                <div class="trending-car-list pb-0 trending-cars-slider">
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Thar Roxx</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Honda City</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Kia Selto</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Tata Nexon</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Hyundai Creta</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Thar Roxx</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Thar Roxx</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Thar Roxx</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Thar Roxx</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--============================== Content End ==============================-->
<!--============================== Content Start ==============================-->
  @include('front.partial.home.top-ads',['adbanner' => $adsBanners['home_top'] ?? null])
<!--============================== Content End ==============================-->
<!--============================== Content Start ==============================-->
<div class="content-container">
    <div class="container">
        <div class="row os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
            <div class="col-lg-12">
                <div class="heading">
                    <h3>Latest cars</h3>
                </div>
                <div class="cars-category">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-one-tab" data-bs-toggle="pill" data-bs-target="#pills-one" type="button" role="tab" aria-controls="pills-one" aria-selected="true">Cars Under 10 Lakh</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-two-tab" data-bs-toggle="pill" data-bs-target="#pills-two" type="button" role="tab" aria-controls="pills-two" aria-selected="false">10-20 Lakh</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-three-tab" data-bs-toggle="pill" data-bs-target="#pills-three" type="button" role="tab" aria-controls="pills-three" aria-selected="false">20-30 Lakh</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab">
                            <div class="cars-category-list pb-0 cars-category-slider">
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
                            <div class="cars-category-list pb-0 cars-category-slider">
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-three" role="tabpanel" aria-labelledby="pills-three-tab">
                            <div class="cars-category-list pb-0 cars-category-slider">
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cars-category-item">
                                    <div class="cars-category-box">
                                        <div class="cars-category-img">
                                            <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                        </div>
                                        <div class="cars-category-content">
                                            <h5 class="cars-category-name">Tata Nexon</h5>
                                            <h6 class="cars-category-price">10-20 Lakh</h6>
                                            <a href="#!" class="cars-category-btn">View Price Breakup</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--============================== Content End ==============================-->
<!--============================== Content Start ==============================-->
<div class="content-container py-5 grey-bg overflow-hidden">
    <div class="container">
        <div class="row os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
            <div class="col-lg-12">
                <div class="heading">
                    <h3>Trendings cars</h3>
                </div>
                <div class="trending-car-list pb-0 trending-cars-slider">
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Thar Roxx</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Honda City</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Kia Selto</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Tata Nexon</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Hyundai Creta</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Thar Roxx</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Thar Roxx</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Thar Roxx</h6>
                            </div>
                        </a>
                    </div>
                    <div class="trending-car-item">
                        <a href="#!" class="trending-car-box">
                            <div class="trending-car-img">
                                <img src="https://imgd.aeplcdn.com/144x81/n/cw/ec/124839/thar-roxx-exterior-right-front-three-quarter-26.png?isig=0&q=80" alt="">
                            </div>
                            <div class="trending-card-content">
                                <h6>Thar Roxx</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--============================== Content End ==============================-->
<!--============================== Content Start ==============================-->
<div class="content-container pb-0">
    <div class="container">
        <div class="row os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
            <div class="col-lg-12">
                <div class="heading">
                    <h3>Compare cars</h3>
                </div>
                <div class="cars-category">
                    <div class="cars-category-list cars-compare-slider pb-0 ">
                        <div class="cars-category-item">
                            <div class="cars-category-box">
                                <div class="cars-category-box-compare position-relative">
                                    <div class="cars-category-box-compare-left">
                                        <div class="cars-category-box-compare-content">
                                            <div class="cars-category-img-compare">
                                                <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                            </div>
                                            <h4>Tata <span> Nexon</span></h4>
                                            <p>Rs. 8.00 Lakh</p>
                                            <p>onwards</p>
                                        </div>
                                    </div>
                                    <div class="cars-category-box-compare-right">
                                        <div class="cars-category-box-compare-content">
                                            <div class="cars-category-img-compare">
                                                <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                            </div>
                                            <h4>Tata <span> Nexon</span></h4>
                                            <p>Rs. 8.00 Lakh</p>
                                            <p>onwards</p>
                                        </div>
                                    </div>
                                    <span>vs</span>
                                </div>
                                <div class="cars-category-content">
                                    <a href="#!" class="cars-category-btn">Compare Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="cars-category-item">
                            <div class="cars-category-box">
                                <div class="cars-category-box-compare position-relative">
                                    <div class="cars-category-box-compare-left">
                                        <div class="cars-category-box-compare-content">
                                            <div class="cars-category-img-compare">
                                                <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                            </div>
                                            <h4>Tata <span> Nexon</span></h4>
                                            <p>Rs. 8.00 Lakh</p>
                                            <p>onwards</p>
                                        </div>
                                    </div>
                                    <div class="cars-category-box-compare-right">
                                        <div class="cars-category-box-compare-content">
                                            <div class="cars-category-img-compare">
                                                <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                            </div>
                                            <h4>Tata <span> Nexon</span></h4>
                                            <p>Rs. 8.00 Lakh</p>
                                            <p>onwards</p>
                                        </div>
                                    </div>
                                    <span>vs</span>
                                </div>
                                <div class="cars-category-content">
                                    <a href="#!" class="cars-category-btn">Compare Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="cars-category-item">
                            <div class="cars-category-box">
                                <div class="cars-category-box-compare position-relative">
                                    <div class="cars-category-box-compare-left">
                                        <div class="cars-category-box-compare-content">
                                            <div class="cars-category-img-compare">
                                                <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                            </div>
                                            <h4>Tata <span> Nexon</span></h4>
                                            <p>Rs. 8.00 Lakh</p>
                                            <p>onwards</p>
                                        </div>
                                    </div>
                                    <div class="cars-category-box-compare-right">
                                        <div class="cars-category-box-compare-content">
                                            <div class="cars-category-img-compare">
                                                <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                            </div>
                                            <h4>Tata <span> Nexon</span></h4>
                                            <p>Rs. 8.00 Lakh</p>
                                            <p>onwards</p>
                                        </div>
                                    </div>
                                    <span>vs</span>
                                </div>
                                <div class="cars-category-content">
                                    <a href="#!" class="cars-category-btn">Compare Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="cars-category-item">
                            <div class="cars-category-box">
                                <div class="cars-category-box-compare position-relative">
                                    <div class="cars-category-box-compare-left">
                                        <div class="cars-category-box-compare-content">
                                            <div class="cars-category-img-compare">
                                                <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                            </div>
                                            <h4>Tata <span> Nexon</span></h4>
                                            <p>Rs. 8.00 Lakh</p>
                                            <p>onwards</p>
                                        </div>
                                    </div>
                                    <div class="cars-category-box-compare-right">
                                        <div class="cars-category-box-compare-content">
                                            <div class="cars-category-img-compare">
                                                <img src="https://imgd.aeplcdn.com/320x180/n/cw/ec/141867/nexon-exterior-right-front-three-quarter-76.jpeg?isig=0&q=80" alt="">
                                            </div>
                                            <h4>Tata <span> Nexon</span></h4>
                                            <p>Rs. 8.00 Lakh</p>
                                            <p>onwards</p>
                                        </div>
                                    </div>
                                    <span>vs</span>
                                </div>
                                <div class="cars-category-content">
                                    <a href="#!" class="cars-category-btn">Compare Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--============================== Content End ==============================-->
<!--============================== Content Start ==============================-->
  @include('front.partial.home.bottom-ads',['adbanner' => $adsBanners ?? null])
<!--============================== Content End ==============================-->
<!--============================== Content Start ==============================-->
 @include('front.partial.home.blog',['blogs' => $blogs ?? null])

<!--============================== Content End ==============================-->
<!-- LOGIN Modal -->

<!-- REGISTRATION Modal -->
<div class="cts-model cts-type-2">
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Register on CarWale</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="login-signup">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Full Name">
                        </div>
                        <div class="form-group mt-3">
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="login-cta mt-4">
                            <button class="btn btn-default btn-block">Register</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection