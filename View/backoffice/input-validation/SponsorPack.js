document.addEventListener("DOMContentLoaded", function () {
    // Function to check if a string contains numbers or special characters
    function containsNumbersOrSpecialChars(str) {
        const regex = /[^a-zA-Z ]/; // Only allow alphabets and spaces
        return regex.test(str);
    }

    // Function to check if a date is greater than or equal to the current date
    function isValidDate(dateString) {
        const today = new Date().toISOString().split('T')[0]; // Today's date in YYYY-MM-DD format
        return dateString >= today; // Check if dateString is >= today
    }

    // Function to clear error messages from all spans
    function clearErrorMessages() {
        const errorSpans = document.querySelectorAll(".text-danger");
        errorSpans.forEach((span) => {
            span.textContent = ""; // Clear existing error messages
        });
    }

    // Function to validate the form
    function validateForm() {
        clearErrorMessages(); // Clear existing error messages before validation
        let isValid = true; // Assume the form is valid initially

        // Validate pack name
        const packName = document.getElementById("pack_name").value.trim();
        const packNameError = document.getElementById("pack_name_error");
        if (packName === "") {
            packNameError.textContent = "Pack Name is required";
            isValid = false;
        } else if (containsNumbersOrSpecialChars(packName)) {
            packNameError.textContent = "Pack Name cannot contain numbers or special characters";
            isValid = false;
        }

        // Validate pack description
        const packDescription = document.getElementById("pack_description").value.trim();
        const packDescriptionError = document.getElementById("pack_description_error");
        if (packDescription === "") {
            packDescriptionError.textContent = "Pack Description is required";
            isValid = false;
        } else if (packDescription.length < 20 || packDescription.length > 50) {
            packDescriptionError.textContent = "Pack Description must be between 20 and 50 characters";
            isValid = false;
        }

        // Validate "updated_at" date
        const updatedAt = document.getElementById("updated_at").value;
        const updatedAtError = document.getElementById("updated_at_error");
        if (updatedAt === "") {
            updatedAtError.textContent = "Updated At date is required";
            isValid = false;
        } else if (!isValidDate(updatedAt)) {
            updatedAtError.textContent = "Updated At date must be greater than or equal to today";
            isValid = false;
        }

        // Validate the pack price
        const packPrice = document.getElementById("pack_price").value.trim();
        const packPriceError = document.getElementById("pack_price_error");
        if (packPrice === "") {
            packPriceError.textContent = "Pack Price is required";
            isValid = false;
        }

        // Validate the image pack
        const imagePack = document.getElementById("image_pack");
        const imagePackError = document.getElementById("image_pack_error");
        if (imagePack.files.length === 0) {
            imagePackError.textContent = "Image Pack is required";
            isValid = false;
        }

        return isValid; // Return whether the form is valid
    }

    // Attach the validation function to the form submission event
    const form = document.querySelector(".forms-sample");
    form.addEventListener("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});
