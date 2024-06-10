<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: /?error=Access denied. Please try again later");
    exit();
}

function random_str(
    $length,
    $keyspace = '0123456789'
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

$name = $_POST["name"];
$unfiltered_id = strtolower($name);
$id = str_replace(" ", "", $unfiltered_id);
$email = $_POST["email"];
$pass = $_POST["pass"];
$p_img = "none";
$status = 0;

include ("_dbconnect.php");

//check if name is in use
$sql = "SELECT * FROM `users` WHERE `name` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num != 0) {
    $id = $id . random_str(3);
}

if ($name == "" || $email == "" || $pass == "") {
    header("location: /?error=Invalid cresidentials.");
    exit();
} 

//check if name in use
$sql = "SELECT * FROM `users` WHERE `email` = '$email'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if ($num != 0) {
    header("location: /?error=Email already in use");
    exit();
}

$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$pass = htmlspecialchars($pass, ENT_QUOTES, 'UTF-8');
$pass_hash = password_hash($pass, PASSWORD_DEFAULT);
$sql = "INSERT INTO `users` (`id`, `name`, `email`, `pass`, `img`, `status`) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssssi", $id, $name, $email, $pass_hash, $p_img, $status);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    $sql = "INSERT INTO `verify` (`id`) VALUES (?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    header("location: /?alert=You have been signed up");
    exit();
} else {
    header("location: /?error=Error occured. Please try again later");
    exit();
}