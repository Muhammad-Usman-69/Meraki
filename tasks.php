<?php

session_start();
//checking if logged
if ($_SESSION["log"] == false) {
    header("location:/?error=Not logged in");
    exit();
}

$user_id = $_SESSION["id"];

//check if admin
if ($_SESSION["admin"] != true) {
    header("location:/?error=Access Denied");
    exit();
}

include ("partials/_dbconnect.php");

//getting data
$sql = "SELECT * FROM `tasks`";
if (isset($_GET["id"])) {
    $userid = $_GET['id'];
    $sql = "SELECT * FROM `tasks` WHERE `id` = '$userid'";
}
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);

//check if no tasks
if ($num == 0) {
    //check if redirecting from delete
    if (isset($_GET["alert"]) && $_GET["alert"] == "Deleted Successfully") {
        header("location: dashboard.php?alert=Deleted Successfully. No tasks available");
        exit();
    }

    header("location: dashboard.php?error=No tasks available");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../side/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">
    <title>Dashboard Meraki</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@0;1&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1eeb4688e4.js" crossorigin="anonymous"></script>
</head>

<body class="open-sans bg-white">
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

    <!-- side menu button  -->
    <div class="absolute top-3 left-3 z-30">
        <button class="bg-gray-900 w-9 h-9 grid place-items-center p-2 rounded-full" class="button"
            onclick="displayMenu()">
            <i class="fas fa-bars text-base text-white"></i>
        </button>
    </div>
    <div class="flex z-20 overflow-y-hidden max-h-screen">
        <?php
        include ("dashboard/_sidemenu.php");
        ?>
        <!-- current container -->
        <div class="overflow-y-scroll hide-scrollbar w-full">
            <header class="flex justify-between items-center mx-3">
                <a href="/" class="dashboard-link flex items-center space-x-3 p-3">
                    <img src="images/logo.jpg" alt="" class="h-9 w-9 rounded-full border-2 border-gray-800">
                    <p class="text-gray-700 text-sm">Meraki</p>
                </a>
                <a href="p" class="flex items-center space-x-3 p-3 bg-gray-50">
                    <?php
                    $sql = "SELECT * FROM `users` WHERE `id` = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $user_id);
                    mysqli_execute($stmt);
                    $result2 = mysqli_stmt_get_result($stmt);
                    $row2 = mysqli_fetch_assoc($result2);
                    echo '<img src="profile/images/' . $row2["img"] . '" alt="" class="h-9 w-9 rounded-full border-2 border-gray-800">
                    <p class="text-gray-700 text-sm">' . $row2["name"] . '</p>
                    ';
                    ?>
                </a>
            </header>
            <hr class="mx-3 border-t border-gray-700">
            <!-- tasks container -->
            <div class="m-4 bg-white rounded-md container min-w-[calc(100%-32px)] text-sm max-w-[calc(100%-32px)] space-y-4">
                <form class="w-full shadow-md bg-[#F8F8F8] flex justify-between items-center"
                    action="dashboard/_assign" method="post">
                    <div class="flex m-4 space-x-3">
                        <textarea name="title" class="bg-transparent outline-none resize-none hide-scrollbar"
                            placeholder="Title" rows="2" cols="30" minlength="10" required></textarea>
                        <textarea name="desc" class="bg-transparent outline-none resize-none hide-scrollbar"
                            placeholder="Description" rows="2" cols="30" minlength="30" required></textarea>
                        <input type="datetime-local" name="time"
                            class="bg-transparent outline-none border-none text-gray-400"
                            oninput="this.style.color='black'" required>
                        <select name="users[]"
                            class="bg-transparent outline-none min-w-40 text-gray-400 hide-scrollbar" size="2" multiple
                            required>
                            <?php
                            //getting data
                            $sql = "SELECT * FROM `users`";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_execute($stmt);
                            $result2 = mysqli_stmt_get_result($stmt);
                            while ($row = mysqli_fetch_assoc($result2)) {
                                echo '<option value="' . $row["id"] . '">' . $row["id"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <button type="Submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center m-3">Assign</button>
                </form>
                <table class="w-full shadow-md">
                    <thead>
                        <tr class="border-b-gray-600 border-b bg-[#F3F2F7]">
                            <th scope="col" class="p-4">Task Id</th>
                            <th scope="col" class="p-4">User Id</th>
                            <th scope="col" class="p-4">Title</th>
                            <th scope="col" class="p-4">Description</th>
                            <th scope="col" class="p-4">Time</th>
                            <th scope="col" class="p-4">Comments</th>
                            <th scope="col" class="p-4">Status</th>
                            <th scope="col" class="p-4">Functions</th>
                            <th scope="col" class="p-4">View Comments</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // printing tasks
                        
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $task_id = $row["task_id"];
                            $user_id = $row["id"];
                            $title = $row["task_title"];
                            $desc = $row["task_desc"];
                            $time = $row["task_time"];

                            //taking comments
                            $sql = "SELECT * FROM `comments` WHERE `task_id` = '$task_id'";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_execute($stmt);
                            $result2 = mysqli_stmt_get_result($stmt);
                            $num = mysqli_num_rows($result2);

                            //echoing data
                            echo '<tr class="border-b-gray-500 border-b bg-[#F8F8F8] last:border-b-0">
                            <td class="text-center py-3">' . $task_id . '</td>
                            <td class="text-center py-3">' . $row["id"] . '</td>
                            <td class="text-center py-3">' . $title . '</td>
                            <td class="text-center py-3 px-3">' . $desc . '</td>
                            <td class="text-center py-3">
                                <input type="datetime-local" class="bg-transparent hide-cal py-3 outline-none border-none" value="' . $row["task_time"] . '" readonly>
                            </td>
                            <td class="text-center py-3">' . $num . '</td>
                            <td class="text-center py-3 capitalize">' . $row["task_status"] . '</td>
                            <td class="text-center py-3 space-y-1 grid place-items-center">
                                <div class="flex space-x-1">
                                <button data-modal-target="edit-modal-' . $i . '" data-modal-toggle="edit-modal-' . $i . '" href="" class="rounded-md bg-yellow-500 hover:bg-yellow-600 p-2">
                                    <img class="invert w-5" src="../images/edit.png" alt="edit">
                                </button>';
                            if ($row["task_status"] == "progress") {
                                echo '<a href="dashboard/_mark?id=' . $user_id . '&task=' . $task_id . '&mark=finished" class="rounded-md bg-green-600 hover:bg-green-700 p-2">
                                    <img class="invert w-5" src="../images/finish.png" alt="finish">
                                </a>';
                            } else if ($row["task_status"] == "finished") {
                                echo '<a href="dashboard/_mark?id=' . $user_id . '&task=' . $task_id . '&mark=progress" class="rounded-md bg-gray-500 hover:bg-gray-600 p-2">
                                    <img class="invert w-5" src="../images/restore.png" alt="restore">
                                </a>';
                            }
                            echo '</div>
                                <a href="dashboard/_delete?id=' . $user_id . '&task=' . $task_id . '" class="rounded-md bg-red-600 hover:bg-red-700 p-2">
                                    <img class="invert w-5" src="../images/delete.png" alt="delete">
                                </a>
                            </td>
                            <td class="py-3 relative">
                                <button class="absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 flex items-center p-2 text-white bg-cyan-500 shadow-md hover:bg-cyan-400 rounded-md"
                                onclick="window.location.assign(`comments?taskid=' . $task_id . '&userid=' . $user_id . '`)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </td>
                            </tr>';

                            //echo edit modal
                            include ("partials/_editmodal.php");
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="side/dashboard.js"></script>
    <script src="side/flowbite.js"></script>
</body>

</html>