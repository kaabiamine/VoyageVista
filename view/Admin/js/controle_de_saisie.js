document.addEventListener("DOMContentLoaded", function() {
    console.log("Script loaded and DOM fully loaded.");

    const form = document.getElementById('registrationForm');
    form.addEventListener('submit', function(event) {
      var isValid = true;

      const inputName = document.getElementById('inputName');
      if (/\d/.test(inputName.value)) {
        console.log("Name validation failed");
        isValid = false;
        inputName.classList.add('is-invalid');
      } else {
        inputName.classList.remove('is-invalid');
      }

      const inputLastname = document.getElementById('inputLastname');
      if (/\d/.test(inputLastname.value)) {
        console.log("Last validation failed");
        isValid = false;
        inputLastname.classList.add('is-invalid');
      } else {
        inputLastname.classList.remove('is-invalid');
      }

      const inputEmail = document.getElementById('inputEmail');
      if (!/^\S+@\S+\.\S+$/.test(inputEmail.value)) {
        console.log("Email validation failed");
        isValid = false;
        inputEmail.classList.add('is-invalid');
      } else {
        inputEmail.classList.remove('is-invalid');
      }

      const inputPhone = document.getElementById('inputPhone');
      if (!/^\d+$/.test(inputPhone.value)) {
        console.log("Phone validation failed");
        isValid = false;
        inputPhone.classList.add('is-invalid');
      } else {
        inputPhone.classList.remove('is-invalid');
      }

      const inputPassword = document.getElementById('inputPassword');
      if (!/(?=.*\d)(?=.*[A-Z])(?=.*[^a-zA-Z0-9])/.test(inputPassword.value)) {
        console.log("Password validation failed");
        isValid = false;
        inputPassword.classList.add('is-invalid');
      } else {
        inputPassword.classList.remove('is-invalid');
      }

      if (!isValid) {
        console.log("Form validation failed, preventing submission.");
        event.preventDefault();
      } else {
        console.log("Form validated successfully, proceeding with submission.");
      }
    });
  });