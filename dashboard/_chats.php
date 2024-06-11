<?php
include ("../partials/_dbconnect.php");

if ($conn == false) {
    exit();
}

//initiating array
$arr = array();

//moving through each table
$sql = "SELECT * FROM `chats`";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
while ($row = mysqli_fetch_assoc($result)) {
    //removing first element
    // array_shift($row);
    //pushing row to sections
    array_push($arr, $row);
}

header("Content-Type:JSON");
echo json_encode($arr, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);