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

    if(isset($_POST["login"])){
        $email = $_POST["email"];
        $pass = $_POST["password"];

        $stmt = mysqli_prepare($conn, "SELECT id, password FROM registration WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($user){
            if(password_verify($pass, $user["password"])){
                $_SESSION["user_id"] = $user["id"];
                header("Location: /Lugar-Lang-Testing-main/account-setup/");
                exit();
            }
            else{
                echo "<script>alert('Wrong Email or Password');</script>";
            }
        }
        else{
            echo "<script>alert('Wrong Email or Password');</script>";
        }
    }
?>