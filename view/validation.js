document.getElementById("turf-form").onsubmit = function validate(event) {
        var username = document.getElementById("username").value.trim();
        var password = document.getElementById("password").value.trim();
        var confirmPassword = document.getElementById("confirm_password").value.trim();
        var turfName = document.getElementById("turf_name").value.trim();
        var phone = document.getElementById("phone").value.trim();
        var email = document.getElementById("email").value.trim();
        var address = document.getElementById("address").value.trim();
        var ownerName = document.getElementById("owner_name").value.trim();
        var ownerPhone = document.getElementById("owner_phone").value.trim();
        var ownerEmail = document.getElementById("owner_email").value.trim();
        var ownerNid = document.getElementById("owner_nid").value.trim();
        var sportsCheckboxes = document.querySelectorAll('input[name="sports[]"]');
        var sportsError = document.getElementById("sports_error");

        // Clear previous error messages
        
        document.getElementById("username_error").innerHTML = "";
        document.getElementById("password_error").innerHTML = "";
        document.getElementById("confirm_password_error").innerHTML = "";

        document.getElementById("turf_name_error").innerHTML = "";
        document.getElementById("phone_error").innerHTML = "";
        document.getElementById("email_error").innerHTML = "";
        document.getElementById("address_error").innerHTML = "";
        document.getElementById("owner_name_error").innerHTML = "";
        document.getElementById("owner_phone_error").innerHTML = "";
        document.getElementById("owner_email_error").innerHTML = "";
        document.getElementById("owner_nid_error").innerHTML = "";
        sportsError.innerHTML = "";

        // --- Username Validation ---
        if (username === "") {
            document.getElementById("username_error").innerHTML = "Username is required.";
            event.preventDefault();
            return false;
        }
        if (username.length < 4) {
            document.getElementById("username_error").innerHTML = "Username must be at least 4 characters.";
            event.preventDefault();
            return false;
        }

        // --- Password Validation ---
        if (password === "") {
            document.getElementById("password_error").innerHTML = "Password is required.";
            event.preventDefault();
            return false;
        }
        if (password.length < 6) {
            document.getElementById("password_error").innerHTML = "Password must be at least 6 characters.";
            event.preventDefault();
            return false;
        }

        // --- Confirm Password Validation ---
        if (confirmPassword === "") {
            document.getElementById("confirm_password_error").innerHTML = "Please confirm your password.";
            event.preventDefault();
            return false;
        }
        if (password !== confirmPassword) {
            document.getElementById("confirm_password_error").innerHTML = "Passwords do not match.";
            event.preventDefault();
            return false;
        }

        // Validation for empty fields
        if (turfName === "") {
            document.getElementById("turf_name_error").innerHTML = "Turf name is required.";
            event.preventDefault();
            return false;
        }
        if (turfName.length < 3) {
            document.getElementById("turf_name_error").innerHTML = "Turf name must be at least 3 characters long.";
            event.preventDefault();
            return false;
        }

        if (phone === "") {
            document.getElementById("phone_error").innerHTML = "Phone number is required.";
            event.preventDefault();
            return false;
    }
    if (!/^\d{11}$/.test(phone)) {
        document.getElementById("phone_error").innerHTML = "Phone number must be exactly 11 digits.";
        event.preventDefault();
        return false;
    }

    if (email === "") {
        document.getElementById("email_error").innerHTML = "Email is required.";
        event.preventDefault();
        return false;
    }
    if (!/^[\w\.-]+@[\w\.-]+\.\w{2,}$/.test(email)) {
        document.getElementById("email_error").innerHTML = "Invalid email format.";
        event.preventDefault();
        return false;
    }

    if (address === "") {
        document.getElementById("address_error").innerHTML = "Address is required.";
        event.preventDefault();
        return false;
    }
    if (address.length < 5) {
        document.getElementById("address_error").innerHTML = "Address must be at least 5 characters long.";
        event.preventDefault();
        return false;
    }

    if (ownerName === "") {
        document.getElementById("owner_name_error").innerHTML = "Owner's name is required.";
        event.preventDefault();
        return false;
    }
    if (ownerName.length < 3) {
        document.getElementById("owner_name_error").innerHTML = "Owner's name must be at least 3 characters long.";
        event.preventDefault();
        return false;
    }

    if (ownerPhone === "") {
        document.getElementById("owner_phone_error").innerHTML = "Owner's phone is required.";
        event.preventDefault();
        return false;
    }
    if (!/^\d{11}$/.test(ownerPhone)) {
        document.getElementById("owner_phone_error").innerHTML = "Owner's phone must be exactly 11 digits.";
        event.preventDefault();
        return false;
    }

    if (ownerEmail === "") {
        document.getElementById("owner_email_error").innerHTML = "Owner's email is required.";
        event.preventDefault();
        return false;
    }
    if (!/^[\w\.-]+@[\w\.-]+\.\w{2,}$/.test(ownerEmail)) {
        document.getElementById("owner_email_error").innerHTML = "Invalid owner's email format.";
        event.preventDefault();
        return false;
    }


    return true;
};
