// SponsorPack.js
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector(".forms-sample");

    form.addEventListener("submit", function(event) {
        let hasError = false;

        // Validate Pack Name
        const packName = document.getElementById("pack_name");
        const packNameError = document.getElementById("pack_name_error");
        if (!packName.value.trim()) {
            packNameError.textContent = "Pack Name is required.";
            hasError = true;
        } else {
            packNameError.textContent = "";
        }

        // Validate Pack Description
        const packDescription = document.getElementById("pack_description");
        const packDescriptionError = document.getElementById("pack_description_error");
        if (!packDescription.value.trim()) {
            packDescriptionError.textContent = "Pack Description is required.";
            hasError = true;
        } else {
            packDescriptionError.textContent = "";
        }

        // Validate Pack Price
        const packPrice = document.getElementById("pack_price");
        const packPriceError = document.getElementById("pack_price_error");
        if (!packPrice.value.trim() || isNaN(packPrice.value) || packPrice.value <= 0) {
            packPriceError.textContent = "Pack Price must be a positive number.";
            hasError = true;
        } else {
            packPriceError.textContent = "";
        }

        // Validate Pack Status
        const packStatus = document.getElementById("pack_status");
        const packStatusError = document.getElementById("pack_status_error");
        if (!packStatus.value.trim()) {
            packStatusError.textContent = "Pack Status is required.";
            hasError = true;
        } else {
            packStatusError.textContent = "";
        }

        // Prevent form submission if there's any error
        if (hasError) {
            event.preventDefault();
        }
    });

    // Real-time validation on input change
    const inputs = form.querySelectorAll("input, textarea, select");
    inputs.forEach(function(input) {
        input.addEventListener("input", function() {
            form.dispatchEvent(new Event("submit", { cancelable: true }));
        });
    });
});
