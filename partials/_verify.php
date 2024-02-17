<?php

if (!isset($_GET["id"]) && !isset($_GET["code"])) {
    echo "Access Denied";
    exit();
}

$id = $_GET["id"];
$code = $_GET["code"];

include("_dbconnect.php");

//check if user exist
$sql = "SELECT * FROM `users` WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);

//unknown user checking
if ($num == 0) {
    echo "Access Denied";
    exit();
}

//verifying
$sql = "SELECT * FROM `verify` WHERE `id` = ? AND `verification_code` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "is", $id, $code);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);

//unknown code
if ($num == 0) {
    echo 'Unknown Verification Code';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Muhammad Usman">
    <title>Meraki - Email Verification</title>
    <link rel="stylesheet" href="../side/style.css">
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon">
</head>

<body>
    <div class="h-screen w-full flex flex-col justify-center items-center bg-gray-800 space-y-8">

        <img src="../images/spinner.png" alt="" class="w-32 h-32 invert animate-spin spin-slow">

        <ul class="space-y-3">
            <!-- request container -->
            <li class="grid grid-cols-[32px_1fr] space-x-3">
                <div class="bg-green-500 p-1 rounded-sm">
                    <img src="../images/finish.png" alt="" class="w-6 h-6 invert">
                </div>
                <p class="text-gray-300 text-lg">Request Recieved</p>
            </li>

            <!-- progress container -->
            <li class="progress grid grid-cols-[32px_1fr] space-x-3">
                <div class="bg-orange-500 p-1 rounded-sm">
                    <img src="../images/spinner.png" alt="" class="w-6 h-6 animate-spin invert">
                </div>
                <p class="text-gray-300 text-lg">Verification in Progress...</p>
            </li>

            <!-- Verification Successful -->
            <li class="success transition-all duration-1000 grid grid-cols-[32px_1fr] space-x-3 opacity-0">
                <div class="bg-green-500 p-1 rounded-sm">
                    <img src="../images/finish.png" alt="" class="w-6 h-6 invert">
                </div>
                <p class="text-gray-300 text-lg">Verification Successful</p>
            </li>

        </ul>
    </div>
    <?php


    $status = 1;
    $sql = "UPDATE `users` SET `status` = ? WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $status, $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result) {
        echo '';
    }

    ?>
    <script>
        setTimeout(() => {
            document.querySelector(".success").classList.add("opacity-100");
        }, 500);
    </script>
</body>

</html>