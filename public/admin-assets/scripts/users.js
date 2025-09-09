$().ready(function () {
    $("#addUserForm").validate({
        rules: {
            role_id: {
                required: true,
            },
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 8,
            },
            mobile: {
                minlength: 10,
                maxlength: 10,
                number: true,
            },
        },
        messages: {
            role_id: {
                required: "Please select user role",
            },
            name: {
                required: "Please enter your name",
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address",
            },
            password: {
                required: "Please enter your password",
                minlength: "Password must be at least 8 characters long",
            },
            mobile: {
                number: "Please enter numbers only",
                minlength: "Mobile number must be exactly 10 digits",
                maxlength: "Mobile number must be exactly 10 digits",
            },
        },
        tooltip_options: {
            role_id: {
                placement: "bottom",
                html: true,
            },
            name: {
                placement: "bottom",
                html: true,
            },
            email: {
                placement: "bottom",
                html: true,
            },
            password: {
                placement: "bottom",
                html: true,
            },
            mobile: {
                placement: "bottom",
                html: true,
            },
        },

        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },

        submitHandler: function (form) {
            var formData = new FormData($("#addUserForm")[0]);
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
                        $("#user-table").DataTable().ajax.reload(null, false);
                        showToast(response.message, "success");
                        $("#idProofImg").html("");
                        $("#profileImgPreview").html("");
                        $("#addUserForm")[0].reset();
                          $(".close").click();
                    } else if (response.error) {
                        $("#loader").fadeOut();
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

    $("#editUserForm").validate({
        rules: {
            role_id: {
                required: true,
            },
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: {
                    depends: function () {
                        return $("#enablePasswordEdit").is(":checked");
                    },
                },
                minlength: {
                    depends: function () {
                        return $("#enablePasswordEdit").is(":checked");
                    },
                    param: 8,
                },
            },
            mobile: {
                minlength: 10,
                maxlength: 10,
                number: true,
            },
        },
        messages: {
            role_id: {
                required: "Please select user role",
            },
            name: {
                required: "Please enter your name",
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address",
            },
            password: {
                required: "Please enter your password",
                minlength: "Password must be at least 8 characters long",
            },
            mobile: {
                number: "Please enter numbers only",
                minlength: "Mobile number must be exactly 10 digits",
                maxlength: "Mobile number must be exactly 10 digits",
            },
        },
        tooltip_options: {
            role_id: {
                placement: "bottom",
                html: true,
            },
            name: {
                placement: "bottom",
                html: true,
            },
            email: {
                placement: "bottom",
                html: true,
            },
            password: {
                placement: "bottom",
                html: true,
            },
            mobile: {
                placement: "bottom",
                html: true,
            },
        },

        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },

        submitHandler: function (form) {
            var formData = new FormData($("#editUserForm")[0]);
            var id = $('input[name="id"]').val();
            let baseUrl = $('meta[name="base-url"]').attr("content");
            $(".error").html("");
            $.ajax({
                type: "POST",
                url: baseUrl + "/user/" + id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#loader").show();
                },
                success: function (response) {
                    if (response.success) {
                        $("#user-table").DataTable().ajax.reload(null, false);
                        showToast(response.message, "success");
                        $(".close").click();
                    } else if (response.error) {
                        $("#loader").fadeOut();
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

$(document).on("click", ".edit-user", function () {
    let encryptedId = $(this).data("id");
    let baseUrl = $('meta[name="base-url"]').attr("content");
    $.ajax({
        url: baseUrl + "/user/" + encryptedId + "/edit",
        type: "GET",
        beforeSend: function () {
            $("#loader").show();
        },
        success: function (res) {
            if (res.status) {
                // Fill modal form with data
                $("#editUserModal #roleId").val(res.user.role_id);
                $("#editUserModal #userId").val(res.user.id);
                $("#editUserModal #userName").val(res.user.name);
                $("#editUserModal #userEmail").val(res.user.email);
                $("#editUserModal #userMobile").val(res.user.mobile);
                $("#editUserModal #userAddress").val(res.user.address);

                if (res.user.id_proof != "") {
                    const signUrl = baseUrl + "/storage/" + res.user.id_proof;
                    $("#editIdProofImg").html(
                        `<img src="${signUrl}" alt="" style="max-width: 100px; height: 60px;">`
                    );
                }

                if (res.user.profile_image != "") {
                    const signUrl =
                        baseUrl + "/storage/" + res.user.profile_image;
                    $("#editProfileImgPreview").html(
                        `<img src="${signUrl}" alt="" style="max-width: 100px; height: 60px;">`
                    );
                }
                $("#editUserModal").modal("show");
            } else {
                showToast(res.message || "Something went wrong.", "error");
            }
        },
        error: function (xhr) {
            if (xhr.status === 403) {
                alert("Permission denied.");
            } else {
                alert("Failed to load user details.");
            }
        },
        complete: function () {
            $("#loader").fadeOut();
        },
    });
});
