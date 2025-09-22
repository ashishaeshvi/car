$().ready(function () {
    $("#brandForm").validate({
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
                        $("#brandTable").DataTable().ajax.reload(null, false);
                        showToast(response.message, "success");
                        if (response.type == "add") {
                            $("#showImg").html("");
                            $("#brandForm")[0].reset();
                            $(".close").click();
                        } else {
                            $("#brandForm")[0].reset();
                            $(".close").click();
                            let baseUrl = $('meta[name="base-url"]').attr(
                                "content"
                            );
                            $("#brandModal #editId").val(response.data.id);
                            $("#brandModal #Name").val(response.data.name);

                            if (response.data.brandImg != "") {
                                const signUrl =
                                    baseUrl +
                                    "/storage/" +
                                    response.data.brandImg;
                                $("#FeSignImg").html(
                                    `<img src="${signUrl}" alt="brandImg" style="max-width: 100px; height: 60px;">`
                                );
                            }
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
    var $modal = $("#brandModal");

    var form = $modal.find("form")[0];
    if (form) form.reset();

    $modal.find(".is-invalid").removeClass("is-invalid");
    $modal.find(".invalid-feedback").remove();

    $modal.find(".custom-file-label").text("Upload File");
    $("#showImg").empty();
    $(".editmodal").show();
});

$(document).on("click", ".edit-brand", function () {
    let encryptedId = $(this).data("id");
    $(".editmodal").hide();

    let baseUrl = $('meta[name="base-url"]').attr("content");
    $.ajax({
        url: baseUrl + "/brand/" + encryptedId + "/edit",
        type: "GET",
        beforeSend: function () {
            $("#loader").show();
        },
        success: function (res) {
           
            if (res.status) {
                // Update modal title and fields
                $("#brandModal #modalTitle").html("Update Brand");
                $("#brandModal #editId").val(res.doc.id);
                $("#brandModal #Name").val(res.doc.name);
                // Display brand image if exists
                if (res.doc.brandImg) {
                    // check if brandImg is not null/empty
                    const signUrl = baseUrl + "/storage/" + res.doc.brandImg;
                    $("#showImg").html(
                        `<img src="${signUrl}" alt="brandImg" style="max-width: 100px; height: 60px;">`
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

$(document).on("click", ".view-brand", function () {
    let encryptedId = $(this).data("id");
    let baseUrl = $('meta[name="base-url"]').attr("content");
    $.ajax({
        url: baseUrl + "/brand/" + encryptedId + "/edit",
        type: "GET",
        beforeSend: function () {
            $("#loader").show();
        },
        success: function (res) {
            if (res.status) {
                $("#viewName").html(res.doc.name);
               
                if (res.doc.brandImg != "") {
                    const brandImgUrl =
                        baseUrl + "/storage/" + res.doc.brandImg;
                    $("#viewBrandImg").html(
                        `<img src="${brandImgUrl}" alt="brandImgUrl" style="max-width: 100px; height: 60px;">`
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
