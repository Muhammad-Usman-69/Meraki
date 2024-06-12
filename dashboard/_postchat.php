<?php
//check if post
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location:/?error=Access Denied");
    exit();
}

session_start();
//checking if logged
if (!isset($_SESSION["log"]) && $_SESSION["log"] != true) {
    header("location:/?error=Not logged in");
    exit();
}
//check if admin
if ($_SESSION["admin"] != true) {
    header("location:/?error=Access Denied");
    exit();
}

include("../partials/_dbconnect.php");

//getting date
date_default_timezone_set("Asia/Karachi");
$date = date("F d") . " at " . date("g:i a");
$message = $_POST["message"];
$user_id = $_POST["userid"];
$user_name = $_POST["username"];

if ($message == "" || $user_id == "" || $user_name == "") {
    exit();
}


//inserting to db
$sql = "INSERT INTO `chats` (`message`, `user_id`, `user_name`, `time`) VALUES (?,?,?,?);";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $message, $user_id, $user_name, $date);
mysqli_stmt_execute($stmt);