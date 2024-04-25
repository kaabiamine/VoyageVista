function validateFormSponsor() {
    // Get references to the input fields
    const sponsorName = document.getElementById("sponsor_name");
    const sponsorEmail = document.getElementById("sponsor_email");
    const sponsorPhone = document.getElementById("sponsor_phone");
    const sponsorWebsite = document.getElementById("sponsor_website");

    console.log(sponsorName, sponsorEmail, sponsorPhone, sponsorWebsite);
    // Clear any existing error messages
    const errorSpans = document.querySelectorAll(".error-message");
    for (const span of errorSpans) {
        span.textContent = ""; // Clear text content
    }

    // Error messages
    let isValid = true; // Flag to track validation status

    // Validate blank inputs
    const requiredFields = [sponsorName, sponsorEmail, sponsorPhone, sponsorWebsite];
    for (const field of requiredFields) {
        const errorMessage = `${field.id.replace(/_/g, ' ').toUpperCase()} is required.`;
        if (field.value.trim() === "") {
            showError(field, errorMessage);
            isValid = false;
        }
    }

    // Validate sponsor name
    if (!isValidName(sponsorName.value)) {
        const errorMessage = "Sponsor name cannot contain special characters or numbers.";
        showError(sponsorName, errorMessage);
        isValid = false;
    }

    // Validate email
    if (!isValidEmail(sponsorEmail.value)) {
        const errorMessage = "Please enter a valid email address.";
        showError(sponsorEmail, errorMessage);
        isValid = false;
    }

    // Validate phone number
    if (!isValidPhone(sponsorPhone.value)) {
        const errorMessage = "Phone number must be 8 digits.";
        showError(sponsorPhone, errorMessage);
        isValid = false;
    }

    // Validate website URL
    if (!isValidWebsite(sponsorWebsite.value)) {
        const errorMessage = "Website URL must start with 'https://'.";
        showError(sponsorWebsite, errorMessage);
        isValid = false;
    }

    // Prevent form submission if any error
    return isValid;
}

// Function to validate website URL
function isValidWebsite(website) {
    return website.startsWith("https://");
}

// The rest of the code for isValidEmail, isValidPhone, isValidName, and showError remains the same.
