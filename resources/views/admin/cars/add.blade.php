@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
<section @class(['content-header'])>
    <div @class(['row'])>
        <div @class(['col-md-12'])>
            <div @class(['card'])>
                <div @class(['card-header'])>
                    <h3 @class(['card-title'])>{{ $title }}</h3>
                    <a href="{{ route('cars.index') }}" type="button" @class(['btn', 'btn-danger', 'float-right'])>Back</a>
                </div>

                <form id="CarForm" method="POST" action="{{ route('cars.storeOrUpdate', isset($car) ? $car->id : '') }}" enctype="multipart/form-data">
                    @csrf
                    <div @class(['card-body'])>

                        {{-- Nav Tabs --}}
                        <ul @class(['nav', 'nav-tabs']) id="carTabs" role="tablist">
                            <li @class(['nav-item'])>
                                <a @class(['nav-link', 'active']) id="carinfo-tab" data-toggle="tab" href="#carinfo" role="tab">Car Info</a>
                            </li>
                            <li @class(['nav-item'])>
                                <a @class(['nav-link']) id="specs-tab" data-toggle="tab" href="#specs" role="tab">Specifications</a>
                            </li>
                            <li @class(['nav-item'])>
                                <a @class(['nav-link']) id="features-tab" data-toggle="tab" href="#features" role="tab">Features</a>
                            </li>
                            <li @class(['nav-item'])>
                                <a @class(['nav-link']) id="docs-tab" data-toggle="tab" href="#docs" role="tab">Documents</a>
                            </li>
                            <li @class(['nav-item'])>
                                <a @class(['nav-link']) id="gallery-tab" data-toggle="tab" href="#gallery" role="tab">Gallery & 360°</a>
                            </li>
                        </ul>

                        {{-- Tab Content --}}
                        <div @class(['tab-content', 'mt-3'])>

                            {{-- Car Info Tab --}}
                            <div @class(['tab-pane', 'fade', 'show', 'active']) id="carinfo" role="tabpanel">
                                <div @class(['row'])>



                                <div @class(['col-lg-4', 'col-sm-4'])>
                                    <div @class(['form-group'])>
                                        <label>Dealer <span @class(['text-danger'])>*</span></label>
                                        <select name="dealer" @class(['form-control']) required>
                                            <option value="">-- Select Dealer --</option>
                                            @foreach($dealers as $dealer)
                                                <option value="{{ $dealer->id }}" {{ old('dealer', isset($car) ? $car->dealer_id : '') == $dealer->id ? 'selected' : '' }}>
                                                    {{ $dealer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span @class(['text-danger'])>{{ $errors->first('dealer') }}</span>
                                    </div>
                                </div>


                                    <div @class(['col-lg-4', 'col-sm-4'])>
                                        <div @class(['form-group'])>
                                            <label>Car Name / Model <span @class(['text-danger'])>*</span></label>
                                            <input type="text" name="car_name" @class(['form-control']) placeholder="Enter Car Name" value="{{ old('car_name', $car->car_name ?? '') }}" required>
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4'])>
                                        <div @class(['form-group'])>
                                            <label>Brand <span @class(['text-danger'])>*</span></label>
                                            <input type="text" name="brand" @class(['form-control']) placeholder="Enter Brand" value="{{ old('brand', $car->brand ?? '') }}" required>
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4'])>
                                        <div @class(['form-group'])>
                                            <label>Variant</label>
                                            <input type="text" name="variant" @class(['form-control']) placeholder="Enter Variant" value="{{ old('variant', $car->variant ?? '') }}">
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4'])>
                                        <div @class(['form-group'])>
                                            <label>Price <span @class(['text-danger'])>*</span></label>
                                            <input type="number" step="0.01"   name="price" @class(['form-control']) placeholder="Enter Price" value="{{ old('price', $car->price ?? '') }}" required>
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4'])>
                                        <div @class(['form-group'])>
                                            <label>Registration Year <span @class(['text-danger'])>*</span></label>
                                            <input type="text" name="registration_year"  @class(['form-control']) placeholder="Feb 2025"  value="{{ old('registration_year', $car->registration_year ?? '') }}" required>
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4'])>
                                        <div @class(['form-group'])>
                                            <label>Year of Manufacture <span @class(['text-danger'])>*</span></label>
                                            <input type="text" name="manufacture_year" maxlength="4" @class(['form-control']) placeholder="YYYY"  value="{{ old('manufacture_year', $car->manufacture_year ?? '') }}" required>
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4'])>
                                        <div @class(['form-group'])>
                                            <label>Car Condition <span @class(['text-danger'])>*</span></label>
                                            <select name="car_condition" @class(['form-control']) required>
                                                <option value="">Select</option>
                                                <option value="new" {{ old('car_condition', isset($car) ? $car->car_condition : '') == 'New' ? 'selected' : '' }}>New</option>
                                                <option value="used" {{ old('car_condition', isset($car) ? $car->car_condition : '') == 'Used' ? 'selected' : '' }}>Used</option>
                                            </select>
                                        </div>
                                    </div>





                                     <div @class(['col-lg-4', 'col-sm-4'])>
                                        <div @class(['form-group'])>
                                            <label>Ownership <span @class(['text-danger'])>*</span></label>
                                            <input type="text" name="ownership"  @class(['form-control']) placeholder="" value="{{ old('ownership', $car->ownership ?? '') }}" required>
                                        </div>
                                    </div>


                                     <div @class(['col-lg-4', 'col-sm-4'])>
                                        <div @class(['form-group'])>
                                            <label>RTO <span @class(['text-danger'])>*</span></label>
                                            <input type="text" name="rto"  @class(['form-control']) placeholder="" value="{{ old('rto', $car->rto ?? '') }}" required>
                                        </div>
                                    </div>


                                    <div @class(['col-lg-4', 'col-sm-4'])>
                                        <div @class(['form-group'])>
                                            <label>Car Image <span @class(['text-danger'])>*</span></label>
                                            <input type="file" name="car_image" @class(['form-control']) accept=".jpg,.jpeg,.png" @if(!isset($car)) required @endif>
                                            <span @class(['text-danger'])>{{ $errors->first('car_image') }}</span>

                                             @if(isset($car) && $car->car_image)
                                        <img src={!! displayImage($car->car_image) !!} width="100"
                                        @class(['mt-2'])>
                                        @endif
                                        </div>
                                    </div>




                                </div>


                                <div @class(['col-lg-12', 'col-sm-12'])>
                                <div @class(['form-group'])>
                                    <label for="exampleInputEmail1">Description</label><span
                                        @class(['required'])></span>
                                    <textarea @class(['ckeditor']) name="description"  
                                        placeholder="Your description"
                                        style="height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                        >{{ old('description', $car->description ?? '') }}</textarea>
                                       
                                </div>
                            </div>
                                <button type="button" @class(['btn', 'btn-primary', 'float-right']) id="nextCarInfo">Next</button>
                            </div>

                            {{-- Specifications Tab --}}
                            <div @class(['tab-pane', 'fade']) id="specs" role="tabpanel">
                                <div @class(['row'])>
                                    

                                    
                                   
<div @class(['col-lg-4', 'col-sm-4'])>
    <div @class(['form-group'])>
        <label>Fuel Type <span @class(['text-danger'])>*</span></label>
        <select name="fuel_type" @class(['form-control']) required>
            <option value="">Select Fuel</option>
            <option value="Petrol" {{ old('fuel_type', $car->specifications->fuel_type ?? '') == 'Petrol' ? 'selected' : '' }}>Petrol</option>
            <option value="Diesel" {{ old('fuel_type', $car->specifications->fuel_type ?? '') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
            <option value="CNG" {{ old('fuel_type', $car->specifications->fuel_type ?? '') == 'CNG' ? 'selected' : '' }}>CNG</option>
            <option value="Electric" {{ old('fuel_type', $car->specifications->fuel_type ?? '') == 'Electric' ? 'selected' : '' }}>Electric</option>
        </select>
    </div>
</div>

<div @class(['col-lg-4', 'col-sm-4'])>
    <div @class(['form-group'])>
        <label>Transmission <span @class(['text-danger'])>*</span></label>
        <select name="transmission" @class(['form-control']) required>
            <option value="">Select</option>
            <option value="Manual" {{ old('transmission', $car->specifications->transmission ?? '') == 'Manual' ? 'selected' : '' }}>Manual</option>
            <option value="Automatic" {{ old('transmission', $car->specifications->transmission ?? '') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
        </select>
    </div>
</div>

<div @class(['col-lg-4', 'col-sm-4'])>
    <div @class(['form-group'])>
        <label>Engine CC</label>
        <input type="text" name="engine_cc"  oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric" @class(['form-control']) 
            placeholder="e.g. 1200" 
            value="{{ old('engine_cc', $car->specifications->engine_cc ?? '') }}">
    </div>
</div>

<div @class(['col-lg-4', 'col-sm-4'])>
    <div @class(['form-group'])>
        <label>Mileage (kmpl)</label>
        <input type="text" name="mileage"  oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric" @class(['form-control']) 
            placeholder="e.g. 18" 
            value="{{ old('mileage', $car->specifications->mileage ?? '') }}">
    </div>
</div>

<div @class(['col-lg-4', 'col-sm-4'])>
    <div @class(['form-group'])>
        <label>Seating Capacity</label>
        <input type="text"  oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric" name="seating_capacity" @class(['form-control']) 
            placeholder="e.g. 5" 
            value="{{ old('seating_capacity', $car->specifications->seating_capacity ?? '') }}">
    </div>
</div>

<div @class(['col-lg-4', 'col-sm-4'])>
    <div @class(['form-group'])>
        <label>Color</label>
        <input type="text" name="color" @class(['form-control']) 
            placeholder="Enter Color" 
            value="{{ old('color', $car->specifications->color ?? '') }}">
    </div>
</div>

                                   

                                    

                                    
                                </div>
                                <button type="button" @class(['btn', 'btn-primary', 'float-right']) id="nextSpecs">Next</button>
                            </div>

                            {{-- Features Tab --}}
                            <div @class(['tab-pane', 'fade']) id="features" role="tabpanel">
                                <div @class(['row'])>
                                    <div @class(['col-lg-12'])>
                                        <label>Select Features:</label><br>
                                        @php
                                            $featuresList = ['Airbags', 'ABS', 'Power Steering', 'Sunroof', 'Touchscreen', 'Rear Camera'];
                                       
                                        $savedFeatures = explode(',', $car->features ?? '');
                                       @endphp

                                    @foreach($featuresList as $feature)
                                        <div @class(['form-check', 'form-check-inline'])>
                                            <input type="checkbox" name="features[]" value="{{ $feature }}"
                                                @class(['form-check-input'])
                                                {{ in_array($feature, $savedFeatures) ? 'checked' : '' }}>
                                            {{ $feature }}
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                                <button type="button" @class(['btn', 'btn-primary', 'float-right']) id="nextFeatures">Next</button>
                            </div>

                            {{-- Documents Tab --}}
                            <div @class(['tab-pane', 'fade']) id="docs" role="tabpanel">
                                <div @class(['row'])>
                                    <div @class(['col-lg-4'])>
                                        <div @class(['form-group'])>
                                            <label>RC Copy</label>
                                            <input type="file" name="rc_copy" @class(['form-control-file'])  accept=".jpg,.jpeg,.png,.pdf">
                                         @if(isset($car) && $car->rc_copy)
                                        <a href={!! displayImage($car->rc_copy) !!} @class(['mt-2'])
                                            download="">Download</a>
                                        @endif
                                        </div>
                                    </div>
                                    <div @class(['col-lg-4'])>
                                        <div @class(['form-group'])>
                                            <label>Insurance</label>
                                            <input type="file" name="insurance_doc" @class(['form-control-file'])  accept=".jpg,.jpeg,.png,.pdf">
                                         @if(isset($car) && $car->insurance_doc)
                                        <a href={!! displayImage($car->insurance_doc) !!} @class(['mt-2'])
                                            download="">Download</a>
                                        @endif
                                        </div>
                                    </div>
                                    <div @class(['col-lg-4'])>
                                        <div @class(['form-group'])>
                                            <label>Pollution Certificate</label>
                                            <input type="file" name="pollution" @class(['form-control-file'])  accept=".jpg,.jpeg,.png,.pdf">
                                         @if(isset($car) && $car->pollution)
                                        <a href={!! displayImage($car->pollution) !!} @class(['mt-2'])
                                            download="">Download</a>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="button" @class(['btn', 'btn-primary', 'float-right']) id="nextDocs">Next</button>
                            </div>

                            {{-- Gallery & 360° Tab --}}
                            <div @class(['tab-pane', 'fade']) id="gallery" role="tabpanel">
                                <div @class(['row'])>
                                    <div @class(['col-lg-6'])>
                                        <div @class(['form-group'])>
                                            <label>Gallery Image</label>
                                            <input type="file" name="gallery_image[]" multiple="" @class(['form-control-file']) accept=".jpg,.jpeg,.png">
                                        </div>
                                    </div>
                                    <div @class(['col-lg-6'])>
                                        <div @class(['form-group'])>
                                            <label>360° Image</label>
                                            <input type="file" name="image_360" @class(['form-control-file'])  accept=".jpg,.jpeg,.png">
                                         <small @class(['form-text', 'text-muted'])>Allowed JPG or PNG. Max size of 2MB</small>
                                    
                                        @if(isset($car) && $car->image_360)
                                        <img src={!! displayImage($car->image_360) !!} width="100"
                                        @class(['mt-2'])>
                                        @endif
                                   
                                        </div>
                                    </div>
                                </div>
                                <div @class(['card-footer', 'text-center'])>
                                    <a href="{{ route('cars.index') }}" @class(['btn', 'btn-secondary'])>Cancel</a>
                                    <button type="submit" @class(['btn', 'btn-success'])>
                                        <i @class(['fa', 'fa-check-circle'])></i> {{ isset($car) ? 'Update Car' : 'Add Car' }}
                                    </button>
                                </div>
                            </div>

                        </div>
                        {{-- End Tab Content --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<input type="hidden" name="existing_car_image" value="{{ $car->car_image ?? '' }}">

@endsection
@section('scripts')
{{-- Tab Validation Script --}}
<script>
    function validateFields(selectors) {
    let isValid = true;
    let failedFields = [];

   selectors.forEach(selector => {
    const field = $(selector);
    const fieldName = field.attr("name") || "This field";
    const errorMsg = `${fieldName.replace(/_/g, " ")} is required`;

    // remove any existing error message
   field.siblings(".error-message").remove(); 

    if (!field.val() || field.val().trim() === "") {
        isValid = false;
        failedFields.push(selector);

        // custom red border for invalid fields
        field.css("border", "1px solid red");

        // add error message
        field.after(`<div @class(['error-message']) style="color:red;font-size:13px;">${errorMsg}</div>`);
    } else {
        // reset border if valid
        field.css("border", "");
    }
});


    return { isValid, failedFields };
}

    $('#nextCarInfo').click(function() {
    const { isValid, failedFields } = validateFields([
        'select[name="dealer"]',
        'input[name="car_name"]',
        'input[name="brand"]',
        'input[name="price"]',
        'input[name="manufacture_year"]',
        'input[name="registration_year"]',
        'input[name="ownership"]',
        'input[name="rto"]',
        'select[name="car_condition"]',
       
    ]);

    const hasExistingImage = $('input[name="existing_car_image"]').length > 0;

if (!hasExistingImage) {
    fields.push('input[name="car_image"]');
}
    console.log("Validation Result:", isValid);
    if (!isValid) {
        console.log("Failed Fields:", failedFields);
    }

    if (isValid) $('#specs-tab').tab('show');
});

    $('#nextSpecs').click(function() {
        const valid = validateFields(['select[name="fuel_type"]','select[name="transmission"]']);
        if(valid) $('#features-tab').tab('show');
    });

    $('#nextFeatures').click(function() {
        $('#docs-tab').tab('show'); // no required fields here
    });

    $('#nextDocs').click(function() {
        $('#gallery-tab').tab('show'); // no required fields here
    });
</script>
@endsection
