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

//taking id
if (!isset($_GET["id"]) || !isset($_GET["task"])) {
    header("location: ../tasks?error=Not Defined");
    exit();
}

$id = $_GET["id"];
$taskid = $_GET["task"];

//updating
$sql = "DELETE FROM `tasks` WHERE `id` = ? AND `task_id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "si", $id, $taskid);
$bool = mysqli_stmt_execute($stmt);
if ($bool) {
    //reedirecting for normal
    header("location: ../tasks?alert=Deleted Successfully");
    exit();
}