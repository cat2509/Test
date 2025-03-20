document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signup");

    // Input fields
    const nameInput = document.getElementById("name");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const passwordConfirmInput = document.getElementById("password-confirmation");

    // Error messages
    const nameError = document.getElementById("name-error");
    const emailError = document.getElementById("email-error");
    const passwordError = document.getElementById("password-error");
    const passwordConfirmError = document.getElementById("password-confirmation-error");

    // Function to show error
    function showError(input, errorElement, message) {
        errorElement.textContent = message;
        errorElement.style.display = "block";
        input.style.borderColor = "red";
    }

    // Function to clear error
    function clearError(input, errorElement) {
        errorElement.style.display = "none";
        input.style.borderColor = "";
    }

    // Real-time email verification using API
    emailInput.addEventListener("blur", function () {
        const email = emailInput.value.trim();

        if (email === "") {
            showError(emailInput, emailError, "Email is required");
            return;
        }

        fetch("verify-email.php?email=" + encodeURIComponent(email))
            .then(response => response.json())
            .then(data => {
                if (!data.valid) {
                    showError(emailInput, emailError, "This email does not exist or is invalid.");
                } else {
                    clearError(emailInput, emailError);
                }
            })
            .catch(error => console.error("Error:", error));
    });

    // Form validation on submit
    form.addEventListener("submit", function (event) {
        let isValid = true;

        if (nameInput.value.trim() === "") {
            showError(nameInput, nameError, "Name is required");
            isValid = false;
        } else {
            clearError(nameInput, nameError);
        }

        if (emailInput.value.trim() === "") {
            showError(emailInput, emailError, "Email is required");
            isValid = false;
        }

        if (passwordInput.value.length < 8) {
            showError(passwordInput, passwordError, "Password must be at least 8 characters");
            isValid = false;
        } else {
            clearError(passwordInput, passwordError);
        }

        if (passwordInput.value !== passwordConfirmInput.value) {
            showError(passwordConfirmInput, passwordConfirmError, "Passwords do not match");
            isValid = false;
        } else {
            clearError(passwordConfirmInput, passwordConfirmError);
        }

        if (!isValid) {
            event.preventDefault(); // Stop form submission if errors exist
        }
    });
});
