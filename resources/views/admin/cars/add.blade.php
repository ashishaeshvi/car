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

                <form id="CarForm" method="POST" action="{{ route('cars.storeOrUpdate', isset($car) ? $car->id : '') }}" enctype="multipart/form-data">
                    @csrf
                    <div @class(['card-body'])>

                        {{-- Nav Tabs --}}
                        <ul @class(['nav', 'nav-tabs' ]) id="carTabs" role="tablist">
                            <li @class(['nav-item'])>
                                <a @class(['nav-link', 'active' ]) id="carinfo-tab" data-toggle="tab" href="#carinfo" role="tab">Car Info</a>
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
                        </ul>

                        {{-- Tab Content --}}
                        <div @class(['tab-content', 'mt-3' ])>

                            {{-- Car Info Tab --}}
                            <div @class(['tab-pane', 'fade' , 'show' , 'active' ]) id="carinfo" role="tabpanel">
                                <div @class(['row'])>
                                    <div @class(['col-lg-4', 'col-sm-4' ])>
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

                                    <div @class(['col-lg-4', 'col-sm-4' ])>
                                        <div @class(['form-group'])>
                                            <label>Car Condition (Type) <span @class(['text-danger'])>*</span></label>
                                            <select name="car_condition" id="car_condition" @class(['form-control']) required>
                                                <option value="">Select</option>
                                                <option value="new" {{ old('car_condition', isset($car) ? $car->car_condition : '') == 'New' ? 'selected' : '' }}>New</option>
                                                <option value="used" {{ old('car_condition', isset($car) ? $car->car_condition : '') == 'Used' ? 'selected' : '' }}>Used</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4' ,'used-fields' ])>
                                        <div @class(['form-group'])>
                                            <label>City <span @class(['text-danger'])>*</span></label>
                                            <select name="city" class="form-control select2">
                                                <option value="">-- Select City --</option>
                                                @foreach($cities as $city)
                                                <option value="{{ $city->id }}" {{ old('city_id', isset($car) ? $car->city_id : '') == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <span @class(['text-danger'])>{{ $errors->first('city') }}</span>
                                        </div>
                                    </div>


                                    <div @class(['col-lg-4', 'col-sm-4' ])>
                                        <div @class(['form-group'])>
                                            <label>Car Name / Model <span @class(['text-danger'])>*</span></label>
                                            <input type="text" name="car_name" @class(['form-control']) placeholder="Enter Car Name" value="{{ old('car_name', $car->car_name ?? '') }}" required>
                                        </div>
                                    </div>


                                    <div @class(['col-lg-4', 'col-sm-4' ])>
                                        <div @class(['form-group'])>
                                            <label>Variant</label>
                                            <input type="text" name="variant" @class(['form-control']) placeholder="Enter Variant" value="{{ old('variant', $car->variant ?? '') }}">
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4' ])>
                                        <div @class(['form-group'])>
                                            <label>Price <span @class(['text-danger'])>*</span></label>
                                            <input type="text" name="price" @class(['form-control']) placeholder="Enter Price" value="{{ old('price', $car->price ?? '') }}" required>
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4' ])>
                                        <div @class(['form-group'])>
                                            <label>EMI Starting Price <span @class(['text-danger'])></span></label>
                                            <input type="number" name="emi_starting_price" @class(['form-control']) placeholder="Enter EMI Starting Price" value="{{ old('emi_starting_price', $car->emi_starting_price ?? '') }}">
                                        </div>
                                    </div>




                                    <div @class(['col-lg-4', 'col-sm-4' ,'used-fields' ])>
                                        <div @class(['form-group'])>
                                            <label>Registration Year <span @class(['text-danger'])>*</span></label>
                                            <input type="text" name="registration_year" @class(['form-control']) placeholder="Feb 2025" value="{{ old('registration_year', $car->registration_year ?? '') }}">
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4' ,'used-fields' ])>
                                        <div @class(['form-group'])>
                                            <label>Year of Manufacture <span @class(['text-danger'])>*</span></label>
                                            <input type="text" name="manufacture_year" maxlength="4" @class(['form-control']) placeholder="YYYY" value="{{ old('manufacture_year', $car->manufacture_year ?? '') }}">
                                        </div>
                                    </div>







                                    <div @class(['col-lg-4', 'col-sm-4' ,'used-fields' ])>
                                        <div @class(['form-group'])>
                                            <label>Ownership <span @class(['text-danger'])>*</span></label>
                                            <input type="text" name="ownership" @class(['form-control']) placeholder="" value="{{ old('ownership', $car->ownership ?? '') }}">
                                        </div>
                                    </div>


                                    <div @class(['col-lg-4', 'col-sm-4' ,'used-fields' ])>
                                        <div @class(['form-group'])>
                                            <label>RTO <span @class(['text-danger'])>*</span></label>
                                            <input type="text" name="rto" @class(['form-control']) placeholder="" value="{{ old('rto', $car->rto ?? '') }}">
                                        </div>
                                    </div>


                                    <div @class(['col-lg-4', 'col-sm-4' ])>
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

                                    <div @class(['col-lg-4', 'col-sm-4' ])>
                                        <div @class(['form-group'])>
                                            <label>360° Image</label>
                                            <input type="file" name="image_360" @class(['form-control-file']) accept=".jpg,.jpeg,.png">
                                            <small @class(['form-text', 'text-muted' ])>Allowed JPG or PNG. Max size of 2MB</small>

                                            @if(isset($car) && $car->image_360)
                                            <img src={!! displayImage($car->image_360) !!} width="100"
                                            @class(['mt-2'])>
                                            @endif

                                        </div>
                                    </div>




                                </div>


                                <div @class(['col-lg-12', 'col-sm-12' ])>
                                    <div @class(['form-group'])>
                                        <label for="exampleInputEmail1">Description</label><span
                                            @class(['required'])></span>
                                        <textarea @class(['ckeditor']) name="description"
                                            placeholder="Your description"
                                            style="height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description', $car->description ?? '') }}</textarea>

                                    </div>
                                </div>
                                <button type="button" @class(['btn', 'btn-primary' , 'float-right' ]) id="nextCarInfo">Next</button>
                            </div>

                            {{-- Specifications Tab --}}
                            <div @class(['tab-pane', 'fade' ]) id="specs" role="tabpanel">
                                <div @class(['row'])>



                                    <div @class(['col-lg-4', 'col-sm-4' ])>
                                        <div @class(['form-group'])>
                                            <label>Body Type <span @class(['text-danger'])>*</span></label>
                                            <select name="body_type" @class(['form-control']) required>
                                                <option value="">Select Body Type</option>
                                                @foreach($bodyTypes as $bodyType)
                                                <option value="{{ $bodyType->id }}" {{ old('body_type', isset($car) ? $car->specifications->body_type : '') == $bodyType->id ? 'selected' : '' }}>
                                                    {{ $bodyType->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4' ])>
                                        <div @class(['form-group'])>
                                            <label>Transmission <span @class(['text-danger'])>*</span></label>
                                            @php
                                            $selectedTransmissions = explode(',', $car->specifications->transmission ?? '');
                                            @endphp

                                            <select name="transmission[]" class="form-control select2" multiple required>
                                                <option value="Manual" {{ in_array('Manual', $selectedTransmissions) ? 'selected' : '' }}>Manual</option>
                                                <option value="Automatic" {{ in_array('Automatic', $selectedTransmissions) ? 'selected' : '' }}>Automatic</option>
                                                <option value="Clutchless Manual" {{ in_array('Clutchless Manual', $selectedTransmissions) ? 'selected' : '' }}>Clutchless Manual</option>
                                            </select>
                                        </div>
                                    </div>


                                    @php
                                    $selectedFuelTypes = explode(',', $car->specifications->fuel_type ?? '');
                                    @endphp

                                    <div class="col-lg-4 col-sm-4">
                                        <div class="form-group">
                                            <label>Fuel Type <span class="text-danger">*</span></label>
                                            <select name="fuel_type[]" class="form-control select2" multiple required>
                                                <option value="">Select Fuel Type</option>
                                                @foreach($fuelTypes as $fuelType)
                                                <option value="{{ $fuelType->id }}"
                                                    {{ in_array($fuelType->id, $selectedFuelTypes) ? 'selected' : '' }}>
                                                    {{ $fuelType->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4' ])>
                                        <div @class(['form-group'])>
                                            <label>Brand <span @class(['text-danger'])>*</span></label>
                                            <select name="brand" @class(['form-control']) required>
                                                <option value="">Select Brand</option>
                                                @foreach($brands as $brand)
                                                <option value="{{ $bodyType->id }}" {{ old('brand', $car->specifications->brand ?? '') == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4' ])>
                                        <div @class(['form-group'])>
                                            <label>Seating Capacity</label>
                                            <select name="seating_capacity" @class(['form-control']) required>
                                                <option value="">Select Seating Capacity</option>
                                                <option value="5" {{ old('seating_capacity', $car->specifications->seating_capacity ?? '') == '5' ? 'selected' : '' }}>5 Seater</option>
                                                <option value="6" {{ old('seating_capacity', $car->specifications->seating_capacity ?? '') == '6' ? 'selected' : '' }}>6 Seater</option>
                                                <option value="7" {{ old('seating_capacity', $car->specifications->seating_capacity ?? '') == '7' ? 'selected' : '' }}>7 Seater</option>
                                                <option value="8" {{ old('seating_capacity', $car->specifications->seating_capacity ?? '') == '8' ? 'selected' : '' }}>8 Seater</option>
                                                <option value="8+" {{ old('seating_capacity', $car->specifications->seating_capacity ?? '') == '8+' ? 'selected' : '' }}>8+ Seater</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div @class(['col-lg-4', 'col-sm-4' ])>
                                        <div @class(['form-group'])>
                                            <label>Mileage <span @class(['text-danger'])>*</span></label>
                                            <select name="mileage" @class(['form-control']) required>
                                                <option value="">Select Mileage</option>
                                                @foreach($mileages as $mileage)
                                                <option value="{{ $mileage->id }}" {{ old('mileage', $car->specifications->mileage ?? '') == $mileage->id ? 'selected' : '' }}>
                                                    {{ $mileage->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div @class(['col-lg-4', 'col-sm-4' ])>
                                        <div @class(['form-group'])>
                                            <label>Safety Ratings</label>
                                            <select name="safety_ratings" @class(['form-control']) required>
                                                <option value="">Select Safety Rating</option>
                                                @foreach ($safetyRatings as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ old('safety_ratings', $car->specifications->safety_ratings ?? '') == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div @class(['col-lg-4', 'col-sm-4' ])>
                                        <div @class(['form-group'])>
                                            <label>Airbags</label>
                                            <select name="airbags" @class(['form-control']) required>
                                                <option value="">Select Airbags</option>
                                                @foreach ($airbags as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ old('airbags', $car->specifications->airbags ?? '') == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-sm-4">
                                        <div class="form-group">
                                            <label>Engine Capacity</label>
                                            <select name="engine_cc" class="form-control" required>
                                                <option value="">Select Engine Capacity</option>
                                                @foreach ($engineCapacities as $capacity)
                                                <option value="{{ $capacity->id }}"
                                                    {{ old('engine_cc', $car->specifications->engine_cc ?? '') == $capacity->id ? 'selected' : '' }}>
                                                    {{ $capacity->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-4">
                                        <div class="form-group">
                                            <label>Power</label>
                                            <select name="power_id" class="form-control" required>
                                                <option value="">Select Power</option>
                                                @foreach ($powers as $power)
                                                <option value="{{ $power->id }}"
                                                    {{ old('power_id', $car->specifications->power_id ?? '') == $power->id ? 'selected' : '' }}>
                                                    {{ $power->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-sm-4">
                                        <div class="form-group">
                                            <label>Torque</label>
                                            <select name="torque_id" class="form-control" required>
                                                <option value="">Select Torque</option>
                                                @foreach ($torques as $torque)
                                                <option value="{{ $torque->id }}"
                                                    {{ old('torque_id', $car->specifications->torque_id ?? '') == $torque->id ? 'selected' : '' }}>
                                                    {{ $torque->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @php
                                    $selectedColours = explode(',', $car->specifications->colour ?? '');
                                    @endphp

                                    <div class="col-lg-4 col-sm-4">
                                        <div class="form-group">
                                            <label>Colour <span class="text-danger">*</span></label>
                                            <select name="colour[]" class="form-control select2" multiple required>
                                                <option value="">Select Colour</option>
                                                @foreach ($colours as $colour)
                                                <option value="{{ $colour->id }}"
                                                    {{ in_array($colour->id, $selectedColours) ? 'selected' : '' }}>
                                                    {{ $colour->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" @class(['btn', 'btn-primary' , 'float-right' ]) id="nextSpecs">Next</button>
                            </div>

                            {{-- Features Tab --}}
                            <div @class(['tab-pane', 'fade' ]) id="features" role="tabpanel">
                                <div @class(['row'])>
                                    <div @class(['col-lg-12'])>
                                        <label>Select Features:</label><br>
                                        @php
                                        $featuresList = ['Airbags','ABS','Power Steering','Sunroof','Reverse Camera','Touchscreen Display','Alloy Wheels','Music System','Rear AC Vents','Central Locking','Cruise Control','Hill Hold Control','Four Wheel Drive','Ventilated Seats','Wireless Charging'];
                                        $savedFeatures = explode(',', $car->features ?? '');
                                        @endphp

                                        @foreach($featuresList as $feature)
                                        <div @class(['form-check', 'form-check-inline' ])>
                                            <input type="checkbox" name="features[]" value="{{ $feature }}"
                                                @class(['form-check-input'])
                                                {{ in_array($feature, $savedFeatures) ? 'checked' : '' }}>
                                            {{ $feature }}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="button" @class(['btn', 'btn-primary' , 'float-right' ]) id="nextFeatures">Next</button>
                            </div>

                            {{-- Documents Tab --}}
                            <div @class(['tab-pane', 'fade' ]) id="docs" role="tabpanel">
                                <div @class(['row'])>
                                    <div @class(['col-lg-4'])>
                                        <div @class(['form-group'])>
                                            <label>RC Copy</label>
                                            <input type="file" name="rc_copy" @class(['form-control-file']) accept=".jpg,.jpeg,.png,.pdf">
                                            @if(isset($car) && $car->rc_copy)
                                            <a href={!! displayImage($car->rc_copy) !!} @class(['mt-2'])
                                                download="">Download</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div @class(['col-lg-4'])>
                                        <div @class(['form-group'])>
                                            <label>Insurance</label>
                                            <input type="file" name="insurance_doc" @class(['form-control-file']) accept=".jpg,.jpeg,.png,.pdf">
                                            @if(isset($car) && $car->insurance_doc)
                                            <a href={!! displayImage($car->insurance_doc) !!} @class(['mt-2'])
                                                download="">Download</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div @class(['col-lg-4'])>
                                        <div @class(['form-group'])>
                                            <label>Pollution Certificate</label>
                                            <input type="file" name="pollution" @class(['form-control-file']) accept=".jpg,.jpeg,.png,.pdf">
                                            @if(isset($car) && $car->pollution)
                                            <a href={!! displayImage($car->pollution) !!} @class(['mt-2'])
                                                download="">Download</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div @class(['card-footer', 'text-center' ])>
                                    <a href="{{ route('cars.index') }}" @class(['btn', 'btn-secondary' ])>Cancel</a>
                                    <button type="submit" @class(['btn', 'btn-success' ])>
                                        <i @class(['fa', 'fa-check-circle' ])></i> {{ isset($car) ? 'Update Car' : 'Add Car' }}
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


        return {
            isValid,
            failedFields
        };
    }

    $('#nextCarInfo').click(function() {
        const carCondition = $('select[name="car_condition"]').val()?.toLowerCase() || '';

        // Base fields (common for all)
        let fields = [
            'select[name="dealer"]',
            'input[name="car_name"]',
            'input[name="price"]',
            'select[name="car_condition"]',
        ];

        // If user selects "used", add extra required fields
        if (carCondition === 'used') {
            fields.push(
                'input[name="manufacture_year"]',
                'select[name="city"]',
                'input[name="registration_year"]',
                'input[name="ownership"]',
                'input[name="rto"]'
            );
        }

        // Check if existing image is present
        const hasExistingImage = $('input[name="existing_car_image"]').length > 0;
        if (!hasExistingImage) {
            fields.push('input[name="car_image"]');
        }

        // Run validation
        const {
            isValid,
            failedFields
        } = validateFields(fields);

        console.log("Validation Result:", isValid);
        if (!isValid) {
            console.log("Failed Fields:", failedFields);
            return; // Stop here if invalid
        }

        // If all good, move to next tab
        $('#specs-tab').tab('show');
    });


    $('#nextSpecs').click(function() {
        const failedFields = [];

        // List of selectors to validate
        const fieldsToValidate = [
            'select[name="body_type"]',
            'select[name="transmission[]"]', // note the []
            'select[name="fuel_type[]"]',
            'select[name="mileage"]',
            'select[name="brand"]',
        ];

        fieldsToValidate.forEach(function(selector) {
            const $field = $(selector);

            // Check if multi-select or single-select
            let value = $field.val();

            if ($field.prop('multiple')) {
                // For multiple select, check if array is empty
                if (!value || value.length === 0) {
                    failedFields.push(selector);
                    $field.addClass('is-invalid');
                } else {
                    $field.removeClass('is-invalid');
                }
            } else {
                // For single select
                if (!value || value === '') {
                    failedFields.push(selector);
                    $field.addClass('is-invalid');
                } else {
                    $field.removeClass('is-invalid');
                }
            }
        });

        const isValid = failedFields.length === 0;
        console.log("Validation Result:", isValid);
        if (!isValid) {
            console.log("Failed Fields:", failedFields);
            return; // Stop moving to next tab
        }

        $('#features-tab').tab('show'); // Move to features tab
    });



    $('#nextFeatures').click(function() {
        $('#docs-tab').tab('show'); // no required fields here
    });



    $(document).ready(function() {
        function toggleUsedFields() {
            const isUsed = $('#car_condition').val().toLowerCase() === 'used';
            const $usedFields = $('.used-fields');

            if (isUsed) {
                $usedFields.show();
                $usedFields.find('input').attr('required', true);
            } else {
                $usedFields.hide();
                $usedFields.find('input').removeAttr('required');
            }
        }

        // Run on page load
        toggleUsedFields();

        // Run when user changes selection
        $('#car_condition').on('change', toggleUsedFields);
    });
</script>
@endsection