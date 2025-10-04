@if($adbanner && $adbanner->adsImg)
<div class="content-container pb-0">
    <div class="container">
        <div class="row os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">            
            <div class="col-lg-12">
                <div class="add-img">
                    <img src="{{ asset('storage/' . $adbanner->adsImg) }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
@endif
