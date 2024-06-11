<?php
include ("partials/_dbconnect.php");
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
                        <a href="p"
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
                    if (isset($_SESSION["admin"]) && $_SESSION["admin"] == true) {
                        echo '<li class="list-none overflow-hidden transition-all duration-300 ease-in-out h-0 border-b-gray-600">
                            <a href="dashboard.php" class="block w-full py-1.5 px-3 text-gray-300 bg-gray-900  border-gray-600 hover:bg-gray-800 overflow-hidden whitespace-nowrap text-left">Dashboard</a>
                            </li>';
                    }
                    ?>
                </ul>
                </li>
            </div>
        </nav>
    </header>

    <!--modal-->
    <?php
    if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
        include ("partials/_lo-modal.php");
    } else {
        include ("partials/_s-modal.php");
        include ("partials/_l-modal.php");
    }
    ?>

    <!-- alert and error  -->
    <div class="alert transition-all duration-200">
        <?php
        if (isset($_GET["alert"])) {
            echo '<div class="bg-green-100 border border-green-400 hover:bg-green-50 text-green-700 px-4 py-3 rounded space-x-4 flex items-center justify-between fixed bottom-5 right-5 ml-5 transition-all duration-200 z-20"
        role="alert">
                <strong class="font-bold text-sm">' . $_GET["alert"] . '.</strong>
                <span onclick="hideAlert(this);">
                    <svg class="fill-current h-6 w-6 text-green-600 border-2 border-green-700 rounded-full" role="button"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>';
        } else if (isset($_GET["error"])) {
            echo '<div class="bg-red-100 border border-red-400 hover:bg-red-50 text-red-700 px-4 py-3 rounded space-x-4 flex items-center justify-between fixed bottom-5 right-5 ml-5 transition-all duration-200 z-20"
        role="alert">
                <strong class="font-bold text-sm">' . $_GET["error"] . '.</strong>
                <span onclick="hideAlert(this);">
                    <svg class="fill-current h-6 w-6 text-red-600 border-2 border-red-700 rounded-full" role="button"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>';
        }
        ?>
    </div>

    <!-- form section -->
    <div class="form-container bg-gray-800 sm:relative sm:min-h-24">
        <button type="button"
            class="p-2 m-6 ml-auto bg-white bg-opacity-20 rounded-full cursor-pointer grid place-content-center hover:bg-opacity-30 active:bg-opacity-25 sm:absolute sm:right-0"
            onclick="formHide()">
            <img src="images/pointer-up.png" class="p-0.5 w-6 h-6 transition-all duration-100 rotate-180" alt="">
        </button>

        <hr class="sm:hidden">

        <div class="sm:flex sm:justify-center overflow-hidden transition-all duration-300 h-[492px]">
            <div class="overflow-hidden w-full sm:w-2/3 md:w-3/5 lg:w-1/2 xl:w-2/5">
                <form action="partials/_add.php" class="p-6 space-y-3" method="post">
                    <div class="flex flex-col space-y-3">
                        <label for="title" class="text-gray-200">Title</label>
                        <input type="text" maxlength="50" name="title" id="title"
                            placeholder="Enter a descriptive title (e.g., Task Title)"
                            class="border border-black outline-none px-3 py-2 rounded text-white bg-gray-700 placeholder:text-gray-500"
                            required minlength="10">
                    </div>
                    <div class="flex flex-col space-y-3">
                        <label for="desc" class="text-gray-200">Description</label>
                        <textarea name="desc" id="desc" rows="6" placeholder="Enter a detailed description"
                            class="border border-black outline-none px-3 py-2 rounded resize-none  text-white bg-gray-700 placeholder:text-gray-500 hide-scrollbar"
                            required minlength="30" maxlength="300"></textarea>
                    </div>
                    <div class="flex flex-col space-y-3">
                        <label for="time" class="text-gray-200">Time</label>
                        <input type="datetime-local" name="time" id="time" value="2025-03-03 05:30:00"
                            class="border border-black outline-none px-3 py-2 rounded text-gray-500 bg-gray-700 w-full calender"
                            oninput="datetimeColor(this)" required>
                    </div>
                    <div class="grid place-items-end pt-3">
                        <button type="submit"
                            class="bg-blue-600 select-none hover:bg-blue-700 px-4 py-2 text-white">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <hr>

    <!--table section-->
    <div class="w-full overflow-hidden">

        <!-- search and select -->
        <div
            class="bg-gray-800 py-4 px-4 grid grid-cols-2 gap-4 grid-rows-[1fr_auto] md:grid-cols-[60px_1fr_200px] md:grid-rows-1 md:justify-between lg:grid-cols-[60px_1fr_300px] xl:grid-cols-[60px_1fr_500px]">
            <select name="num" id="num" class="text-white bg-gray-700 px-1.5 py-1.5 outline-none"
                oninput="pagination()">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>

            <p
                class="col-span-2 row-start-2 text-gray-300 text-center md:col-span-1 md:col-start-2 md:row-start-1 md:py-2">
                Showing <span class="show font-semibold"></span> out of <span class="total font-semibold"></span>
                entries</p>

            <input type="search" name="q" id="q" class="w-full text-white bg-gray-700 px-3 py-1.5 outline-none search"
                placeholder="Search" maxlength="50" oninput="pagination();">
        </div>

        <!-- table -->
        <table class="min-w-full">
            <thead class="uppercase text-xs bg-gray-700 text-gray-400 text-left">
                <tr>
                    <th scope="col" class="px-4 py-3 sm:px-8 text-center">Id</th>
                    <th scope="col" class="px-4 py-3 w-full">Title</th>
                    <th scope="col" class="px-6 py-3 sm:w-32 md:w-48 flex justify-between items-center">
                        <span>Time</span>
                        <div class="flex flex-col space-y-2">
                            <button type="button" onclick="window.location.assign('?o=asc')">
                                <img src="images/up-arrow.png" width="16" class="invert-[75%]" <?php if (isset($_GET['o']) && $_GET['o'] == 'asc') {
                                    echo 'style="filter: invert(100%)"';
                                } ?>
                                    alt="">
                            </button>
                            <button type="button" onclick="window.location.assign('?o=desc')">
                                <?php
                                if (isset($_GET['o']) && $_GET['o'] == 'desc') {
                                    echo '<img src="images/down-arrow.png" width="16" class="invert-[75%]" alt="" style="filter: invert(100%)">';
                                } else {
                                    echo '<img src="images/down-arrow.png" width="16" class="invert-[75%]" alt="">';
                                }
                                ?>

                            </button>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3 text-center sm:px-8">Function</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center bg-gray-800 text-gray-300 border-b border-gray-700 hidden no-result">
                    <td class="py-6" colspan="4">No Results Found</td>
                </tr>
                <?php
                if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
                    $id = $_SESSION["id"];
                    $status = "progress";
                    $sql = "SELECT * FROM `tasks` WHERE `id` = ? AND `task_status` = ? ORDER BY `task_time` ASC";
                    //if any specific order
                    if (isset($_GET["o"]) && ($_GET["o"] == "asc" || $_GET["o"] == "desc")) {
                        $order = $_GET["o"];
                        $sql = "SELECT * FROM `tasks` WHERE `id` = ? AND `task_status` = ? ORDER BY `task_time` $order";
                    }
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "ss", $id, $status);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $num = mysqli_num_rows($result);
                    if ($num != 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $title = $row["task_title"];
                            $desc = $row["task_desc"];
                            $time = $row["task_time"];
                            $task_id = $row["task_id"];
                            echo '<tr class="bg-gray-800 border-gray-700 text-white border-b hidden tr" id="#' . $task_id . '">
                                <td class="px-3 py-4 text-sm sm:text-base text-center sm:px-8">#' . $task_id . '</td>
                                <!--max 150-->
                                <div>
                                    <td class="py-4 text-sm sm:text-base title w-full">' . $title . '</td>
                                </div>
                                <td class="px-3 py-4">
                                    <input type="datetime-local" class="bg-gray-800 outline-none datetime hidden" value="' . $time . '">
                                    <input type="date" class="bg-gray-800 outline-none w-[87px] hide-cal date text-sm sm:text-base hide" readonly>
                                    <input type="time" class="bg-gray-800 outline-none w-[87px] hide-cal time text-sm sm:text-base" readonly>
                                </td>
                                <td class="text-center py-3 space-y-1 grid place-items-center">
                                    <div class="flex space-x-1">
                                        <button data-modal-target="detail-modal-' . $i . '" data-modal-toggle="detail-modal-' . $i . '" class="rounded-md bg-blue-500 hover:bg-blue-600 p-2">
                                            <img class="invert w-6" src="../images/detail.png" alt="detail">
                                        </button>
                                        <button data-modal-target="edit-modal-' . $i . '" data-modal-toggle="edit-modal-' . $i . '"  href="" class="rounded-md bg-yellow-500 hover:bg-yellow-600 p-2">
                                            <img class="invert w-6" src="../images/edit.png" alt="edit">
                                        </button>
                                    </div>
                                        <button data-modal-target="finish-modal-' . $i . '" data-modal-toggle="finish-modal-' . $i . '" href="" class="rounded-md bg-green-600 hover:bg-green-700 p-2">
                                            <img class="invert w-6" src="../images/finish.png" alt="finish">
                                        </button>
                                </td>
                            </tr>';

                            //echo edit modal
                            include ("partials/_editmodal.php");

                            //echo finish mark modal
                            include ("partials/_finishmodal.php");

                            //echo detail modal
                            include ("partials/_detailmodal.php");

                            $i++;
                        }
                    } else {
                        include ("partials/_dummy-input.php");
                    }
                } else {
                    include ("partials/_dummy-login.php");
                }
                ?>

            </tbody>
        </table>

    </div>

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

    <script src="side/script.js"></script>
    <script src="side/flowbite.js"></script>
    <script src="side/pagination.js"></script>
    <?php
    if (!isset($_SESSION["log"])) {
        echo '<script> formHide(); </script>';
    }
    ?>


</body>

</html>