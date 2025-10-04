$(document).ready(function () {
    $("#addUserForm").validate({
        rules: {
            contact_number: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true,
            },
        },
        messages: {
            contact_number: {
                required: "Please enter your contact number",
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

            $.ajax({
                type: "POST",
                url: actionUrl, // will be /auth/send-otp
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#loader").show();
                },
                success: function (response) {
                    if (response.message) {
                        showToast(response.message, "success");
                        // Hide form, show OTP input section
                        var contactNumber = $("#contact_number").val();
                        $("#contactNumber").val(contactNumber);

                        $("#otp-section").hide();
                        $("#verify-section").show();
                         startResendTimer(60);
                    } else if (response.error) {
                        showToast(response.error, "error");
                    }
                },
                error: function (xhr) {
                    try {
                        const errors = xhr.responseJSON.errors;
                        printErrorMsg(errors);
                    } catch (e) {
                        showToast("Something went wrong. Please try again.", "error");
                    }
                },
                complete: function () {
                    $("#loader").fadeOut();
                },
            });
        },
    });

    // Resend OTP

    $("#verifyOtpForm").validate({
        rules: {
            otp_code: {
                required: true,
                number: true,
                minlength: 6,
                maxlength: 6
            }
        },
        messages: {
            otp_code: {
                required: "Please enter OTP",
                number: "OTP must be numbers only",
                minlength: "OTP must be 6 digits",
                maxlength: "OTP must be 6 digits"
            }
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element) { $(element).addClass("is-invalid"); },
        unhighlight: function (element) { $(element).removeClass("is-invalid"); },
        submitHandler: function (form) {
            var formData = new FormData(form);
            const actionUrl = $(form).attr("action");
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () { $("#loader").show(); },
                success: function (res) {                  
                    showToast(res.message, "success");
                    location.reload();
                },
                error: function (xhr) {
                    console.log(xhr.responseJSON.message)
                    showToast(xhr.responseJSON.message || "Something went wrong.", "error");
                },
                complete: function () { $("#loader").fadeOut(); }
            });
        }
    });

    // ------------------- Resend OTP -------------------
    $("#resendOtpBtn").click(function () {
        var contact = $("#contact_number").val();

        if (!contact || contact.length != 10) {
            showToast("Enter valid contact number first.", "error");
            return;
        }

        $.ajax({
            type: "POST",
            url: reSendOtp,
            data: {  // ✅ send inside `data`
                contact_number: contact
            },
            cache: false,
            success: function (res) {
                showToast(res.message, "success");
               startResendTimer(60);
            },
            error: function (xhr) {
                let msg = "Something went wrong.";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                showToast(msg, "error");
            }
        });
    });



});


function startResendTimer(seconds) {
        let btn = $("#resendOtpBtn");
        btn.prop("disabled", true);
        let originalText = btn.text();
        let counter = seconds;

        let timer = setInterval(function() {
            btn.text(`Resend OTP in ${counter}s`);
            counter--;

            if (counter < 0) {
                clearInterval(timer);
                btn.prop("disabled", false).text(originalText);
            }
        }, 1000);
    }


document.addEventListener("DOMContentLoaded", function () {
    const otpInputs = document.querySelectorAll(".otp-input");
    const otpHidden = document.getElementById("otp_code");

    otpInputs.forEach((input, index) => {
        // typing
        input.addEventListener("input", function () {
            this.value = this.value.replace(/[^0-9]/g, "");
            if (this.value && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
            updateOtpValue();
        });

        // backspace navigation
        input.addEventListener("keydown", function (e) {
            if (e.key === "Backspace" && !this.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });

        // ✅ paste handling
        input.addEventListener("paste", function (e) {
            e.preventDefault();
            const pasteData = (e.clipboardData || window.clipboardData).getData("text").trim();
            if (!/^\d+$/.test(pasteData)) return;

            pasteData.split("").forEach((char, i) => {
                if (i < otpInputs.length) {
                    otpInputs[i].value = char;
                }
            });

            updateOtpValue();
            // move focus to last filled box
            const lastIndex = Math.min(pasteData.length, otpInputs.length) - 1;
            otpInputs[lastIndex].focus();
        });
    });

    function updateOtpValue() {
        otpHidden.value = Array.from(otpInputs).map(i => i.value).join("");
    }

    document.getElementById("verifyOtpForm").addEventListener("submit", function (e) {
        updateOtpValue();
        if (!otpHidden.value || otpHidden.value.length !== 6) {
            e.preventDefault();
            showToast("Please enter a valid 6-digit OTP.", "error");
            return false;
        }
    });
});

function printErrorMsg(msg) {
    $.each(msg, function (key, value) {
        $("." + key + "_err").text(value).show()
    });
}

$(document).ready(function () {
    $(".autocompleteoff").attr("autocomplete", "off");
    setTimeout('$(".autocompleteoff").val("");', 500);
});

$("#addUserModal").on("hidden.bs.modal", function () {
    $(this).find("form")[0].reset(); // Reset the form
    $(this).find(".error").text('');
    $(this).find("#idProofImg").html('');
    $(this).find("#profileImgPreview").html('');
    $(this).find(".is-invalid").removeClass("is-invalid"); // Remove validation errors
    $(this).find(".invalid-feedback").remove(); // Remove error messages
    $(this).find(".custom-file-label").text("Upload File"); // Reset file label text
});
$("#editUserModal").on("hidden.bs.modal", function () {
    $(this).find(".error").text('');
    $(this).find("#idProofImg").html('');
    $(this).find("#profileImgPreview").html('');
    $(this).find("form")[0].reset(); // Reset the form
    $(this).find(".is-invalid").removeClass("is-invalid"); // Remove validation errors
    $(this).find(".invalid-feedback").remove(); // Remove error messages
    $(this).find(".custom-file-label").text("Upload File"); // Reset file label text

    const passwordInput = $(this).find("#passwordEdit")[0];

    if (passwordInput) {
        passwordInput.setAttribute("disabled", "disabled");
        passwordInput.removeAttribute("required");
    }
});

