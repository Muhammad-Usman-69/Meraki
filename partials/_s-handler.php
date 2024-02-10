<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["s-name"];
        $email = $_POST["s-email"];
        $pass = $_POST["s-pass"];
        $cpass = $_POST["s-cpass"];
        $p_img = "none";
        if ($name != "" && $email != "" && $pass != "" && $cpass != "") {
            include("_dbconnect.php");
            $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 0) {
                $sql = "SELECT * FROM `users` WHERE `name` = '$name'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                if ($num == 0) {
                    if ($pass == $cpass) {
                        $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
                        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
                        $pass = htmlspecialchars($pass, ENT_QUOTES, 'UTF-8');
                        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO `users` (`name`, `email`, `pass`, `profile_img`) VALUES (?, ?, ?, ?)";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $pass_hash, $p_img);
                        $result = mysqli_stmt_execute($stmt);
                        if ($result) {
                            header("location: /?alert=You have been signed up");
                            exit();
                        } else {
                            header("location: /?error=Error occured. Please try again later");
                            exit();
                        }
                    } else {
                        header("location: /?error=Passwords do not match");
                        exit();
                    }
                } else {
                    header("location: /?error=Name already in use");
                    exit();
                }
            } else {
                header("location: /?error=Email already in use");
                exit();
            }
        } else {
            header("location: /?error=Invalid cresidentials.");
            exit(); 
        }
    } else {
        header("location: /?error=Access denied. Please try again later");
        exit();
    }
?>