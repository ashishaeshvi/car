$().ready(function () {
    $("#RADocumentForm").validate({
        rules: {
            ra_name: {
                required: true,
                maxlength: 60,
            },
            agency_name: {
                required: true,
                maxlength: 200,
            },
            ra_name_hindi: {
                required: true,
                maxlength: 100,
            },
            registration_no: {
                required: true,
                minlength: 10,
                maxlength: 60,
            },
            address: {
                required: true,
            },
            ra_sign: {
                required: function () {
                    return $("#raEditId").val() == ""; // required only for Add
                },
            },
            ra_stamp: {
                required: function () {
                    return $("#raEditId").val() == ""; // required only for Add
                },
            },
            "scan_notary[]": {
                required: function () {
                    return $("#raEditId").val() == ""; // required only for Add
                },
            },
            "affidavit_notary[]": {
                required: function () {
                    return $("#raEditId").val() == ""; // required only for Add
                },
            },
            letterpad_logo: {
                required: function () {
                    return $("#raEditId").val() == ""; // required only for Add
                },
            },
            letterpad_footer: {
                required: function () {
                    return $("#raEditId").val() == ""; // required only for Add
                },
            },
        },
        messages: {
            ra_name: {
                required: "Please enter RA name",
                maxlength: "RA name must not exceed 60 characters",
            },
            ra_name_hindi: {
                required: "Please enter RA name hindi",
                maxlength: "RA name must not exceed 100 characters",
            },
            registration_no: {
                required: "Please enter the registration number",
                minlength: "Registration number must be at least 10 characters",
                maxlength: "Registration number must not exceed 60 characters",
            },
            agency_name: {
                required: "Please enter Agency name",
                maxlength: "Agency name must not exceed 200 characters",
            },
            address: {
                required: "Please enter address",
            },
            ra_sign: {
                required: "Please upload RA sign",
            },
            ra_stamp: {
                required: "Please upload RA stamp",
            },
            "scan_notary[]": {
                required: "Please upload scan document",
            },
            "affidavit_notary[]": {
                required: "Please upload affidavit document",
            },
            letterpad_logo: {
                required: "Please upload letterpad logo",
            },
            letterpad_footer: {
                required: "Please upload letterpad footer",
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
                        $("#ra-document").DataTable().ajax.reload(null, false);
                        showToast(response.message, "success");
                        if (response.type == "add") {
                            $("#RADocumentForm")[0].reset();
                            resetPreviews();
                            resetFileInputs();
                             $(".close").click();
                        } else {
                             $(".close").click();
                            $("#RADocumentForm")[0].reset();
                            resetPreviews();
                            resetFileInputs();

                            const modal = $("#addRADocumentModal");
                            // Fill input fields
                            modal.find("#raEditId").val(response.data.id);
                            modal.find("#raName").val(response.data.ra_name);

                            modal
                                .find("#raNameHindi")
                                .val(response.data.ra_name_hindi);
                            modal
                                .find("#registrationNo")
                                .val(response.data.registration_no);

                            modal
                                .find("#raAgencyName")
                                .val(response.data.agency_name);
                            modal.find("#raAddress").val(response.data.address);
                            // Helper for PDF/file link rendering

                            renderImage(
                                "#RaSignImg",
                                response.data.ra_sign,
                                "RA Sign"
                            );
                            renderImage(
                                "#RaStampImg",
                                response.data.ra_stamp,
                                "RA Stamp"
                            );
                            renderImage(
                                "#LetterpadLogoImg",
                                response.data.letterpad_logo,
                                "Letterpad Logo"
                            );

                            renderImage(
                                "#LetterpadFooterImg",
                                response.data.letterpad_footer,
                                "Letterpad Logo"
                            );

                            if (Array.isArray(response.data.scan_notary)) {
                                let baseUrl = $('meta[name="base-url"]').attr(
                                    "content"
                                );
                                let container = $("#scanNotaryImg");

                                container.html(""); // Clear previous content

                                response.data.scan_notary.forEach(
                                    (img, index) => {
                                        const imageUrl = `${baseUrl}/storage/${img}`;
                                        container.append(
                                            `<img src="${imageUrl}" alt="Scan Notary ${
                                                index + 1
                                            }" style="max-width: 100px; height: 60px; margin-right: 5px;">`
                                        );
                                    }
                                );
                            }

                            if (Array.isArray(response.data.affidavit_notary)) {
                                let baseUrl = $('meta[name="base-url"]').attr(
                                    "content"
                                );
                                let container = $("#affidavitNotaryImg");

                                container.html(""); // Clear previous content

                                response.data.affidavit_notary.forEach(
                                    (img, index) => {
                                        const imageUrl = `${baseUrl}/storage/${img}`;
                                        container.append(
                                            `<img src="${imageUrl}" alt="Affidavit Notary ${
                                                index + 1
                                            }" style="max-width: 100px; height: 60px; margin-right: 5px;">`
                                        );
                                    }
                                );
                            }
                            // Render images
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
    $('.error').text('').hide(); // Clear and hide all errors

    $.each(msg, function (key, value) {
        if (key.startsWith('scan_notary')) {
            $('.scan_notary_err').text(value[0]).show();
        }else if(key.startsWith('affidavit_notary')) {
            $('.affidavit_notary_err').text(value[0]).show();
        }  else {
            $('.' + key + '_err').text(value[0]).show();
        }
    });
}

$(document).ready(function () {
    $(".autocompleteoff").attr("autocomplete", "off");
    setTimeout('$(".autocompleteoff").val("");', 500);
});

$(".custom-close").on("click", function () {
    var $modal = $("#addRADocumentModal");
    var form = $modal.find("form")[0];
    if (form) form.reset();
    $modal.find(".is-invalid").removeClass("is-invalid");
    $modal.find(".invalid-feedback").remove();
    $modal.find(".custom-file-label").text("Upload File");
    $(
        "#RaSignImg, #RaStampImg,#LetterpadLogoImg,#scanNotaryImg,#affidavitNotaryImg,#LetterpadFooterImg"
    ).empty();
    $modal.find("#modalTitle").text("Add RA Document");
    $(".editmodal").show();
});

$(document).on("click", ".edit-ra-document", function () {
    let encryptedId = $(this).data("id");
    $(".editmodal").hide();
    let baseUrl = $('meta[name="base-url"]').attr("content");
    $.ajax({
        url: baseUrl + "/ra-document/" + encryptedId + "/edit",
        type: "GET",
        beforeSend: function () {
            $("#loader").show();
        },
        success: function (response) {
            if (response.status) {
                $("#addRADocumentModal #modalTitle").html("Update RA Document");
                $("#addRADocumentModal #raEditId").val(response.doc.id);
                $("#addRADocumentModal #raName").val(response.doc.ra_name);

               $("#addRADocumentModal #raNameHindi").val(response.doc.ra_name_hindi);
               $("#addRADocumentModal #registrationNo").val(response.doc.registration_no);

                $("#addRADocumentModal #raAgencyName").val(response.doc.agency_name);
                $("#addRADocumentModal #raAddress").val(response.doc.address);
                renderImage("#RaSignImg", response.doc.ra_sign, "RA Sign");
                renderImage("#RaStampImg", response.doc.ra_stamp, "RA Stamp");
                renderImage(
                    "#LetterpadLogoImg",
                    response.doc.letterpad_logo,
                    "Letterpad Logo"
                );

                renderImage(
                    "#LetterpadFooterImg",
                    response.doc.letterpad_footer,
                    "Letterpad Logo"
                );

                if (Array.isArray(response.doc.scan_notary)) {
                    let baseUrl = $('meta[name="base-url"]').attr("content");
                    let container = $("#scanNotaryImg");

                    container.html(""); // Clear previous content

                    response.doc.scan_notary.forEach((img, index) => {
                        const imageUrl = `${baseUrl}/storage/${img}`;
                        container.append(
                            `<img src="${imageUrl}" alt="Scan Notary ${
                                img
                            }" style="max-width: 100px; height: 60px; margin-right: 5px;">`
                        );
                    });
                }

                if (Array.isArray(response.doc.affidavit_notary)) {
                    let baseUrl = $('meta[name="base-url"]').attr("content");
                    let container = $("#affidavitNotaryImg");

                    container.html(""); // Clear previous content

                    response.doc.affidavit_notary.forEach((img, index) => {
                        const imageUrl = `${baseUrl}/storage/${img}`;
                        container.append(
                            `<img src="${imageUrl}" alt="Affidavit Notary ${
                                index + 1
                            }" style="max-width: 100px; height: 60px; margin-right: 5px;">`
                        );
                    });
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

function renderImage(selector, filePath, altText) {
    if (filePath) {
        let baseUrl = $('meta[name="base-url"]').attr("content");
        const imageUrl = `${baseUrl}/storage/${filePath}`;
        $(selector).html(
            `<img src="${imageUrl}" alt="${altText}" style="max-width: 100px; height: 60px;">`
        );
    } else {
        $(selector).html(""); // Clear if no file
    }
}

function renderDownloadLink(selector, filePath, label = "Download") {
    if (filePath) {
        let baseUrl = $('meta[name="base-url"]').attr("content");
        const fileUrl = `${baseUrl}/storage/${filePath}`;
        $(selector).html(`<a href="${fileUrl}" download>${label}</a>`);
    } else {
        $(selector).html(""); // Clear if no file
    }
}

function resetPreviews() {
    // Clear preview containers
    $("#RaSignImg").html("");
    $("#RaStampImg").html("");
    $("#LetterpadLogoImg").html("");
    $("#scanNotaryImg").html("");
    $("#affidavitNotaryImg").html("");
}

function resetFileInputs() {
    // Clear file input values and reset labels
    $("#RADocumentForm .custom-file-input").each(function () {
        $(this).val(""); // reset file input
        $(this).next(".custom-file-label").html("Choose file"); // reset label
    });
}

$(document).on("click", ".view-ra-document", function () {
    let encryptedId = $(this).data("id");
    let baseUrl = $('meta[name="base-url"]').attr("content");
    $.ajax({
        url: baseUrl + "/ra-document/" + encryptedId + "/edit",
        type: "GET",
        beforeSend: function () {
            $("#loader").show();
        },
        success: function (response) {
            if (response.status) {
                $("#viewRADocumentModal #viewRaName").html(
                    response.doc.ra_name
                );
                $("#viewRADocumentModal #viewAgencyName").html(
                    response.doc.agency_name
                );
                $("#viewRADocumentModal #viewAddress").html(
                    response.doc.address ?? ""
                );

                  $("#viewRADocumentModal #viewRaNameHindi")
                    .html(response.doc.ra_name_hindi);
                $("#viewRADocumentModal #viewRegistrationNo")
                    .html(response.doc.registration_no);

                renderImage("#viewRaSignImg", response.doc.ra_sign, "RA Sign");
                renderImage(
                    "#viewRaStampImg",
                    response.doc.ra_stamp,
                    "RA Stamp"
                );
                renderImage(
                    "#viewLetterpadLogoImg",
                    response.doc.letterpad_logo,
                    "Letterpad Logo"
                );

                renderImage(
                    "#viewLetterpadFooterImg",
                    response.doc.letterpad_logo,
                    "Letterpad Logo"
                );

                if (Array.isArray(response.doc.scan_notary)) {
                    let baseUrl = $('meta[name="base-url"]').attr("content");
                    let container = $("#viewScanNotaryImg");

                    container.html(""); // Clear previous content

                    response.doc.scan_notary.forEach((img, index) => {
                        const imageUrl = `${baseUrl}/storage/${img}`;
                        container.append(
                            `<img src="${imageUrl}" alt="Scan Notary ${
                                index + 1
                            }" style="max-width: 100px; height: 60px; margin-right: 5px;">`
                        );
                    });
                }

                if (Array.isArray(response.doc.affidavit_notary)) {
                    let baseUrl = $('meta[name="base-url"]').attr("content");
                    let container = $("#viewAffidavitNotaryImg");

                    container.html(""); // Clear previous content

                    response.doc.affidavit_notary.forEach((img, index) => {
                        const imageUrl = `${baseUrl}/storage/${img}`;
                        container.append(
                            `<img src="${imageUrl}" alt="Affidavit Notary ${
                                index + 1
                            }" style="max-width: 100px; height: 60px; margin-right: 5px;">`
                        );
                    });
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

$(".text-uppercase").on("input", function () {
    this.value = this.value.toUpperCase();
});
