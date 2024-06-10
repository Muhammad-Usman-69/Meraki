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


//getting date
date_default_timezone_set("Asia/Karachi");
$date = date("F d") . " at " . date("g:i a");