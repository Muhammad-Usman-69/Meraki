<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["l-email"];
        $pass = $_POST["l-pass"];
        if ($email != "" && $pass != "") {
            include("_dbconnect.php");
            $sql = "SELECT * FROM `users` WHERE `email` = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $num = mysqli_num_rows($result);
            if ($num != 0) {
                $row = mysqli_fetch_assoc($result);
                $name = $row["name"];
                $id = $row["id"];
                if (password_verify($pass, $row["pass"])) {
                    session_start();
                    $_SESSION["log"] = true;
                    $_SESSION["name"] = $name;
                    $_SESSION["email"] = $email;
                    $_SESSION["id"] = $id;
                    header("location: /?alert=You are logged in");
                    exit(); 
                } else {
                    header("location: /?error=Wrong password");
                    exit(); 
                }
            } else {
                header("location: /?error=Invalid email or password");
                exit(); 
            }
        } else {
            header("location: /?error=Invalid cresidentials");
            exit(); 
        }
    }
?>