@if(($adsBanners['home_left'] ?? null) || ($adsBanners['home_right'] ?? null))
<div class="content-container pb-0">
    <div class="container">
        <div class="row os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">  
            <!-- Left Banner -->
            @if($adsBanners['home_left']?->adsImg)
            <div class="col-lg-6">
                <div class="add-img">
                    <img src="{{ asset('storage/' . $adsBanners['home_left']->adsImg) }}" alt="Home Left Banner">
                </div>
            </div>
            @endif
            <!-- Right Banner -->
            @if($adsBanners['home_right']?->adsImg)
            <div class="col-lg-6">
                <div class="add-img mt-3 mt-lg-0">
                    <img src="{{ asset('storage/' . $adsBanners['home_right']->adsImg) }}" alt="Home Right Banner">
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endif