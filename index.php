<?php 
include("partials/_dbconnect.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Muhammad Usman">
    <title>Meraki - To Do List</title>
    <link rel="stylesheet" href="side/style.css">
    <link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">
</head>

<body class="flex flex-col min-h-screen">
    <?php
    if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
        include("partials/_lo-modal.php");
    } else {
        include("partials/_s-modal.php");
        include("partials/_l-modal.php");
    }
    ?>
    <header class="h-20">
        <nav class="flex z-10 fixed shadow-sm shadow-black w-full justify-between items-center bg-gray-700">
            <!--navigation bar logo-->
            <div class="logo flex items-center">
                <a href="/" class="flex items-center space-x-2">
                    <img class="w-20 rounded-full p-2" src="images/logo.jpg">
                    <p class="text-lg font-semibold font-mono text-white">Meraki</p>
                </a>
            </div>

            <!--menu section-->
            <div class="mx-6">
                <button onclick="menu()" type="button" class="border-2 rounded border-white relative w-9 h-9">
                    <img class="menu-img w-8 invert transition-all duration-300 absolute top-0 left-0"
                        src="images/menu.png">
                    <img class="close-img w-8 invert opacity-0 transition-all duration-300 absolute top-0 left-0"
                        src="images/close.png">
                </button>
                <ul
                    class="menu absolute flex flex-col list-none w-full right-1/2 translate-x-1/2 translate-y-[22px] ease-in-out overflow-hidden duration-200 transition-all">
                    <?php
                    if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
                        echo '<li class="list-none overflow-hidden transition-all duration-300 ease-in-out h-0 border-b-gray-600">
                        <a href=""
                            class="block w-full py-1.5 px-3 bg-gray-900 border-gray-600  hover:bg-gray-800 text-gray-300 overflow-hidden whitespace-nowrap">Profile</a>
                        </li>
                        <li class="list-none overflow-hidden transition-all duration-300 ease-in-out h-0 border-b-gray-600">
                            <button data-modal-target="logout-modal" data-modal-toggle="logout-modal" type="button"
                                class="block w-full py-1.5 px-3 text-gray-300 bg-gray-900 hover:bg-gray-800 overflow-hidden whitespace-nowrap text-left">Log out</button>
                        </li>';
                    } else {
                        echo '<li class="list-none overflow-hidden transition-all duration-300 ease-in-ou h-0 border-b-gray-600">
                        <button data-modal-target="log-modal" data-modal-toggle="log-modal"
                            class="block w-full py-1.5 px-3 text-gray-300 bg-gray-900  border-gray-600 hover:bg-gray-800 overflow-hidden whitespace-nowrap text-left">Log
                            in</button>
                        </li>
                        <li class="list-none overflow-hidden transition-all duration-300 ease-in-out h-0 border-b-gray-600">
                            <button data-modal-target="sign-modal" data-modal-toggle="sign-modal" type="button"
                                class="block w-full py-1.5 px-3 text-gray-300 bg-gray-900 hover:bg-gray-800 overflow-hidden whitespace-nowrap text-left">Sign
                                up</button>
                        </li>';
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>

    <!--form add section-->
    <iframe scrolling="no" class="w-full bg-gray-800 overflow-hidden" src="partials/_add.html" frameborder="0"
        id="_add"></iframe>
    <hr>

    <!--table section-->
    <iframe scrolling="no" class="w-full overflow-hidden" src="partials/_table.html" frameborder="0"
        id="_table"></iframe>
    <hr>

    <footer class="py-4 text-center bg-gray-800 text-white mt-auto">
        <p>Copyright &copy; 2024 Meraki | All rights reserved</p>
    </footer>

    <script src="side/script.js"></script>
    <script src="side/flowbite.js"></script>
</body>

</html>