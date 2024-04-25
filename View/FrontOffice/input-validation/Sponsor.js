// Helper function to clear errors
function clearErrors() {
    const errorSpans = document.querySelectorAll(".error-message");
    errorSpans.forEach(span => span.textContent = "");
}

// Helper function to show errors
function showError(input, message) {
    let errorSpan = input.parentElement.nextElementSibling;
    if (errorSpan) {
        errorSpan.textContent = message;
    }
}

// Helper function for name validation (letters and spaces only)
function isValidName(name) {
    const namePattern = /^[A-Za-z\s]+$/;
    return namePattern.test(name);
}

// Helper function for email validation
function isValidEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

// Helper function for phone validation (at least 8 digits)
function isValidPhone(phone) {
    const phonePattern = /^\d{8,}$/;
    return phonePattern.test(phone);
}

// Helper function for website validation (must start with "https://")
function isValidWebsite(website) {
    return website.startsWith("https://");
}

// Function to validate the form on submit
function validateFormSponsor(event) {
    clearErrors(); // Clear existing errors

    const sponsorForm = event.target;
    const sponsorName = sponsorForm.querySelector("[name='sponsor_name']");
    const sponsorEmail = sponsorForm.querySelector("[name='sponsor_email']");
    const sponsorPhone = sponsorForm.querySelector("[name='sponsor_phone']");
    const sponsorWebsite = sponsorForm.querySelector("[name='sponsor_website']");
    const sponsorDescription = sponsorForm.querySelector("[name='sponsor_description']");
    const sponsorLogo = sponsorForm.querySelector("[name='sponsor_logo']");
    const sponsorAddress = sponsorForm.querySelector("[name='sponsor_address']");

    let isValid = true; // Flag for validation status

    // Required fields validation
    const requiredFields = [
        sponsorName,
        sponsorEmail,
        sponsorPhone,
        sponsorWebsite,
        sponsorDescription,
        sponsorLogo,
        sponsorAddress
    ];

    requiredFields.forEach(field => {
        if (field.value.trim() === "") {
            showError(field, `${field.name.replace('_', ' ').toUpperCase()} is required.`);
            isValid = false;
        }
    });

    // Specific field validations
    if (!isValidName(sponsorName.value)) {
        showError(sponsorName, "Sponsor name cannot contain special characters or numbers.");
        isValid = false;
    }

    if (!isValidEmail(sponsorEmail.value)) {
        showError(sponsorEmail, "Please enter a valid email address.");
        isValid = false;
    }

    if (!isValidPhone(sponsorPhone.value)) {
        showError(sponsorPhone, "Phone number must be at least 8 digits and contain only numbers.");
        isValid = false;
    }

    if (!isValidWebsite(sponsorWebsite.value)) {
        showError(sponsorWebsite, "Website URL must start with 'https://'.");
        isValid = false;
    }

    // Prevent form submission if any validation fails
    if (!isValid) {
        event.preventDefault(); // Prevent form submission if there are validation errors
    }
}

// Attach the validation function to the form's submit event
document.querySelector("#sponsorForm").addEventListener("submit", validateFormSponsor);

// Real-time validation
document.querySelectorAll("#sponsorForm input, #sponsorForm textarea").forEach(field => {
    field.addEventListener("input", () => {
        const errorSpan = field.parentElement.nextElementSibling;
        if (errorSpan) {
            errorSpan.textContent = ""; // Clear the error message as the user types
        }
    });
});
