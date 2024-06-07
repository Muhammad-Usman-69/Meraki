<?php
//checkif post
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: /?error=Access Denied");
    exit();
}

//check if empty
$email = $_POST["l-email"];
$pass = $_POST["l-pass"];
if ($email == "" && $pass == "") {
    header("location: /?error=Invalid cresidentials");
    exit();
}

//check if user exist
include ("_dbconnect.php");
$sql = "SELECT * FROM `users` WHERE `email` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num == 0) {
    header("location: /?error=Invalid email or password");
    exit();
}
$row = mysqli_fetch_assoc($result);

$name = $row["name"];
$id = $row["id"];
$admin = $row["admin"];

//check if active or inactive
$sql = "SELECT * FROM `users` WHERE `id` = ? AND `active` = 0";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num == 1) {
    header("location: /?error=Your account is currently inactive");
    exit();
}

//verifying
if (password_verify($pass, $row["pass"])) {
    session_start();
    $_SESSION["log"] = true;
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    $_SESSION["id"] = $id;
    if ($admin == 1) {
        $_SESSION["admin"] = true;
    } else {
        $_SESSION["admin"] = false;
    }
    header("location: /?alert=You are logged in");
    exit();
} else {
    header("location: /?error=Wrong password");
    exit();
}