$().ready(function () {
    $("#UserPassportForm").validate({
        rules: {
            passport_no: { required: true },
            passport: {
                required: function () {
                    return $("#passportEditId").val() == ""; // Only required when adding
                },
            },
            visa: {
                required: function () {
                    return $("#passportEditId").val() == ""; // Only required when adding
                },
            },
             candidate_sign: {
                required: function () {
                    return $("#passportEditId").val() == ""; // Only required when adding
                },
            },
            sponsor_name: {
                required: function () {
                    return $("#individual_or_company").val() == "company";
                },
            },
            sponsor_id: {
                required: function () {
                    return $("#individual_or_company").val() == "company";
                },
            },
            ra_document_id: { required: true },
            fe_sign_id: { required: true },
            fe_no: { required: true },
            fe_age: {required: true, digits: true, minlength: 1, maxlength: 2},
            pobox: {required: true, digits: true, minlength: 3, maxlength: 6},
            pin_code: { required: true, digits: true, minlength: 3, maxlength: 6},
            job: { required: true },
            vacancy: { required: true, digits: true },
            salary: { required: true, number: true },
            individual_or_company: { required: true },
            ref_no: { required: false, minlength: 2, maxlength: 50 },
            fe_stamp_id: {
                required: function () {
                    return $("#individual_or_company").val() == "company";
                },
            },
        },
        messages: {
            passport_no: { required: "Please enter passport number" },
            ra_document_id: { required: "Please select ra" },
            fe_sign_id: { required: "Please select fe sign" },
            fe_no: { required: "Please select fe no" },
            fe_age: { required: "Age is required", digits: "Enter digits only", minlength: "Age must be at least 1 digits", maxlength: "Age must be at most 2 digits"},
            pobox: { required: "PO Box is required", digits: "Enter digits only", minlength: "PO Box must be at least 3 digits", maxlength: "PO Box must be at most 6 digits"},
            pin_code: { required: "PIN code is required", digits: "Enter digits only", minlength: "PIN code must be at least 3 digits", maxlength: "PIN code must be at most 6 digits" },
            passport: { required: "Please upload passport file" },
            visa: { required: "Please upload visa file" },
             candidate_sign: { required: "Please upload candidate sign" },
            
            sponsor_name: { required: "Please enter sponsor name" },
            sponsor_id: { required: "Please enter sponsor id" },
            job: { required: "Please enter job title" },
            vacancy: { required: "Please enter vacancy count", digits: "Please enter a valid number" },
            salary: { required: "Please enter salary amount" },
            ref_no: {
                minlength: "Ref No must be at least 2 character",
                maxlength: "Ref No must not exceed 50 characters",
            },
            individual_or_company: {
                required: "Please select individual or company",
            },
            fe_stamp_id: {
                required: "Please select FE stamp",
            },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
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
                    if (response.success) {
                        showToast(response.message, "success");
                        if (response.type == "add") {
                            $("#candidateSignImg").html("");
                            $(".docPrevSpam").html("");
                            $('select[name="ra_document_id"]')
                                .val("")
                                .trigger("change");
                            $("#UserPassportForm")[0].reset();
                        } else {
                            // Optional: Fill the form again with updated data if needed
                            $("#UserPassportForm")[0].reset();
                            $("#passportEditId").val(response.data.id);                          
                            window.location = "/user-passports";
                        }
                    } else if (response.error) {
                        alert(response.errors);
                        showToast(response.error, "error");
                    }
                },
                error: function (xhr) {
                    try {
                        const errors = xhr.responseJSON.errors;
                        printErrorMsg(errors);
                    } catch (e) {
                        showToast(
                            "Something went wrong. Please try again.",
                            "error"
                        );
                    }
                },
                complete: function () {
                    $("#loader").fadeOut();
                },
            });
        },
    });
});

function printErrorMsg(msg) {
    $.each(msg, function (key, value) {
        $("." + key + "_err")
            .text(value)
            .show();
    });
}

$(document).ready(function () {
    $(".autocompleteoff").attr("autocomplete", "off");
    setTimeout('$(".autocompleteoff").val("");', 500);
});

$("#passport_no").on("blur", function () {
    let passportNo = $(this).val();
    let passportEditId = $("#passportEditId").val(); 
    if (passportNo !== "") {
        $.ajax({
            url: checkPassportUrl,
            method: "POST",
            data: {
                passport_no: passportNo,
                passport_edit_id: passportEditId,
            },
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (response) {
                if (response.exists) {
                    $(".passport_no_err").text(
                        "Passport number already exists."
                    );
                    showToast("Passport number already exists.", "error");
                    $("#submitSection").hide();
                } else {
                    $(".passport_no_err").text("");
                    $("#submitSection").show();
                }
            },
            error: function () {
                $(".passport_no_err").text("Error checking passport number.");
                showToast("Error checking passport number.", "error");
                $("#submitSection").hide();
            },
            complete: function () {
                $("#loader").fadeOut();
            },
        });
    } else {
        $(".passport_no_err").text("");
    }
});

function checkFeDetails() {
    let fe_name = $("#fe_name_val").val().trim();
    let country_id = $("#countryId").val();

    if (fe_name !== "" && country_id !== "") {
        $.ajax({
            url: checkFeDetailsUrl,
            method: "POST",
            data: {
                fe_name: fe_name,
                country_id: country_id,
            },
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (response) {
                if (response.exists) {
                    $(".fe_name_err").text("");

                    if (response.fe_no) {
                        $("#fe_no").val(response.fe_no).prop("readonly", true); // Set value and make readonly
                    } else {
                        $("#fe_no").val("").prop("readonly", false); // Clear and make editable again (optional)
                    }

                    // If records exist, fill the inputs using the latest record (you can use the first one)
                    if (response.latest_records.length > 0) {
                        const record = response.latest_records[0]; // use the first or latest record

                        $("#fe_age").val(record.fe_age);
                        $("#sponsor_name").val(record.sponsor_name);
                        $("#sponsor_id").val(record.sponsor_id);
                        $("#vacancyId").val(record.vacancy);

                        
                        $("#individual_or_company").val(
                            record.individual_or_company
                        );

                        toggleFeStamp();
                        $("#fe_sign_id").val(record.fe_sign_id);
                        $("#fe_stamp_id").val(record.fe_stamp_id);
                        $("#pobox").val(record.pobox);
                        $("#pin_code").val(record.pin_code);
                    }
                } else {
                    $("#fe_no").val("").prop("readonly", false);
                    // $(".fe_name_err").text("No matching combination found.");
                    $(
                        "#fe_no, #fe_age, #sponsor_name, #sponsor_id ,#vacancyId,#fe_sign_id,#fe_stamp_id,#individual_or_company,#pin_code,#pobox"
                    ).val(""); // clear fields
                    toggleFeStamp();
                }
            },
            error: function () {
                $("#fe_no").val("").prop("readonly", false);
                // $(".fe_name_err").text("Error checking FE No and Country.");
            },
            complete: function () {
                $("#loader").fadeOut();
            },
        });
    } else {
        $("#fe_no").val("").prop("readonly", false);
        // $(".fe_name_err").text("No matching combination found.");
        $(
            "#fe_no, #fe_age, #sponsor_name, #sponsor_id ,#vacancyId,#fe_sign_id,#fe_stamp_id,#individual_or_company,#fe_name_val,#pin_code,#pobox"
        ).val(""); // clear fields
        toggleFeStamp();
    }
}

$("#countryId").on("change", function () {
    checkFeDetails();
});



$("#fe_name_val").on("blur", function () {
    checkFeDetails();
});
