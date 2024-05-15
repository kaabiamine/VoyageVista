document.addEventListener('DOMContentLoaded', () => {
    // Get the form element
    const form = document.querySelector('form');

    // Function to clear previous errors
    const clearErrors = () => {
        const errorSpans = document.querySelectorAll('.error');
        errorSpans.forEach((span) => {
            span.textContent = '';
        });
    };

    // Function to validate if a field is not blank
    const validateNotBlank = (field, errorSpan, fieldName) => {
        if (!field.value.trim()) {
            errorSpan.textContent = `${fieldName} cannot be blank.`;
            return false;
        }
        return true;
    };

    // Function to validate the form
    form.addEventListener('submit', (event) => {
        // Get the input elements and corresponding error spans
        const mantant = document.getElementById('mantant');
        const mantantError = document.getElementById('mantant-error');
        const paymentMethod = document.getElementById('paymentMethod');
        const paymentMethodError = document.getElementById('payment-method-error');
        const rib = document.getElementById('rib');
        const ribError = anotherSpan = document.getElementById('rib-error');

        // Clear previous errors
        clearErrors();

        // Flag to check if the form is valid
        let isValid = true;

        // Validate fields for non-blank condition
        isValid = validateNotBlank(mantant, mantantError, 'Mantant') &&
            validateNotBlank(paymentMethod, paymentMethodError, 'Payment Method') &&
            validateNotBlank(rib, ribError, 'RIB');

        // Additional validations for each field
        if (isValid) {
            // Validate mantant: must be positive and contain only numbers
            if (isNaN(mantant.value) || parseFloat(mantant.value) <= 0) {
                isValid = false;
                mantantError.textContent = 'Mantant must be a positive number.';
            }

            // Validate RIB: must be 12 characters and contain only numbers
            if (rib.value.length !== 12 || isNaN(rib.value)) {
                isValid = false;
                ribError.textContent = 'RIB must be exactly 12 numeric characters.';
            }
        }

        if (!isValid) {
            // Prevent form submission
            event.preventDefault();
        }
    });
});
