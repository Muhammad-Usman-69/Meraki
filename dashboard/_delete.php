<?php
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

include ("../partials/_dbconnect.php");

$id = $_GET["id"];
$taskid = $_GET["task"];
$commentid = $_GET["comment"];

$previous_link = $_SERVER['HTTP_REFERER'];

//will work if coming from tasks not comments
if (str_contains($previous_link, "tasks")) {
    $sql = "DELETE FROM `tasks` WHERE `id` = ? AND `task_id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $id, $taskid);
    mysqli_stmt_execute($stmt);
}

//also deleting comment
$sql = "DELETE FROM `comments` WHERE `comment_id` = ? AND `task_id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "si", $commentid, $taskid);
mysqli_stmt_execute($stmt);

if (str_contains($previous_link, "comments")) {
    header("location: /tasks?id=$id&alert=Deleted Successfully");
    exit();
}

if (str_contains($previous_link, "tasks?id")) {
    header("location: /tasks?alert=Deleted Successfully&id=$id");
    exit();
}

//reedirecting
header("location: /tasks?alert=Deleted Successfully");
exit();

