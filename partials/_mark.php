<?php
session_start();
//check if user is logged in
if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
    include("_dbconnect.php");
    //check if word id is even avaiable
    $id = $_GET["id"];
    $word_id = $_SESSION["id"];
    $sql = "SELECT * FROM `work` WHERE `work_id` = ? AND `id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id, $word_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num = mysqli_num_rows($result);

    //check if input is emplty
    $status = $_GET["status"];

    if ($num != 0 && $status != "") {
        echo "Please wait...";
        $sql = "UPDATE `work` SET `work_status` = ? WHERE `work_id` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            header("location: /?alert=Marked successfully");
            exit();
        } else {
            header("location: /?error=Error occured. Please try again later.");
            exit();
        }
    } else {
        header("location: /?error=Invalid cresidentials");
        exit();
    }
} else {
    header("location: /?error=You are not logged in. <button type='button' data-modal-target='log-modal' data-modal-toggle='log-modal' class='underline hover:no-underline'>Log in</button>");
    exit();
}