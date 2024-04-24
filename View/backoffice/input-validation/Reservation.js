function validateForm() {
    // Get references to the input fields
    const dateReservation = document.getElementById("date_reservation");
    const nom = document.getElementById("nom");
    const prenom = document.getElementById("prenom");
    const email = document.getElementById("email");
    const telephone = document.getElementById("telephone");
    const nbEnfants = document.getElementById("nb_enfants");
    const nbAdultes = document.getElementById("nb_adultes");

    // Clear any existing error messages (optional)
    const errorSpans = document.querySelectorAll(".error-message");
    for (const span of errorSpans) {
        span.textContent = ""; // Clear text content
        span.style.color = ""; // Reset color (optional)
    }

    // Error messages
    let isValid = true; // Flag to track validation status

    // Validate blank inputs
    const requiredFields = [dateReservation, nom, prenom, email, telephone];
    for (const field of requiredFields) {
        const errorMessage = `${field.id.replace(/_/g, ' ').toUpperCase()} is required.`;
        if (field.value.trim() === "") {
            showError(field, errorMessage);
            isValid = false;
        }
    }

    // Validate date reservation (superior to a specific date)
    const today = new Date();
    const selectedDate = new Date(dateReservation.value);
    if (selectedDate <= today) {
        const errorMessage = "Date Reservation must be after today.";
        showError(dateReservation, errorMessage);
        isValid = false;
    }

    // Validate email
    if (!isValidEmail(email.value)) {
        const errorMessage = "Please enter a valid email address.";
        showError(email, errorMessage);
        isValid = false;
    }

    // Validate phone number (8 digits, no special characters or letters)
    if (!isValidPhone(telephone.value)) {
        const errorMessage = "Phone number must be 8 digits with no special characters or letters.";
        showError(telephone, errorMessage);
        isValid = false;
    }

    // Validate nom and prenom
    if (!isValidName(nom.value) || !isValidName(prenom.value)) {
        const errorMessage = "Nom and Prénom cannot contain numbers or special characters.";
        showError(nom, errorMessage); // You can show error for both nom and prenom
        isValid = false;
    }

    // Validate nbEnfants and nbAdultes (optional, can add checks for non-negative numbers)

    // Prevent form submission if any error
    return isValid;
}

// Function to validate email format
function isValidEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// Function to validate phone number (8 digits, no special characters or letters)
function isValidPhone(phone) {
    const re = /^\d{8}$/;
    return re.test(phone);
}

// Function to validate name (no numbers or special characters)
function isValidName(name) {
    const re = /^[a-zA-Z]+$/; // Only allows letters
    return re.test(name);
}

// Function to show error message
function showError(input, message) {
    const errorSpan = input.nextElementSibling; // Get the next sibling element (assuming the error span follows the input)
    if (errorSpan && errorSpan.classList.contains("error-message")) {
        errorSpan.textContent = message;
        errorSpan.style.color = "red"; // Set error message color to red
    } else {
        // Create a new error span if it doesn't exist
        const span = document.createElement("span");
        span.classList.add("error-message");
        span.textContent = message;
        span.style.color = "red"; // Set error message color to red
        input.parentNode.insertBefore(span, input.nextSibling); // Insert the span after the input
    }
}
