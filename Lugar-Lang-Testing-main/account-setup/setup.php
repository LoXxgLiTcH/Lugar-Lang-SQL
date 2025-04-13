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

    if(isset($_POST["submit"])){
        $user_id = $_SESSION["user_id"];
        $name = $_POST["username"];
        $photo = $_FILES["photo"]["name"];
        $photo_tmp = $_FILES["photo"]["tmp_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $campus = $_POST["campus"];
        $role = $_POST["role"];
        $landmark = $_POST["landmark"];

        $ext = pathinfo($photo, PATHINFO_EXTENSION);
        $allowed_types = array("jpg", "png", "jpeg");
        $target_path = "profile_uploads/".$photo;
            if(in_array($ext, $allowed_types)){
                if(move_uploaded_file($photo_tmp, $target_path)){
                    $stmt = mysqli_prepare($conn, "UPDATE account_setup SET photo = ?, username = ?, auth_email = ?, phone_number = ?, def_campus = ?, role = ?, address = ? WHERE user_id = ?") ;
                       
                        mysqli_stmt_bind_param($stmt, "sssssssi", $photo, $name, $email, $phone, $campus, $role, $landmark, $user_id);

                        if(mysqli_stmt_execute($stmt)){
                            echo "<script>alert('Your Files are Uploaded')</script>";
                        }
                        else{
                            echo "<script>alert('Something is Wrong')</script>";
                        }
                        mysqli_stmt_close($stmt);
                    }
                    else{
                        echo "<script>alert('Account was not Created')</script>";
                    }
                }else{
                    echo "<script>alert('Photo File is not Allowed')</script>";
                }
            }
?>