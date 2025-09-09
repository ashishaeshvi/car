$(document).ready(function () {
    let isSaudi = false;
    // Custom method to validate dd-mm-yyyy format and ensure it's a valid date
    $.validator.addMethod("validDate", function (value, element) {
        if (!/^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-\d{4}$/.test(value)) {
            return false;
        }
        let parts = value.split("-");
        let day = parseInt(parts[0], 10);
        let month = parseInt(parts[1], 10) - 1; // Months are 0-based in JS Date
        let year = parseInt(parts[2], 10);
        let date = new Date(year, month, day);
        return date.getDate() === day && date.getMonth() === month && date.getFullYear() === year;
    }, "Enter a valid date in dd-mm-yyyy format");

    $.validator.addMethod("issueBeforeExpiry", function (value, element, params) {
        if (!value || !$(params).val()) return true; // Skip if either is empty
        let issueParts = value.split("-");
        let expiryParts = $(params).val().split("-");
        let issueDate = new Date(issueParts[2], issueParts[1] - 1, issueParts[0]);
        let expiryDate = new Date(expiryParts[2], expiryParts[1] - 1, expiryParts[0]);
        return issueDate < expiryDate;
    }, "Issue date must be before expiry date");

    $.validator.addMethod("dateInPast", function (value, element) {
        if (!value) return true; // Skip if empty
        let parts = value.split("-");
        let inputDate = new Date(parts[2], parts[1] - 1, parts[0]);
        let today = new Date();
        return inputDate < today;
    }, "Date should be in the past");

    $.validator.addMethod("alphanumeric", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
    }, "Only alphanumeric characters are allowed.");

    $.validator.addMethod("regex", function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Invalid format."
    );

    $("#candidateForm").validate({
        rules: {
            visa_no: {
                required: true,
                minlength:8,
                maxlength: 50,
                regex: /^[A-Za-z0-9/]+$/
            },
            en_visa_no: {
                required: function() { return isSaudi; },
                minlength:8,
                maxlength: 40,
                digits: true
            },
            visa_issue_date: {
                required: true,
                validDate: true,
                issueBeforeExpiry: "#visa_expiry_date"
            },
            visa_expiry_date: {
                required: true,
                validDate: true,
            },
            visa_issue_place: {
                required: true,
                minlength: 3
            },
            job_on_visa: {
                required: true,
                minlength: 3
            },
            passport_no: {
                required: true,
                minlength: 5,
                maxlength: 10,
                alphanumeric: true
            },
            first_name_eng: {
                required: true,
                minlength: 3,
                maxlength: 35
            },
            last_name_eng: {
                minlength: 3,
                maxlength: 25
            },
            name_hindi: {
                required: true,
                minlength: 3,
                maxlength: 50,
                regex: /^[\u0900-\u097F\s]+$/
            },
            birth_place: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            passport_issue_place: {
                required: true
            },
            dob: {
                required: true,
                validDate: true,
                dateInPast: true
            },
            passport_issue_date: {
                required: true,
                validDate: true,
                issueBeforeExpiry: "#passport_expiry_date",
                dateInPast: true
            },
            passport_expiry_date: {
                required: true,
                validDate: true
            },
            father_name: {
                required: true,
                minlength: 3,
                maxlength: 35
            },
            nominee_name: {
                required: true,
                minlength: 3,
                maxlength: 35
            },
            
            passport_address: {
                required: true
            },
            passport_pin_code: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6
            },
            current_city: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            passport_issue_state: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            candidate_mobile_no: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            alternate_no: {
                required: false,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            // pobox: {
            //     required: true,
            //     digits: true,
            //     minlength: 3,
            //     maxlength: 6
            // },
            // pin_code: {
            //     required: true,
            //     digits: true,
            //     minlength: 3,
            //     maxlength: 6
            // }
        },
        messages: {
            visa_no: {
                required: "Visa number is required",
                minlength: "Visa number must be min 8 characters",
                maxlength: "Visa number must not exceed 50 characters",
                regex: "Visa number can only contain letters, numbers and '/'"
            },
            en_visa_no: {
                minlength: "EN Visa number must be min 8 characters",
                maxlength: "EN Visa number must not exceed 40 characters",
                digits: "EN Visa number must contain digits only"
            },
            issue_date: {
                required: "Visa Issue date is required",
                validDate: "Enter a valid date in dd-mm-yyyy format",
                issueBeforeExpiry: "Visa issue date must be before expiry date"
            },
            expiry_date: {
                required: "Expiry date is required",
                validDate: "Enter a valid date in dd-mm-yyyy format"
            },
            visa_issue_place: {
                required: "Place of issue is required",
                minlength: "Place of issue must be at least 3 characters"
            },
            job_on_visa: {
                required: "Job on visa is required",
                minlength: "Job on visa must be at least 3 characters"
            },
            passport_no: {
                required: "Passport number is required",
                minlength: "Passport number must be at least 5 characters",
                maxlength: "Passport number must not exceed 10 characters",
                alphanumeric: "Passport number must be alphanumeric only"
            },
            first_name_eng: {
                required: "First name (English) is required",
                maxlength: "First name must not exceed 35 characters",
                minlength: "First name must be at least 3 characters",
                regex: "Only letters and spaces are allowed"
            },
            last_name_eng: {
                minlength: "Last name must be at least 3 characters",
                maxlength: "Last name must not exceed 25 characters",
                regex: "Only letters and spaces are allowed"
            },
            name_hindi: {
                required: "नाम भरना आवश्यक है",
                minlength: "कम से कम 3 अक्षर लिखें",
                maxlength: "50 अक्षरों से अधिक नहीं हो सकता",
                regex: "केवल हिंदी अक्षर और स्पेस लिखें"
            },
            birth_place: {
                required: "Birth place is required",
                minlength: "Birth place must be at least 3 characters",
                maxlength: "Birth place must not exceed 20 characters"
            },
            passport_issue_place: {
                required: "Passport issue place is required"
            },
            dob: {
                required: "Date of birth is required",
                validDate: "Enter a valid date in dd-mm-yyyy format",
                dateInPast: "Date of birth must be in the past"
            },
            passport_issue_date: {
                required: "Passport issue date is required",
                validDate: "Enter a valid date in dd-mm-yyyy format",
                issueBeforeExpiry: "Passport issue date must be before expiry date",
                dateInPast: "Passport issue date must be in the past"
            },
            passport_expiry_date: {
                required: "Passport expiry date is required",
                validDate: "Enter a valid date in dd-mm-yyyy format"
            },
            father_name: {
                required: "Father's name is required",
                minlength: "Father's name must be at least 3 characters",
                maxlength: "Father's name must not exceed 25 characters"
            },
            nominee_name: {
                minlength: "Nominee's name must be at least 3 characters",
                maxlength: "Nominee's name must not exceed 35 characters"
            },
            passport_address: {
                required: "Passport address is required"
            },
            passport_pin_code: {
                required: "Passport PIN code is required",
                digits: "Enter digits only",
                minlength: "PIN code must min 6 digits",
                maxlength: "PIN code must be 6 digits"
            },
            current_city: {
                required: "Current city is required",
                minlength: "Current city must be at least 3 characters",
                maxlength: "Current city must not exceed 20 characters"
            },
            passport_issue_state: {
                required: "State is required",
                minlength: "State must be at least 3 characters",
                maxlength: "State must not exceed 20 characters"
            },
            candidate_mobile_no: {
                required: "Mobile number is required",
                digits: "Enter digits only",
                minlength: "Mobile number must be 10 digits",
                maxlength: "Mobile number must be 10 digits"
            },
            alternate_no: {
                digits: "Enter digits only",
                minlength: "Alternate mobile number must be 10 digits",
                maxlength: "Alternate mobile number must be 10 digits"
            },
            // pobox: {
            //     required: "PO Box is required",
            //     digits: "Enter digits only",
            //     minlength: "PO Box must be at least 3 digits",
            //     maxlength: "PO Box must be at most 6 digits"
            // },
            // pin_code: {
            //     required: "PIN code is required",
            //     digits: "Enter digits only",
            //     minlength: "PIN code must be at least 3 digits",
            //     maxlength: "PIN code must be at most 6 digits"
            // }
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("text-danger");
            if (element.parent(".input-group").length) {
                error.insertAfter(element.parent());
            } else if (element.closest(".form-group").length) {
                error.insertAfter(element.closest(".form-group"));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        submitHandler: function (form) {
            var formData = new FormData($("#candidateForm")[0]);
            const actionUrl = $(form).attr("action");

            $(".error").html("");
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#loader").show();
                },
                success: function (response) {
                    $("#loader").fadeOut();
                    if (response.success) {
                        showToast(response.message, "success");
                        form.reset();
                        $(".is-invalid").removeClass("is-invalid");
                        $(".text-danger").html("");

                        setTimeout(function () {
                            window.location.href = window.location.origin + "/candidate_form";
                        }, 1000);

                    } else if (response.error) {
                        showToast(response.error, "error");
                    }
                },
                error: function (xhr) {
                    $("#loader").fadeOut();
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        printErrorMsg(errors);
                    } else {
                        showToast("Something went wrong. Please try again.", "error");
                    }
                },
                complete: function () {
                    $("#loader").fadeOut();
                },
            });
        }
    });


    $("#passport_search_form").validate({
        rules: {
            passport: {
                required: true,
                minlength: 5,
                maxlength: 10,
                alphanumeric: true
            }
        },
        messages: {
            passport: {
                required: "Passport number is required",
                minlength: "Passport number must be at least 5 characters",
                maxlength: "Passport number must not exceed 10 characters",
                alphanumeric: "Passport number must be alphanumeric only"
            }
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("text-danger");
            if (element.parent(".input-group").length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        submitHandler: function (form) {
            var formData = new FormData($("#passport_search_form")[0]);
            const user_passport_id = document.getElementById('user_passport_id')?.value || '';
            formData.append('user_passport_id', user_passport_id)
            const actionUrl = $(form).attr("action");

            $(".error").html("");
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: formData,
                cache: false,
                contentType: false,
                processData: false, 
                beforeSend: function () {
                    $("#loader").show();
                },
                success: function (response) {
                    $("#loader").fadeOut();
                    if (response.success) {
                        $("#tab-section").show();

                        const baseUrl = '/storage/';
                        const passportPdf = baseUrl + response.data.passport;
                        const visaPdf = baseUrl + response.data.visa;
                        isSaudi = response.data.all_country_id == 5  // Saudi Arabia ID is 5

                        // if (saudi) {
                        //     $("#en_visa_no_div").removeClass('d-none');
                        //     $("#en_visa_no").attr('required', true);
                        //     $("#visa_field_name_change").html('Ref No <strong class="text-danger">*</strong>:');
                        // }

                        if (isSaudi) {
                            $("#en_visa_no_div").removeClass('d-none');   // show the input div
                            $("#en_visa_no").attr('required', true);      // make it required
                            $("#visa_field_name_change").html('Ref No <strong class="text-danger">*</strong>:');
                        } else {
                            $("#en_visa_no_div").addClass('d-none');      // hide it if not Saudi
                            $("#en_visa_no").removeAttr('required');      // make it optional
                        }

                        $("#passport_no").val(response.data.passport_no);
                        $("#user_passport_id").val(response.data.id);
                       
                        renderPdfInCanvas(passportPdf, 'passport_canvas_container');
                        renderPdfInCanvas(visaPdf, 'visa_canvas_container');
                        showToast(response.message || "Data loaded", "success");

                    } else {
                        showToast(response.message || "No data found", "error");
                    }
                },
                error: function (xhr) {
                    $("#loader").fadeOut();
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        printErrorMsg(errors);
                    } else {
                        showToast("Something went wrong. Please try again.", "error");
                    }
                },
                complete: function () {
                    $("#loader").fadeOut();
                }
            });
        }
    });

    // function renderPdfInCanvas(pdfUrl, containerId) {
    //     const loadingTask = pdfjsLib.getDocument(pdfUrl);
    //     loadingTask.promise.then(pdf => {
    //         const container = document.getElementById(containerId);
    //         container.innerHTML = ''; // Clear previous canvases if any

    //         for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
    //             pdf.getPage(pageNumber).then(page => {
    //                 const viewport = page.getViewport({ scale: 1.5 });

    //                 const canvas = document.createElement('canvas');
    //                 canvas.classList.add('img-fluid', 'mb-3', 'rounded');
    //                 canvas.width = viewport.width;
    //                 canvas.height = viewport.height;

    //                 const context = canvas.getContext('2d');
    //                 const renderContext = {
    //                     canvasContext: context,
    //                     viewport: viewport
    //                 };

    //                 page.render(renderContext);

    //                 container.appendChild(canvas);
    //             });
    //         }
    //     }).catch(error => {
    //         console.error(`Failed to render PDF in container #${containerId}:`, error);
    //     });
    // }

    function renderPdfInCanvas(pdfUrl, containerId) {
        const loadingTask = pdfjsLib.getDocument(pdfUrl);
        loadingTask.promise.then(pdf => {
            const container = document.getElementById(containerId);
            container.innerHTML = ''; // Clear previous canvases if any
    
            for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
                pdf.getPage(pageNumber).then(page => {
                    const viewport = page.getViewport({ scale: 1.5 });
    
                    // Wrapper div for Panzoom
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('pdf-page-wrapper');
                    wrapper.style.cssText = `
                        width:100%;
                        height:500px;
                        overflow:hidden;
                        border:1px solid #ccc;
                        margin-bottom:15px;
                        position:relative;
                    `;
    
                    // Zoom control buttons
                    const controls = document.createElement('div');
                    controls.style.cssText = `
                        position:absolute;
                        top:10px;
                        right:10px;
                        z-index:10;
                    `;
                    controls.innerHTML = `
                        <button class="btn btn-sm btn-primary zoom-in">+</button>
                        <button class="btn btn-sm btn-primary zoom-out">-</button>
                        <button class="btn btn-sm btn-secondary reset">Reset</button>
                    `;
                    wrapper.appendChild(controls);
    
                    // Canvas
                    const canvas = document.createElement('canvas');
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
                    canvas.style.cursor = "grab";
    
                    const context = canvas.getContext('2d');
                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
    
                    page.render(renderContext);
    
                    wrapper.appendChild(canvas);
                    container.appendChild(wrapper);
    
                    // Apply Panzoom
                    const pan = Panzoom(canvas, {
                        maxScale: 5,
                        minScale: 0.5,
                        contain: 'outside'
                    });
    
                    // Wheel zoom
                    wrapper.addEventListener('wheel', pan.zoomWithWheel);
    
                    // Buttons
                    controls.querySelector('.zoom-in').addEventListener('click', () => pan.zoomIn());
                    controls.querySelector('.zoom-out').addEventListener('click', () => pan.zoomOut());
                    controls.querySelector('.reset').addEventListener('click', () => pan.reset());
    
                    // Cursor change while dragging
                    canvas.addEventListener('mousedown', () => canvas.style.cursor = "grabbing");
                    document.addEventListener('mouseup', () => canvas.style.cursor = "grab");
                });
            }
        }).catch(error => {
            console.error(`Failed to render PDF in container #${containerId}:`, error);
        });
    }


    const passportNo = $("#passport_no").val();
    const userPassportId = $("#user_passport_id").val();

    if (passportNo && userPassportId) {
        $("#passport_search_form").submit();
        $("#passport_search_trigger").attr('disabled', true);
        $("#passport").attr('readonly', true)
    }


    function printErrorMsg(msg) {
    $.each(msg, function (key, value) {
        $("#" + key).addClass("is-invalid");
        $("." + key + "_err")
            .text(value)
            .show();
    });
}

    $(".autocompleteoff").attr("autocomplete", "off");
    setTimeout(() => $(".autocompleteoff").val(""), 500);
});
