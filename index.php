<?php
include("partials/_dbconnect.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

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
            <form action="partials/_add.php" class="p-6 space-y-3" method="post">
                <div class="flex flex-col space-y-3">
                    <label for="title" class="text-gray-200">Title</label>
                    <input type="text" maxlength="50" name="title" id="title" placeholder="Shadi krni ha"
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
                        class="border border-black outline-none px-3 py-2 rounded text-white bg-gray-700 w-full calender"
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
    <div class="w-full overflow-hidden">

        <!-- search and select -->
        <div class="bg-gray-800 py-4 px-4 grid grid-cols-2 gap-4">
            <select name="num" id="num" class="text-white bg-gray-700 px-1.5 py-1.5 outline-none"
                oninput="pagination(this)">
                <option value="5" class="default">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>

            <input type="search" name="q" id="q" class="w-full text-white bg-gray-700 px-3 py-1.5 outline-none search"
                placeholder="Search" maxlength="50" oninput="search(this.value);">
        </div>

        <!-- table -->
        <table class="w-full">
            <thead class="uppercase text-xs bg-gray-700 text-gray-400 text-left">
                <tr>
                    <th scope="col" class="px-4 py-3">Num</th>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Time</th>
                    <th scope="col" class="px-4 py-3 sm:min-w-48">Function</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
                    $id = $_SESSION["id"];
                    $status = "progress";
                    $sql = "SELECT * FROM `work` WHERE `id` = ? AND `work_status` = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "is", $id, $status);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $num = mysqli_num_rows($result);
                    if ($num != 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $title = $row["work_title"];
                            $desc = $row["work_desc"];
                            $time = $row["work_time"];
                            $work_id = $row["work_id"];
                            echo '<tr class="bg-gray-800 border-gray-700 text-white border-b hidden tr" id="#' . $work_id . '">
                                <td class="px-6 py-4">' . $i . '</td>
                                <!--max 150-->
                                <td class="py-4 text-sm sm:text-base">' . $title . '</td>
                                <td class="px-3 py-4">
                                    <input type="datetime-local" class="bg-gray-800 outline-none datetime hidden" value="' . $time . '">
                                    <input type="date" class="bg-gray-800 outline-none w-[87px] hide-cal date" readonly>
                                    <input type="time" class="bg-gray-800 outline-none w-[87px] hide-cal time" readonly>
                                </td>
                                <td class="py-4 grid grid-cols-1 gap-1 sm:flex">
                                    <div class="w-fit">
                                        <button data-modal-target="detail-modal-' . $i . '" data-modal-toggle="detail-modal-' . $i . '" class="rounded-md bg-blue-500 hover:bg-blue-600 p-2">
                                            <img class="invert w-6" src="../images/detail.png" alt="detail">
                                        </button>
                                        <button data-modal-target="edit-modal-' . $i . '" data-modal-toggle="edit-modal-' . $i . '"  href="" class="rounded-md bg-yellow-500 hover:bg-yellow-600 p-2">
                                            <img class="invert w-6" src="../images/edit.png" alt="edit">
                                        </button>
                                    </div>
                                    <div class="w-fit">
                                        <button data-modal-target="finish-modal-' . $i . '" data-modal-toggle="finish-modal-' . $i . '" href="" class="rounded-md bg-green-600 hover:bg-green-700 p-2">
                                            <img class="invert w-6" src="../images/finish.png" alt="finish">
                                        </button>
                                        <button data-modal-target="delete-modal-' . $i . '" data-modal-toggle="delete-modal-' . $i . '" href="" class="rounded-md bg-red-600 hover:bg-red-700 p-2">
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
                                                    <label for="work-id-' . $work_id . '" class="block mb-2 text-sm font-medium text-white">Your Work Id</label>
                                                    <input type="text" id="work-id-' . $work_id . '" name="work-id-' . $work_id . '" value="#' . $work_id . '"
                                                        class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                                                        readonly>
                                                </div>
                                                <div>
                                                    <label for="work-title-' . $work_id . '" class="block mb-2 text-sm font-medium text-white">Your Work
                                                        Title</label>
                                                    <input type="text" id="work-title-' . $work_id . '" name="work-title-' . $work_id . '" value="' . $title . '"
                                                        class="border text-sm rounded-lg  focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white title"
                                                        readonly>
                                                </div>
                                                <div>
                                                    <label for="work-desc-' . $work_id . '" class="block mb-2 text-sm font-medium text-white">Your Work Description</label>
                                                    <textarea id="work-desc-' . $work_id . '" name="work-desc-' . $work_id . '"
                                                        rows="4" class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white hide-scrollbar resize-none description"
                                                        readonly>' . $desc . '</textarea>
                                                </div>
                                                <div>
                                                    <label for="work-time-' . $work_id . '"
                                                        class="block mb-2 text-sm font-medium text-white">Your Work Time</label>
                                                    <input type="datetime-local" value="' . $time . '" minlength="8" id="work-time-' . $work_id . '" name="work-time-' . $work_id . '"
                                                        class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white hide-cal" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';

                            //echo edit modal
                            echo '<div id="edit-modal-' . $i . '" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                            class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative shadow bg-gray-700 border border-white rounded-md">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                                            <h3 class="text-xl font-semibold text-white">
                                                Edit your work
                                            </h3>
                                            <button type="button"
                                                class="end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                                                data-modal-hide="edit-modal-' . $i . '">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <form action="partials/_update.php?id=' . $work_id . '" method="post">
                                        <div class="p-4 md:p-5 space-y-4">
                                                <div>
                                                    <label for="work-edit-id-' . $work_id . '" class="block mb-2 text-sm font-medium text-white">Your
                                                        Work Id</label>
                                                    <input type="text" id="work-edit-id-' . $work_id . '" name="work-edit-id-' . $work_id . '"
                                                        value="#' . $work_id . '"
                                                        class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                                                        readonly>
                                                </div>
                                                <div>
                                                    <label for="work-edit-title-' . $work_id . '" class="block mb-2 text-sm font-medium text-white">Your
                                                        Work Title</label>
                                                    <input type="text" id="work-edit-title-' . $work_id . '" name="work-edit-title-' . $work_id . '"
                                                        value="' . $title . '"
                                                        class="border text-sm rounded-lg  focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white">
                                                </div>
                                                <div>
                                                    <label for="work-edit-desc-' . $work_id . '" class="block mb-2 text-sm font-medium text-white">Your
                                                        Work Description</label>
                                                    <textarea id="work-edit-desc-' . $work_id . '" name="work-edit-desc-' . $work_id . '" rows="4"
                                                        class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white hide-scrollbar resize-none">' . $desc . '</textarea>
                                                </div>
                                                <div>
                                                    <label for="work-edit-time-' . $work_id . '" class="block mb-2 text-sm font-medium text-white">Your
                                                        Work Time</label>
                                                    <input type="datetime-local" value="' . $time . '" id="work-edit-time-' . $work_id . '"
                                                        name="work-edit-time-' . $work_id . '"
                                                        class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white calender">
                                                </div>
                                                <button type="submit"
                                                    class="w-full text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>';

                            //echo finish mark modal
                            echo '<div id="finish-modal-' . $i . '" data-modal-backdrop="static" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative rounded-lg shadow bg-gray-700 border border-white">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                                            data-modal-hide="finish-modal-' . $i . '">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 w-12 h-12 text-gray-200" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-400">Are you sure you want to mark this as finished?
                                            </h3>
                                            <button onclick="window.open(`partials/_mark.php?id=' . $work_id . '&status=finish`, `_self`)" data-modal-hide="finish-modal-' . $i . '" type="button"
                                                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-700 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 me-2">
                                                Yes, I&#39;m sure
                                            </button>
                                            <button data-modal-hide="finish-modal-' . $i . '" type="button"
                                                class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">No,
                                                cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';

                            //echo delete modal
                            echo '<div id="delete-modal-' . $i . '" data-modal-backdrop="static" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative rounded-lg shadow bg-gray-700 border border-white">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                                            data-modal-hide="delete-modal-' . $i . '">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 w-12 h-12 text-gray-200" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-400">Are you sure you want to mark this as deleted?
                                            </h3>
                                            <button onclick="window.open(`partials/_mark.php?id=' . $work_id . '&status=delete`, `_self`)" data-modal-hide="finish-modal-' . $i . '" type="button"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 me-2">
                                                Yes, I&#39;m sure
                                            </button>
                                            <button data-modal-hide="delete-modal-' . $i . '" type="button"
                                                class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">No,
                                                cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            $i++;
                        }
                    } else {
                        include("partials/_dummy-input.php");
                    }
                } else {
                    include("partials/_dummy-login.php");
                }
                ?>

            </tbody>
        </table>

        <!-- pagination -->
        <nav class="bg-gray-800 py-5 px-4 text-gray-400 page-container hidden">
            <div class="flex items-center justify-center space-x-[1px] pages">
            </div>
    </div>
    </nav>
    </div>
    <hr>

    <footer class="py-4 text-center bg-gray-800 text-white mt-auto">
        <p>Copyright &copy; 2024 Meraki | All rights reserved </p>
    </footer>

    <script src="side/script.js"></script>
    <script src="side/flowbite.js"></script>
</body>

</html>