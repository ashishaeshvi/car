$().ready(function () {
    $("#FeDocumentForm").validate({
        rules: {
            name: {
                required: true,
            },
            fe_sign: {
                required: function () {
                    return $("#feEditId").val() == ""; // required only for Add
                },
            },
            fe_stamp: {
                required: function () {
                    return $("#feEditId").val() == ""; // required only for Add
                },
            },
        },
        messages: {
            name: {
                required: "Please enter name",
            },
            fe_sign: {
                required: "Please upload Fe sign",
            },
            fe_stamp: {
                required: "Please upload Fe stamp",
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
                        $("#fe-document").DataTable().ajax.reload(null, false);
                        showToast(response.message, "success");
                        if (response.type == "add") {                            
                            $("#FeSignImg").html('');
                            $("#FeStampImg").html('');
                            $("#FeDocumentForm")[0].reset();
                             $(".close").click();
                        } else {
                            
                            $("#FeDocumentForm")[0].reset();
                             $(".close").click();
                            let baseUrl = $('meta[name="base-url"]').attr(
                                "content"
                            );
                            $("#FeDocumentModal #feEditId").val(
                                response.data.id
                            );
                            $("#FeDocumentModal #FeName").val(
                                response.data.name
                            );
                            $("#feType").val(response.data.type);
                            if (response.data.type == "sign") {
                                if (response.data.attachment != "") {
                                    const signUrl =
                                        baseUrl +
                                        "/storage/" +
                                        response.data.attachment;
                                    $("#FeSignImg").html(
                                        `<img src="${signUrl}" alt="Fe Sign" style="max-width: 100px; height: 60px;">`
                                    );
                                }
                            }

                            if (response.data.type == "stamp") {
                                if (response.data.attachment != "") {
                                    const stampUrl =
                                        baseUrl +
                                        "/storage/" +
                                        response.data.attachment;
                                    $("#FeStampImg").html(
                                        `<img src="${stampUrl}" alt="Fe Stamp" style="max-width: 100px; height: 60px;">`
                                    );
                                }
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
        $("." + key + "_err").text(value).show()
    });
}

$(document).ready(function () {
    $(".autocompleteoff").attr("autocomplete", "off");
    setTimeout('$(".autocompleteoff").val("");', 500);
});

$(".custom-close").on("click", function () {
    var $modal = $("#FeDocumentModal");

    var form = $modal.find("form")[0];
    if (form) form.reset();

    $modal.find(".is-invalid").removeClass("is-invalid");
    $modal.find(".invalid-feedback").remove();

    $modal.find(".custom-file-label").text("Upload File");
    $("#FeSignImg, #FeStampImg").empty();

    $modal.find("#modalTitle").text("Add Fe Document");
    $(".editmodal").show();
});

$(document).on("click", ".edit-fe-document", function () {
    let encryptedId = $(this).data("id");
    $(".editmodal").hide();

    let baseUrl = $('meta[name="base-url"]').attr("content");
    $.ajax({
        url: baseUrl + "/fe-document/" + encryptedId + "/edit",
        type: "GET",
        beforeSend: function () {
            $("#loader").show();
        },
        success: function (res) {
            if (res.status) {
                $("#FeDocumentModal #modalTitle").html("Update Fe Document");
                $("#FeDocumentModal #feEditId").val(res.doc.id);
                $("#FeDocumentModal #FeName").val(res.doc.name);

                showField(res.doc.type);

                if (res.doc.type == "sign") {
                    if (res.doc.attachment != "") {
                        const signUrl =
                            baseUrl +
                            "/storage/" +
                            res.doc.attachment;
                        $("#FeSignImg").html(
                            `<img src="${signUrl}" alt="Fe Sign" style="max-width: 100px; height: 60px;">`
                        );
                    }
                }

                if (res.doc.type == "stamp") {
                    if (res.doc.attachment != "") {
                        const stampUrl =
                            baseUrl +
                            "/storage/" +
                            res.doc.attachment;
                        $("#FeStampImg").html(
                            `<img src="${stampUrl}" alt="Fe Stamp" style="max-width: 100px; height: 60px;">`
                        );
                    }
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

$(document).on("click", ".view-fe-document", function () {
    let encryptedId = $(this).data("id");
    let baseUrl = $('meta[name="base-url"]').attr("content");
    $.ajax({
        url: baseUrl + "/fe-document/" + encryptedId + "/edit",
        type: "GET",
        beforeSend: function () {
            $("#loader").show();
        },
        success: function (res) {
            if (res.status) {
                $("#viewFeDocumentModal #viewFeName").html(res.doc.name);
                const signDiv = document.getElementById("signViewDiv");
                const stampDiv = document.getElementById("stampViewDiv");

                if (res.doc.type == "sign") {
                      $("#feviewTitle").html("Fe Sign Name");
                    signDiv.style.display = "block";
                    stampDiv.style.display = "none";
                    if (res.doc.attachment != "") {
                        const signUrl =
                            baseUrl +
                            "/storage/" +
                            res.doc.attachment;
                        $("#viewFeSignImg").html(
                            `<img src="${signUrl}" alt="Fe Sign" style="max-width: 100px; height: 60px;">`
                        );
                    }
                }

                if (res.doc.type == "stamp") {
                      $("#feviewTitle").html("Fe Stamp Name");
                    signDiv.style.display = "none";
                    stampDiv.style.display = "block";
                    if (res.doc.attachment != "") {
                        const stampUrl =
                            baseUrl +
                            "/storage/" +
                            res.doc.attachment;
                        $("#viewFeStampImg").html(
                            `<img src="${stampUrl}" alt="Fe Stamp" style="max-width: 100px; height: 60px;">`
                        );
                    }
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

function showField(type) {
    const signDiv = document.getElementById("signDiv");
    const stampDiv = document.getElementById("stampDiv");
    const signInput = document.getElementById("fe_sign");
    const stampInput = document.getElementById("fe_stamp");

    if (type === "sign") {
        signDiv.style.display = "block";
        stampDiv.style.display = "none";
        signInput.disabled = false;
        stampInput.disabled = true;
        $("#feType").val("sign");
        $("#feTitle").html("Fe Sign Name");
        $("#FeName").attr("placeholder", "Fe Sign Name");
    } else if (type === "stamp") {
        signDiv.style.display = "none";
        stampDiv.style.display = "block";
        signInput.disabled = true;
        stampInput.disabled = false;
        $("#feType").val("stamp");
        $("#feTitle").html("Fe Stamp Name");
        $("#FeName").attr("placeholder", "Fe Stamp Name");
    } else {
        // Hide both if type is neither
        signDiv.style.display = "none";
        stampDiv.style.display = "none";
        signInput.disabled = true;
        stampInput.disabled = true;
        $("#feType").val("");
    }
}
