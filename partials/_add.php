<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    include("_dbconnect.php");
    //check if user is logged in
    if (isset($_SESSION["log"]) == true) {
        //check if user account is even avaiable
        $id = $_SESSION["id"];
        $sql = "SELECT * FROM `users` WHERE `id` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $num = mysqli_num_rows($result);
        //check if input is emplty
        if ($num != 0 && $_POST["title"] != "" && $_POST["desc"] != "" && $_POST["time"] != "") {
            echo "Please wait...";
            $title = $_POST["title"];
            $desc = $_POST["desc"];
            $time = $_POST["time"];
            $status = "progress";
            $sql = "INSERT INTO `work` (`id`, `work_title`, `work_desc`, `work_time`, `work_status`) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "issss", $id, $title, $desc, $time, $status);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                header("location: /?alert=Added successfully");
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
        header("location: /?error=You are not logged in. <button type='button' data-modal-target='log-modal' data-modal-toggle='log-modal' class='underline hover:no-underline'>Log in</a>");
        exit();
    }
} else {
    header("location: /?error=Access denied");
    exit();
}