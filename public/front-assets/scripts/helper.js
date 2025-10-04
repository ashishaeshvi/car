function showToast(message, type = "success") {
    let background =
        type === "success"
            ? "linear-gradient(to right, #00b09b, #96c93d)" // green for success
            : "linear-gradient(to right, #ff5f6d, #ffc371)"; // red/orange for error

    Toastify({
        text: message,
        duration: 4000,
        gravity: "top",
        position: "right",
        backgroundColor: background,
    }).showToast();
}
