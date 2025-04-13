<?php 
    require("login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Lugar Lang</title>
    <link rel="stylesheet" href="../main.css">
</head>
<body>
    <div class="form-container">
        <h2>Log In to Your Account</h2>
        <p>Enter your credentials to access Lugar Lang!</p>
        
        <form id="loginForm" method="POST" action="login.php" enctype="multipart/form-data">
            <div class="form-item">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="john@example.com">
                <div class="error" id="emailError"></div>
            </div>
            
            <div class="form-item">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password">
                <div class="error" id="passwordError"></div>
            </div>
            
            <button type="submit" class="submit-button" id="submitButton" name="login">Log In</button>
        </form>
        
        <div class="signup-redirect">
            Don't have an account?
            <a href="/Lugar-Lang-Testing-main/registration/" class="signup-link">Sign up</a>
        </div>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            // Reset previous errors
            document.getElementById("emailError").textContent = "";
            document.getElementById("passwordError").textContent = "";

            let isValid = true;

            // Validate email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                event.preventDefault();
                document.getElementById("emailError").textContent = "Please enter a valid email address.";
                isValid = false;
            }

            // Validate password
            if (password.length < 8) {
                event.preventDefault();
                document.getElementById("passwordError").textContent = "Password must be at least 8 characters.";
                isValid = false;
            }
        });
    </script>
</body>
</html>
