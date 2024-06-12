<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: /?error=Access denied");
    exit();
}

session_start();
include ("_dbconnect.php");

//check if user is logged in
if (!isset($_SESSION["log"]) || $_SESSION["log"] != true) {
    header("location: /?error=You are not logged in. <button type='button' data-modal-target='log-modal' data-modal-toggle='log-modal' class='underline hover:no-underline'>Log in</button>");
    exit();
}

//creating link
$previous_link = $_SERVER['HTTP_REFERER'];
//redirecting according to where data came from
if (str_contains($previous_link, "tasks")) {
    $header = "tasks";
} else {
    $header = "";
}

//check if task id is even avaiable
$taskid = $_GET["id"];
$sql = "SELECT * FROM `tasks` WHERE `task_id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $taskid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);

//check if input is emplty
$title = $_POST["task-edit-title-$taskid"];
$desc = $_POST["task-edit-desc-$taskid"];
$time = $_POST["task-edit-time-$taskid"];

$title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
$desc = htmlspecialchars($desc, ENT_QUOTES, 'UTF-8');
$time = htmlspecialchars($time, ENT_QUOTES, 'UTF-8');

if ($num == 0 || $title == "" || $desc == "" || $time == "") {
    //if coming from specific
    if (str_contains($_SERVER["HTTP_REFERER"], "tasks?id")) {
        header("location: /tasks?id={$_POST["task-user-id-$taskid"]}&error=Invalid cresidentials");
        exit();
    }

    header("location: /$header?error=Invalid cresidentials");
    exit();
}

echo "Please wait...";
$sql = "UPDATE `tasks` SET `task_title` = ?, `task_desc` = ?, `task_time` = ? WHERE `task_id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $title, $desc, $time, $taskid);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    //if coming from specific
    if (str_contains($_SERVER["HTTP_REFERER"], "tasks?id")) {
        header("location: /tasks?id={$_POST["task-user-id-$taskid"]}&alert=Updated Successfully");
        exit();
    }

    header("location: /$header?alert=Updated successfully");
    exit();
} else {
    header("location: /$header?error=Error occured. Please try again later.");
    exit();
}