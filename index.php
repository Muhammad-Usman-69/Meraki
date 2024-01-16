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
                        class="border border-black outline-none px-3 py-2 rounded text-white bg-gray-700 placeholder:text-gray-500"
                        required>
                </div>
                <div class="flex flex-col space-y-3">
                    <label for="desc" class="text-gray-200">Description</label>
                    <textarea name="desc" id="desc" rows="6"
                        placeholder="Sail ko aik adad shadi krni ha take apni zindagi sukhi guzare"
                        class="border border-black outline-none px-3 py-2 rounded resize-none  text-white bg-gray-700 placeholder:text-gray-500 hide-scrollbar"
                        required></textarea>
                </div>
                <div class="flex flex-col space-y-3">
                    <label for="time" class="text-gray-200">Time</label>
                    <input type="datetime-local" name="time" id="time" placeholder="10:10:2010"
                        class="border border-black outline-none px-3 py-2 rounded text-gray-500 bg-gray-700 w-full calender"
                        required>
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
    <!-- <iframe scrolling="no" class="w-full overflow-hidden" src="partials/_table.php" frameborder="0"
        id="_table"></iframe> -->
    <!--table section-->
    <div class="w-full overflow-hidden">

        <!-- search and select -->
        <form action="" class="bg-gray-800 py-4 px-4 grid grid-cols-2 gap-4">
            <select name="num" id="num" class="text-white bg-gray-700 px-1.5 py-1.5 outline-none">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
            <div class="search grid grid-cols-[1fr_40px] gap-[2px]">
                <input type="search" name="q" id="q" class="w-full text-white bg-gray-700 px-3 py-1.5 outline-none"
                    placeholder="Search">
                <button type="submit" class="bg-gray-700 hover:bg-gray-600">
                    <img src="../images/search.png" class="p-2 invert" alt="">
                </button>
            </div>
        </form>

        <!-- table -->
        <table class="w-full">
            <thead class="uppercase text-xs bg-gray-700 text-gray-400 text-left">
                <tr>
                    <th scope="col" class="px-2 py-3">Id</th>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Time</th>
                    <th scope="col" class="px-4 py-3 sm:min-w-48">Function</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
                    $id = $_SESSION["id"];
                    $sql = "SELECT * FROM `work` WHERE `id` = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $num = mysqli_num_rows($result);
                    if ($num != 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $title = $row["work_title"];
                            $desc = $row["work_desc"];
                            $time = $row["work_time"];
                            echo '<tr class="bg-gray-800 border-gray-700 text-white border-b">
                            <td class="px-6 py-4">' . $i . '</td>
                            <!--max 150-->
                            <td class="py-4">' . $title . '</td>
                            <td class="px-3 py-4">
                                <input type="datetime-local" class="bg-gray-800 outline-none datetime hidden" value="' . $time . '">
                                <input type="date" class="bg-gray-800 outline-none w-24 hide-cal date" readonly>
                                <input type="time" class="bg-gray-800 outline-none w-24 hide-cal time" readonly>
                            </td>
                            <td class="py-4 grid grid-cols-1 gap-1 sm:flex">
                                <div class="w-fit">
                                    <button data-modal-target="detail-modal-' . $i . '" data-modal-toggle="detail-modal-' . $i . '" class="rounded-md bg-blue-500 hover:bg-blue-600 p-2">
                                        <img class="invert w-6" src="../images/detail.png" alt="detail">
                                    </button>
                                    <button href="" class="rounded-md bg-yellow-500 hover:bg-yellow-600 p-2">
                                        <img class="invert w-6" src="../images/edit.png" alt="edit">
                                    </button>
                                </div>
                                <div class="w-fit">
                                    <button href="" class="rounded-md bg-green-600 hover:bg-green-700 p-2">
                                        <img class="invert w-6" src="../images/finish.png" alt="finish">
                                    </button>
                                    <button href="" class="rounded-md bg-red-600 hover:bg-red-700 p-2">
                                        <img class="invert w-6" src="../images/delete.png" alt="delete">
                                    </button>
                                </div>
                            </td>
                        </tr>';

                            //echo detail modal
                        echo '<div id="detail-modal-' . $i . '" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                            class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative shadow bg-gray-700 border border-white rounded-md">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                                            <h3 class="text-xl font-semibold text-white">
                                                Review your work
                                            </h3>
                                            <button type="button"
                                                class="end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                                                data-modal-hide="detail-modal-' . $i . '">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-4 md:p-5">
                                            <div class="space-y-4">
                                                <div>
                                                    <label for="word-id" class="block mb-2 text-sm font-medium text-white">Your work id</label>
                                                    <input type="text" id="word-id" name="word-id" value="' . $i . '"
                                                        class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                                                        readonly>
                                                </div>
                                                <div>
                                                    <label for="word-title" class="block mb-2 text-sm font-medium text-white">Your work
                                                        title</label>
                                                    <input type="text" id="word-title" name="word-title" value="' . $title . '"
                                                        class="border text-sm rounded-lg  focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                                                        readonly>
                                                </div>
                                                <div>
                                                    <label for="word-desc" class="block mb-2 text-sm font-medium text-white">Your work desc</label>
                                                    <textarea id="word-desc" name="word-desc"
                                                        rows="5" class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white hide-scrollbar resize-none"
                                                        readonly>' . $desc . '</textarea>
                                                </div>
                                                <div>
                                                    <label for="work-time"
                                                        class="block mb-2 text-sm font-medium text-white">Your work time</label>
                                                    <input type="datetime-local" value="' . $time . '" minlength="8" id="work-time" name="work-time"
                                                        class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white hide-cal">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            $i++;
                        }
                    }
                }
                ?>

            </tbody>
        </table>

        <!-- pagination -->
        <nav class="bg-gray-800 py-5 px-4 text-gray-400">
            <ul class="flex flex-row items-center justify-center space-x-[1px]">
                <li>
                    <a href=""
                        class="bg-gray-700 px-4 py-3 rounded-l-md hover:bg-gray-600 hover:text-white">Previous</a>
                </li>
                <li>
                    <a href="" class="bg-gray-700 px-4 py-3 hover:bg-gray-600 hover:text-white">1</a>
                </li>
                <li>
                    <a href="" class="bg-gray-700 px-4 py-3 hover:bg-gray-600 hover:text-white">2</a>
                </li>
                <li>
                    <a href="" class="bg-gray-700 px-4 py-3 hover:bg-gray-600 hover:text-white">3</a>
                </li>
                <li>
                    <a href="" class="bg-gray-700 px-4 py-3 rounded-r-md hover:bg-gray-600 hover:text-white">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <hr>

    <footer class="py-4 text-center bg-gray-800 text-white mt-auto">
        <p>Copyright &copy; 2024 Meraki | All rights reserved</p>
    </footer>

    <script src="side/script.js"></script>
    <script src="side/flowbite.js"></script>
</body>

</html>