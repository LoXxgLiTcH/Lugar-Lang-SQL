<?php
    require("registration.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Lugar Lang</title>
    <link rel="stylesheet" href="../main.css">
</head>
<body>
    <div class="form-container">
        <h2>Create an account</h2>
        <p>Enter your details to sign up for Lugar Lang!</p>
        
        <form method="POST" id="signupForm" action="registration.php" enctype="multipart/form-data">
            <div class="form-item">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" placeholder="John Doe">
                <div class="error" id="fullNameError"></div>
            </div>
            
            <div class="form-item">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="john@example.com">
                <div class="error" id="emailError"></div>
            </div>
            
            <div class="form-item">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="At least 8 characters">
                <div class="error" id="passwordError"></div>
            </div>
            
            <div class="form-item">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter your password">
                <div class="error" id="confirmPasswordError"></div>
            </div>
            
            <button type="submit" class="submit-button" id="submitButton" name="submitBtn">Sign Up</button>
        </form>
        
        <div class="login-redirect">
            Already have an account?
            <a href="/login" class="login-link">Log in</a>
        </div>
    </div>

    <script>
        document.getElementById("signupForm").addEventListener("submit", function(event) {

            const fullName = document.getElementById("fullName").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

       
            document.getElementById("fullNameError").textContent = "";
            document.getElementById("emailError").textContent = "";
            document.getElementById("passwordError").textContent = "";
            document.getElementById("confirmPasswordError").textContent = "";

            let isValid = true;

          
            if (!fullName || fullName.length < 2) {
                event.preventDefault();
                document.getElementById("fullNameError").textContent = "Name must be at least 2 characters.";
                isValid = false;
            }

       
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email || !emailPattern.test(email)) {
                event.preventDefault();
                document.getElementById("emailError").textContent = "Please enter a valid email address.";
                isValid = false;
            }

      
            if (password.length < 8) {
                event.preventDefault();
                document.getElementById("passwordError").textContent = "Password must be at least 8 characters.";
                isValid = false;
            }

   
            if (password !== confirmPassword) {
                event.preventDefault();
                document.getElementById("confirmPasswordError").textContent = "Passwords don't match.";
                isValid = false;
            }

            
            if (isValid) {
                alert("Account created successfully!");
            }
        });
    </script>
</body>
</html>