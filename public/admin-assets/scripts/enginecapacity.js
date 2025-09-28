$().ready(function () {
    $("#engineCapacityForm").validate({
        rules: {
            name: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter name",
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
                        $("#engineCapacityTable").DataTable().ajax.reload(null, false);
                        showToast(response.message, "success");
                        if (response.type == "add") {
                            $("#engineCapacityForm")[0].reset();
                            $(".close").click();
                        } else {
                            $("#editId").val('');
                            $("#engineCapacityForm")[0].reset();
                            $(".close").click();  
                        }
                    } else if (response.error) {
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

$(".custom-close").on("click", function () {
    $("#engineCapacityModal #modalTitle").html("Add Engine Capacity");
    $("#engineCapacityForm")[0].reset();
    var $modal = $("#engineCapacityModal");
    $modal.find(".is-invalid").removeClass("is-invalid");
    $modal.find(".invalid-feedback").remove();

});

$(document).on("click", ".edit-engineCapacity", function () {
    let encryptedId = $(this).data("id");
    $(".editmodal").hide();

    let baseUrl = $('meta[name="base-url"]').attr("content");
    $.ajax({
        url: baseUrl + "/engine-capacities/" + encryptedId + "/edit",
        type: "GET",
        beforeSend: function () {
            $("#loader").show();
        },
        success: function (res) {

            if (res.status) {
                // Update modal title and fields
                $("#engineCapacityModal #modalTitle").html("Update Engine Capacity");
                $("#engineCapacityModal #editId").val(res.doc.id);
                $("#engineCapacityModal #Name").val(res.doc.name);
                // Display engineCapacity image if exists

            } else {
                showToast(res.message || "Something went wrong.", "error");
            }
        },
        error: function (xhr) {
            if (xhr.status === 403) {
                alert("Permission denied.");
            } else {
                alert("Failed to load docs details.");
            }
        },
        complete: function () {
            $("#loader").fadeOut();
        },
    });
});


