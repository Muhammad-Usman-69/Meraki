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

<body class="flex flex-col min-h-screen hide-scrollbar bg-gray-800">
    <!--header-->
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

    <!--modal-->
    <?php
    if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
        include("partials/_lo-modal.php");
    } else {
        include("partials/_s-modal.php");
        include("partials/_l-modal.php");
    }
    ?>

    <!--alert and error-->
    <?php
    if (isset($_GET["alert"]) && $_GET["alert"] != "") {
        $alert = $_GET["alert"];
        echo '<div id="alert-border-3"
                    class="flex items-center p-4 text-green-800 border-y-4 border-green-300 bg-green-50"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <div class="ms-3 text-sm font-medium">Success! ' . $alert . '.</div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                        data-dismiss-target="#alert-border-3" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>';
    } else if (isset($_GET["error"]) && $_GET["error"] != "") {
        $error = $_GET["error"];
        echo '<div id="alert-border-2"
                class="flex items-center p-4 text-red-800 border-y-4 border-red-300 bg-red-50"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ms-3 text-sm font-medium">Error! ' . $error . '. </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                    data-dismiss-target="#alert-border-2" aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>';
    }
    ?>

    <!-- form section -->
    <div class="bg-gray-800 sm:flex sm:justify-center">
        <div class="overflow-hidden w-full sm:w-2/3 md:w-3/5 lg:w-1/2 xl:w-2/5">
            <form action="partials/_add-handler.php" class="p-6 space-y-3" method="post">
                <div class="flex flex-col space-y-3">
                    <label for="title" class="text-gray-200">Title</label>
                    <input type="text" name="title" id="title" placeholder="Shadi krni ha"
                        class="border border-black outline-none px-3 py-2 rounded text-white bg-gray-700 placeholder:text-gray-500" required>
                </div>
                <div class="flex flex-col space-y-3">
                    <label for="desc" class="text-gray-200">Description</label>
                    <textarea name="desc" id="desc" rows="6"
                        placeholder="Sail ko aik adad shadi krni ha take apni zindagi sukhi guzare"
                        class="border border-black outline-none px-3 py-2 rounded resize-none  text-white bg-gray-700 placeholder:text-gray-500" required></textarea>
                </div>
                <div class="flex flex-col space-y-3">
                    <label for="time" class="text-gray-200">Time</label>
                    <input type="datetime-local" name="time" id="time" placeholder="10:10:2010"
                        class="border border-black outline-none px-3 py-2 rounded text-gray-500 bg-gray-700 w-full calender" required>
                </div>
                <div class="grid place-items-end pt-3">
                    <button type="submit"
                        class="bg-blue-600 select-none hover:bg-blue-700 px-4 py-2 text-white">Add</button>
                </div>
            </form>
        </div>
    </div>

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