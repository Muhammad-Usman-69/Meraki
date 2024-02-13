<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    include("_dbconnect.php");
    //check if user is logged in
    if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
        //check if word id is even avaiable
        $id = $_GET["id"];
        $sql = "SELECT * FROM `work` WHERE `work_id` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $num = mysqli_num_rows($result);

        //check if input is emplty
        $title = $_POST["work-edit-title-$id"];
        $desc = $_POST["work-edit-desc-$id"];
        $time = $_POST["work-edit-time-$id"];

        $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $desc = htmlspecialchars($desc, ENT_QUOTES, 'UTF-8');
        $time = htmlspecialchars($time, ENT_QUOTES, 'UTF-8');

        if ($num != 0 && $title != "" && $desc != "" && $time != "") {
            echo "Please wait...";
            $sql = "UPDATE `work` SET `work_title` = ?, `work_desc` = ?, `work_time` = ? WHERE `work_id` = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssi", $title, $desc, $time, $id);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                header("location: /?alert=Updated successfully");
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
} else {
    header("location: /?error=Access denied");
    exit();
}