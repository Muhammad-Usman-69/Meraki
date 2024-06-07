<?php
session_start();
//checking if logged
if (!isset($_SESSION["log"]) && $_SESSION["log"] != true) {
    header("location:/?error=Not logged in");
    exit();
}

//check if admin
if ($_SESSION["admin"] == false) {
    header("location:/?error=Access Denied");
    exit();
}

include ("../partials/_dbconnect.php");

//taking user id
if (!isset($_GET["id"]) || !isset($_GET["status"])) {
    header("location: ../dashboard.php?product=1&error=Not Defined");
    exit();
}

$id = $_GET["id"];
$status = $_GET["status"];

//check if admin is doing it himself
if ($id == $_SESSION["id"] || $status == 2) {
    header("location: ../dashboard.php?user=1&error=Can't Change");
    exit();
}

//verify if product exist
$sql = "SELECT * FROM `users` WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num == 0) {
    header("location: /dashboard.php?error=User Not Found");
    exit();
}

//deleting
$sql = "UPDATE `users` SET `active` = ? WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $status, $id);
$bool = mysqli_stmt_execute($stmt);
if ($bool) {
    //reedirecting for normal
    header("location: ../dashboard.php?alert=Changed Successfully");
    exit();
}