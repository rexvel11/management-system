
document.addEventListener('DOMContentLoaded', function () {
    // Form Visibility and Error Handling
    <?php if (!empty($error)) : ?>
        // Keep the register form visible if there are errors (provided by PHP)
        document.getElementById('login').style.display = 'none';
        document.getElementById('register').style.display = 'block';
    <?php elseif ($registration_success) : ?>
        // If registration is successful, hide register form, clear data and show login form
        document.getElementById('register').style.display = 'none';
        document.getElementById('login').style.display = 'block';

        // Clear all fields in the registration form
        document.getElementById('fName').value = '';
        document.getElementById('uName').value = '';
        document.getElementById('email').value = '';
        document.getElementById('password').value = '';
        document.getElementById('cpassword').value = '';
        document.querySelector('select[name="user_type"]').value = 'student';  // Reset user type selection
    <?php endif; ?>

    const signUpButton = document.getElementById('signUpButton');
    const signInButton = document.getElementById('signInButton');
    const login = document.getElementById('login');
    const register = document.getElementById('register');

    // Switch to register form when 'Sign Up' button is clicked
    signUpButton.addEventListener('click', function () {
        clearInputs(login);
        login.style.display = "none";
        register.style.display = "block";
    });

    // Switch to login form when 'Sign In' button is clicked
    signInButton.addEventListener('click', function () {
        clearInputs(register);
        login.style.display = "block";
        register.style.display = "none";
    });

    // Clear inputs and selects
   function clearInputs(form) {
        const inputs = form.querySelectorAll('input');
        const selects = form.querySelectorAll('select');
        inputs.forEach(input => input.value = '');
        selects.forEach(select => select.selectedIndex = 0);
    }

    // Clear all inputs and selects on page refresh
    window.onload = function () {
        allInputs.forEach(input => input.value = '');
        allSelects.forEach(select => select.selectedIndex = 0);
    };

    // Password validation logic
    const passwordField = document.getElementById('password');
    const lengthWarning = document.getElementById('length-warning');
    const specialWarning = document.getElementById('special-warning');
    const passwordRequirements = document.getElementById('password-requirements');

    // Regular expression for special character check
    const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;

    passwordRequirements.style.display = 'none';

    // Add an event listener for input events
    passwordField.addEventListener('input', function () {
        const password = passwordField.value;

        // Hide warning if input is empty


        if(password.trim() === ""){
            passwordRequirements.style.display = 'none';
            return;
        }

        passwordRequirements.style.display = 'block';

        // Check if the password is at least 8 characters long
        if (password.length >= 8) {
            lengthWarning.style.color = 'green';
        } else {
            lengthWarning.style.color = 'red';
        }

        // Check if the password includes at least one special character
        if (specialCharRegex.test(password)) {
            specialWarning.style.color = 'green';
        } else {
            specialWarning.style.color = 'red';
        }

        // If both requirements are met, hide the warning
        if (password.length >= 8 && specialCharRegex.test(password)) {
            passwordRequirements.style.display = 'none';
        } else {
            passwordRequirements.style.display = 'block';
        }
    });
});