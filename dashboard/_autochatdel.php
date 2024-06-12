<?php
//cron-jobs

//setting days
$days = 15;

//getting today date
$today = date("Y-m-d");

//modifying it
$date = date("Y-m-d", strtotime($today . " - $days days"));

//deleting
include ("../partials/_dbconnect.php");
$sql = "DELETE FROM `chats` WHERE `date` < ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $date);
mysqli_stmt_execute($stmt);
echo "deleted successfully";