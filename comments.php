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
$sql = "SELECT * FROM `comments`";
if (isset($_GET["taskid"])) {
    $taskid = $_GET['taskid'];
    $sql = "SELECT * FROM `comments` WHERE `task_id` = '$taskid'";
}
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);

//check if no tasks
if ($num == 0) {

    //check if redirecting from delete
    if (isset($_GET["alert"]) && $_GET["alert"] == "Deleted Successfully") {
        header("location: tasks?alert=Deleted Successfully. No comments available");
        exit();
    }

    //if coming from specific
    if (str_contains($_SERVER["HTTP_REFERER"], "tasks?id")) {
        header("location: /tasks?id={$_GET["userid"]}&error=No Comments Available");
        exit();
    }

    header("location: tasks?error=No Comments Available");
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
    <title>Comments - Dashboard Meraki</title>
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
            <!-- user container -->
            <div class="m-4 bg-white rounded-md shadow-md container min-w-[calc(100%-32px)] text-sm max-w-[calc(100%-32px)]"
                id="user">
                <table class="w-full shadow-md">
                    <thead>
                        <tr class="border-b-gray-600 border-b bg-[#F3F2F7]">
                            <th scope="col" class="p-4">Comment Id</th>
                            <th scope="col" class="p-4">Task Id</th>
                            <th scope="col" class="p-4">User Id</th>
                            <th scope="col" class="p-4">Comment</th>
                            <th scope="col" class="p-4">Time</th>
                            <th scope="col" class="p-4">Functions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // printing tasks
                        
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $comment_id = $row["comment_id"];
                            $task_id = $row["task_id"];
                            $user_id = $row["user_id"];
                            $comment = $row["comment"];
                            $time = $row["time"];
                            //echoing data
                            echo '<tr class="border-b-gray-500 border-b bg-[#F8F8F8] last:border-b-0">
                                <td class="text-center py-3">' . $comment_id . '</td>
                                <td class="text-center py-3">' . $task_id . '</td>
                                <td class="text-center py-3">' . $user_id . '</td>
                                <td class="text-center py-3">' . $comment . '</td>
                                <td class="text-center py-3">
                                    <input type="datetime-local" class="bg-transparent hide-cal py-3 outline-none border-none" value="' . $time . '" readonly>
                                </td>
                                <td class="text-center py-3 space-y-1 grid place-items-center"><a href="dashboard/_delete?comment=' . $comment_id . '&task=' . $task_id . '&id=' . $user_id . '" class="rounded-md bg-red-600 hover:bg-red-700 p-2">
                                        <img class="invert w-5" src="../images/delete.png" alt="delete">
                                    </a>
                                </td>
                            </tr>';

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