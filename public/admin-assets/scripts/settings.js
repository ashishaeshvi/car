$().ready(function () {
    $("#settingForm").validate({
        rules: {
            company_name: {
                required: true,
            },
            web_email_id: {
                required: false,
                email: true,
            },
            web_mobile_number: {
                required: false,
                number: true,
                minlength: 10,
                maxlength: 10,
            },
        },
        messages: {
            company_name: {
                required: "Company name is required",
            },
            web_email_id: {
                email: "Please enter a valid email address",
            },
            web_mobile_number: {
                number: "Please enter numbers only",
                minlength: "Mobile number must be exactly 10 digits",
                maxlength: "Mobile number must be exactly 10 digits",
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
                    } else if (response.error) {
                        showToast(response.error, "error");
                    }
                },
                error: function (xhr) {
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
        },
    });
});


function printErrorMsg(msg) {
    $.each(msg, function (key, value) {
        console.log(key);
        $("." + key + "_err").text(value);
    });
}

$(document).ready(function () {
    $(".autocompleteoff").attr("autocomplete", "off");
    setTimeout('$(".autocompleteoff").val("");', 500);
});


