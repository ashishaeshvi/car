$(document).ready(function () {
    $("#UserForgotPassword").validate({
        rules: {
            email: { required: true },
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
            let actionUrl =
                $('meta[name="base-url"]').attr("content") +
                "/forgot-password-send";
            let formData = new FormData(form);

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                beforeSend: function () {
                    $("#loader").show();
                    
                    $(form)
                        .find("button[type='submit']")
                        .prop("disabled", true);
                },

                success: function (response) {                 
                    if (response.success) {
                        showToast(response.message, "success"); 
                        $("#email").val("");                      
                    } else {
                        showToast(response.message, "error");                        
                    }
                },
                error: function (xhr) {                  
                    let message = "Something went wrong. Please try again.";
                    try {
                        if (xhr.responseJSON) {                           
                            if (xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }                           
                        }
                    } catch (e) {
                        console.error("Error parsing response:", e);
                    }

                    showToast(message, "error");                    
                },
                complete: function () {
                    $("#loader").fadeOut();
                    $(form)
                        .find("button[type='submit']")
                        .prop("disabled", false);
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
