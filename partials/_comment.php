<?php

session_start();
if (!isset($_SESSION["log"]) || $_SESSION["log"] != true) {
    header("location: /?error=Not Logged In");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: /?error=Invalid cresidentials");
    exit();
}

if (!isset($_POST["comment"]) || !isset($_POST["id"])) {
    header("location: /?error=Invalid cresidentials");
    exit();
}

//str for order id
function random_str(
    $length,
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
) {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    if ($max < 1) {
        throw new Exception('$keyspace must be at least two characters long');
    }
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

$comment_id = random_str(5);

//taking diff values//time
date_default_timezone_set("Asia/Karachi");
$time = date("Y-m-d") . "T" . date("h:i");
$user_id = $_SESSION["id"];
$user_name = $_SESSION["name"];
$task_id = $_POST["id"];
$comment = $_POST["comment"];

include ("_dbconnect.php");

//check if work exist
$sql = "SELECT * FROM `tasks` WHERE `task_id` = ? AND `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $task_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);

print_r($time);

//unknown user checking
if ($num == 0) {
    echo "Work Not Found";
    exit();
}

$sql = "INSERT INTO `comments` (`comment_id`, `task_id`, `user_id`, `user_name`, `time`, `comment`) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sissss", $comment_id, $task_id, $user_id, $user_name, $time, $comment);
mysqli_stmt_execute($stmt);
header("location:/?alert=Commented Successfully");
exit();
