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
    <div class="alert transition-all duration-200 opacity-0"></div>

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

    <div class="profile py-14 grid place-items-center md:grid-cols-[1fr_2px_1fr]">
        <div class="profile-pic rounded-full flex justify-center relative group">
            <img src="../images/user.png" alt="profile" class="w-64">
            <img src="../images/upload-image.png" alt="profile" class="absolute w-64 opacity-0 h-full z-10 p-16 rounded-full transition-all duration-300 group-hover:bg-gray-100 group-hover:opacity-100">
            <form action="../partials/_upload-img.php" method="post" class="absolute z-20  opacity-0 w-64 h-full">
                <input type="file" accept="image/*" oninput="this.parentNode.submit();" class="h-full w-64 cursor-pointer" />
            </form>    
        </div>

        <div class="my-12 w-[calc(100%-64px)] h-0.5 bg-white md:h-full md:w-0.5"></div>

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
            <li class="grid grid-cols-1">
                <h4 class="font-semibold text-sm text-gray-400">User ID:</h4>
                <p class="text-lg text-white flex justify-between items-center space-x-4">
                    <span class="break-all id">
                        <?php echo '#' . $id; ?>
                    </span>
                    <button onclick="copy(document.querySelector('.id').innerHTML)">
                        <img src="../images/copy-files.png" alt="" class="w-6 invert">
                    </button>
                </p>
            </li>
        </ul>
    </div>

    <hr>


    <!-- search and select -->
    <div
        class="bg-gray-800 py-4 px-4 grid grid-cols-2 gap-4 grid-rows-[1fr_auto] md:grid-cols-[60px_1fr_200px] md:grid-rows-1 md:justify-between lg:grid-cols-[60px_1fr_300px] xl:grid-cols-[60px_1fr_500px]">
        <select name="num" id="num" class="text-white bg-gray-700 px-1.5 py-1.5 outline-none" oninput="pagination()">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
        </select>

        <p class="col-span-2 row-start-2 text-gray-300 text-center md:col-span-1 md:col-start-2 md:row-start-1 md:py-2">
            Showing <span class="show font-semibold"></span> out of <span class="total font-semibold"></span> entries
        </p>

        <input type="search" name="q" id="q" class="w-full text-white bg-gray-700 px-3 py-1.5 outline-none search"
            placeholder="Search" maxlength="50" oninput="pagination();">
    </div>

    <!-- status of list -->
    <div class="flex justify-center border-b border-gray-500">
        <button class="bg-gray-700 p-2 rounded-tl-md status-button text-gray-300 hover:bg-gray-600 active" id="0"
            onclick="active(this.id)">
            <img class="w-6 invert" src="../images/menu.png" alt="all">
        </button>
        <button class="bg-gray-700 p-2 status-button border-x border-gray-500 hover:bg-gray-600" id="1"
            onclick="active(this.id)">
            <img class="w-6 invert" src="../images/hourglass.png" alt="progress">
        </button>
        <button class="bg-gray-700 p-2 status-button border-r border-gray-500 hover:bg-gray-600" id="2"
            onclick="active(this.id)">
            <img class="w-6 invert" src="../images/finish.png" alt="finished">
        </button>
        <button class="bg-gray-700 p-2 rounded-tr-md status-button hover:bg-gray-600" id="3" onclick="active(this.id)">
            <img class="w-6 invert" src="../images/delete.png" alt="closed">
        </button>
    </div>

    <!-- table -->
    <table class="w-full">
        <thead class="uppercase text-xs bg-gray-700 text-gray-400 text-left">
            <tr>
                <th scope="col" class="px-4 py-3 sm:px-7">Id</th>
                <th scope="col" class="px-4 py-3">Time</th>
                <th scope="col" class="px-4 py-3">Function</th>
                <th scope="col" class="px-4 py-3">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-center bg-gray-800 text-gray-300 border-b border-gray-700 hidden no-result">
                <td class="py-4" colspan="4">No Results Found</td>
            </tr>
            <?php
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
                    $status = $row["work_status"];
                    $work_id = $row["work_id"];
                    $time = $row["work_time"];
                    echo '<tr class="bg-gray-800 border-gray-700 text-white border-b hidden tr" id="#' . $work_id . '">
                    <td class="px-4 py-4 sm:px-6">#' . $work_id . '</td>
                    <td class="px-4 py-4">
                        <input type="datetime-local" class="bg-gray-800 outline-none datetime hidden" value="' . $time . '">
                        <input type="date" class="bg-gray-800 outline-none w-[87px] hide-cal date hide" readonly>
                        <input type="time" class="bg-gray-800 outline-none w-[87px] hide-cal time" readonly>
                    </td>';

                    //checking status
                    if ($status != "progress") {
                        echo '<td class="py-4 grid sm:flex">
                            <div class="w-fit">
                                <button data-modal-target="detail-modal-' . $i . '" data-modal-toggle="detail-modal-' . $i . '"
                                    class="rounded-md bg-blue-500 hover:bg-blue-600 p-2">
                                    <img class="invert w-6" src="../images/detail.png" alt="detail">
                                </button>
                                <button data-modal-target="restore-modal-' . $i . '" data-modal-toggle="restore-modal-' . $i . '" class="rounded-md bg-gray-500 hover:bg-gray-600 p-2">
                                    <img class="w-6 invert" src="../images/restore.png" alt="edit">
                                </button>
                            </div>
                        </td>
                        ';

                        echo '<div id="restore-modal-' . $i . '" data-modal-backdrop="static" tabindex="-1"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative rounded-lg shadow bg-gray-700 border border-white">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                                        data-modal-hide="restore-modal-' . $i . '">
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
                                        <h3 class="mb-5 text-lg font-normal text-gray-400">Are you sure you want to restore this?
                                        </h3>
                                        <button onclick="window.open(`../partials/_mark.php?id=' . $work_id . '&status=progress`, `_self`)" data-modal-hide="restore-modal-' . $i . '" type="button"
                                            class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-700 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 me-2">
                                            Yes, I&#39;m sure
                                        </button>
                                        <button data-modal-hide="restore-modal-' . $i . '" type="button"
                                            class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">No,
                                            cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    } else {
                        echo '<td class="py-4 grid grid-cols-1 gap-1 sm:flex">
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
                        </td>';

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
                                    <form action="../partials/_update.php?id=' . $work_id . '" method="post">
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
                                                    class="border text-sm rounded-lg  focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white" maxlength="50">
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
                                        <button onclick="window.open(`../partials/_mark.php?id=' . $work_id . '&status=finished`, `_self`)" data-modal-hide="finish-modal-' . $i . '" type="button"
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
                                        <h3 class="mb-5 text-lg font-normal text-gray-400">Are you sure you want to mark this as closed?
                                        </h3>
                                        <button onclick="window.open(`../partials/_mark.php?id=' . $work_id . '&status=closed`, `_self`)" data-modal-hide="finish-modal-' . $i . '" type="button"
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
                    }

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
                                                class="border text-sm rounded-lg  focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
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

                    echo '<td class="px-3 py-4 capitalize status">' . $status . '</td>
                    </tr>';
                    $i++;
                }
            }
            ?>

        </tbody>
    </table>


    <div class="mt-auto">
        <!-- pagination -->
        <nav class="bg-gray-800 py-5 px-4 text-gray-400 page-nav-container hidden">
            <div class="flex items-center justify-center space-x-[1px] pages-container">
            </div>
        </nav>

        <footer class="text-center bg-gray-800 text-white">
            <hr>
            <p class="py-4">Copyright &copy; 2024 Meraki | All rights reserved </p>
        </footer>
    </div>

    <script src="profile.js"></script>
    <script src="../side/flowbite.js"></script>
</body>

</html>