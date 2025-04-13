<?php 
    session_start();
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "lugarlangdb";
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
 
    if(!$conn){
        echo "<script>alert('Database connection failed. Please try again later.');</script>";
        exit;
    }

    if(isset($_POST["submitBtn"])){
        $name = $_POST["fullName"];
        $email = $_POST["email"];
        $pass = $_POST["password"];
        $confPass = $_POST["confirmPassword"];
        
        $passHash = password_hash($pass, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($conn, "INSERT INTO registration (name, email, password) VALUES ( ?, ?, ? )") ;
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $passHash);

        if (empty($name) || empty($email) || empty($pass) || empty($confPass)) {
            echo "<script>alert('All fields are required.')</script>";
            exit;
        }

        if(mysqli_stmt_execute($stmt)){
            $user_id = mysqli_insert_id($conn);
            $_SESSION["user_id"] = $user_id;
        
            $stmt2 = mysqli_prepare($conn, "INSERT INTO account_setup (user_id) VALUES (?)") ;
            mysqli_stmt_bind_param($stmt2, "i", $user_id);

            if(mysqli_stmt_execute($stmt2)){
                echo "<script>alert('Your Files are Uploaded')</script>";
                mysqli_stmt_close($stmt2);
            }
            else{
                echo "<script>alert('Failed to insert in Account Setup')</script>";
            }
        }
        else{
            echo "<script>alert('Something is Wrong')</script>";
        }
        mysqli_stmt_close($stmt);
    }
?>