<?php
session_start();
//check if post
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location:/?error=Access Denied");
    exit();
}

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

include ("../partials/_dbconnect.php");

$title = $_POST["title"];
$desc = $_POST["desc"];
$time = $_POST["time"];
$users = $_POST["users"];

// check if empty
if ($title == "" || $desc == "" || $time == "" || count($users) == 0) {
    header("location: tasks?error=Invalid cresidentials");
    exit();
}

//inserting after looping through users
foreach ($users as $user) {
    $sql = "INSERT INTO `tasks` (`id`, `task_title`, `task_desc`, `task_time`) VALUES (?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $user, $title, $desc, $time);
    mysqli_stmt_execute($stmt);
}

//reedirecting
header("location: /tasks?alert=Assigned Successfully");
exit();