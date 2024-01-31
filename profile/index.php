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

    <!-- alert -->
    <div class="alert transition-all duration-200 opacity-0">
        
    </div>

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
        
        //taking alert container
        let alert = document.querySelector(".alert");

        function copy(word) {

            //copying word
            let result = navigator.clipboard.writeText(word);


            if (result) {
                alert.classList.add("opacity-100");
                
                //showing if copied
                alert.innerHTML +=
                    `<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded w-56 flex items-center justify-between fixed bottom-5 right-5 transition-all duration-200" role="alert">
                        <strong class="font-bold text-sm">Copied Successfully!</strong>
                        <span onclick="hideAlert(this);">
                            <svg class="fill-current h-6 w-6 text-green-600 border-2 border-green-700 rounded-full" role="button" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>`;
            }
        }

        function hideAlert(element) {

            //hiding alert
            element.parentNode.classList.add("opacity-0");

            //hiding alert container
            alert.classList.remove("opacity-100");

            //removing alert
            setTimeout(() => {
                element.parentNode.remove();
            }, 200);
        }
    </script>
</body>

</html>