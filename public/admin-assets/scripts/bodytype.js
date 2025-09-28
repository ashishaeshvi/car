$().ready(function () {
    $("#bodyTypeForm").validate({
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
                        $("#bodyTypeTable").DataTable().ajax.reload(null, false);
                        showToast(response.message, "success");
                        if (response.type == "add") {
                            $("#showImg").html("");
                            $("#bodyTypeForm")[0].reset();
                            $(".close").click();
                        } else {
                            $("#bodyTypeForm")[0].reset();
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
    var $modal = $("#bodyTypeModal");
 $("#bodyTypeModal #modalTitle").html("Add Body Type");
    var form = $modal.find("form")[0];
    if (form) form.reset();

    $modal.find(".is-invalid").removeClass("is-invalid");
    $modal.find(".invalid-feedback").remove();

    $modal.find(".custom-file-label").text("Upload File");
    $("#showImg").empty();
    $(".editmodal").show();
});

$(document).on("click", ".edit-bodyType", function () {
    let encryptedId = $(this).data("id");
  
    $(".editmodal").hide();

    let baseUrl = $('meta[name="base-url"]').attr("content");
    $.ajax({
        url: baseUrl + "/body-types/" + encryptedId + "/edit",
        type: "GET",
        beforeSend: function () {
            $("#loader").show();
        },
        success: function (res) {
         
            if (res.status) {
                // Update modal title and fields
                $("#bodyTypeModal #modalTitle").html("Update Body Type");
                $("#bodyTypeModal #editId").val(res.doc.id);
                $("#bodyTypeModal #Name").val(res.doc.name);
                // Display brand image if exists
                if (res.doc.image) {
                    // check if brandImg is not null/empty
                    const signUrl = baseUrl + "/storage/" + res.doc.image;
                    $("#showImg").html(
                        `<img src="${signUrl}" alt="bodyTypeImg" style="max-width: 100px; height: 60px;">`
                    );
                } else {
                    $("#showImg").html(""); // clear previous image if none
                }
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

$(document).on("click", ".view-bodyType", function () {
    let encryptedId = $(this).data("id");
    let baseUrl = $('meta[name="base-url"]').attr("content");
    $.ajax({
        url: baseUrl + "/body-types/" + encryptedId + "/edit",
        type: "GET",
        beforeSend: function () {
            $("#loader").show();
        },
        success: function (res) {
            if (res.status) {
                $("#viewName").html(res.doc.name);
               
                if (res.doc.image != "") {
                    const brandImgUrl =
                        baseUrl + "/storage/" + res.doc.image;
                    $("#viewbodyTypeImg").html(
                        `<img src="${brandImgUrl}" alt="bodyTypeImg" style="max-width: 100px; height: 60px;">`
                    );
                }              

                
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
