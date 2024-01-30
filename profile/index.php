<?php
include("../partials/_dbconnect.php");
session_start();
if ($_SESSION["log"] != true) {
    header("location:/?error=Please log in");
}

$id = $_SESSION["id"];
$sql = "SELECT * FROM `users` WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$name = $row["name"];
$email = $row["email"];

?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Muhammad Usman">
    <title>Meraki - To Do List</title>
    <link rel="stylesheet" href="../side/style.css">
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon">
</head>

<body class="flex flex-col min-h-screen hide-scrollbar bg-gray-800">
    <!--header-->
    <header class="h-20">
        <nav class="flex z-10 fixed shadow-sm shadow-black w-full justify-between items-center bg-gray-700">

            <!--navigation bar logo-->
            <div class="logo flex items-center">
                <a href="/" class="flex items-center space-x-2">
                    <img class="w-20 rounded-full p-2" src="../images/logo.jpg">
                    <p class="text-lg font-semibold font-mono text-white">Meraki</p>
                </a>
            </div>


            <!--menu section-->
            <div class="mx-6">
                <button onclick="menu()" type="button" class="border-2 rounded border-white relative w-9 h-9">
                    <img class="menu-img w-8 invert transition-all duration-300 absolute top-0 left-0"
                        src="../images/menu.png">
                    <img class="close-img w-8 invert opacity-0 transition-all duration-300 absolute top-0 left-0"
                        src="../images/close.png">
                </button>
                <ul
                    class="menu absolute flex flex-col list-none w-full right-1/2 translate-x-1/2 translate-y-[22px] ease-in-out overflow-hidden duration-200 transition-all">
                    <li class="list-none overflow-hidden transition-all duration-300 ease-in-out h-0 border-b-gray-600">
                        <button data-modal-target="logout-modal" data-modal-toggle="logout-modal" type="button"
                            class="block w-full py-1.5 px-3 text-gray-300 bg-gray-900 hover:bg-gray-800 overflow-hidden whitespace-nowrap text-left">Log
                            out</button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php include("../partials/_lo-modal.php") ?>

    <div class="profile py-14 grid">
        <div class="profile-pic rounded-full flex justify-center">
            <img src="../images/user.png" alt="profile" class="w-64">
        </div>

        <hr class="my-12 mx-8">

        <ul class="info px-8 space-y-4">
            <li class="grid grid-cols-1">
                <h4 class="font-semibold text-sm text-gray-400">Name:</h4>
                <p class="text-lg text-white flex justify-between items-center">
                    <span class="break-all name">
                        <?php echo $name; ?>
                    </span>
                    <button onclick="copy(document.querySelector('.name').innerHTML)">
                        <img src="../images/copy-files.png" alt="" class="w-6 invert">
                    </button>
                </p>
            </li>
            <li class="grid grid-cols-1">
                <h4 class="font-semibold text-sm text-gray-400">Email:</h4>
                <p class="text-lg text-white flex justify-between items-center space-x-4">
                    <span class="break-all email">
                        <?php echo $email; ?>
                    </span>
                    <button onclick="copy(document.querySelector('.email').innerHTML)">
                        <img src="../images/copy-files.png" alt="" class="w-6 invert">
                    </button>
                </p>
            </li>
        </ul>
    </div>

    <footer class="text-center bg-gray-800 text-white mt-auto">
        <hr>
        <p class="py-4">Copyright &copy; 2024 Meraki | All rights reserved </p>
    </footer>
    <script src="../side/script.js"></script>
    <script src="../side/flowbite.js"></script>
    <script>

        //copying word
        function copy(word) {
            let result = navigator.clipboard.writeText(word);
            
            //showing if copied
            if (result) {
                console.log(4);
            }
        }
    </script>
</body>

</html>