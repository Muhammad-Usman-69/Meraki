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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="side/style.css" rel="stylesheet">
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
        <?php include ("dashboard/_sidemenu.php"); ?>
        <!-- current container -->
        <div class="overflow-y-scroll hide-scrollbar w-full">

            <!-- header -->
            <?php include ("dashboard/_header.php"); ?>

            <hr class="mx-3 border-t border-gray-700">

            <!-- user container -->
            <div
                class="m-4 bg-white rounded-md container min-w-[calc(100%-32px)] text-sm max-w-[calc(100%-32px)] space-y-4">
                <!-- user signing form -->
                <form class="w-full shadow-md bg-[#F3F2F7] flex justify-between items-center"
                    action="partials/_s-handler.php" method="post">
                    <div class="flex m-4 flex-col space-y-3 w-full lg:grid lg:grid-cols-4 lg:space-y-0 lg:space-x-3">
                        <input type="text" name="name" class="bg-[#F8F8F8] rounded-md p-2 outline-none border-none"
                            placeholder="John Doe" minlength="5" required></input>
                        <input type="email" name="email" class="bg-[#F8F8F8] rounded-md p-2 outline-none border-none"
                            placeholder="example@example.com" minlength="12" required></input>
                        <input type="password" autocomplete="new-password" name="pass"
                            class="bg-[#F8F8F8] rounded-md p-2 outline-none border-none" placeholder="••••••••"
                            minlength="12" required>
                        <button type="Submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center">Add
                            Account</button>
                    </div>
                </form>

                <table class="w-full shadow-md text-sm">
                    <thead>
                        <tr class="border-b-gray-600 border-b bg-[#F3F2F7]">
                            <th scope="col" class="p-4">User Id</th>
                            <th scope="col" class="p-4">User Name</th>
                            <th scope="col" class="p-4">Email</th>
                            <th scope="col" class="p-4">Total Tasks</th>
                            <th scope="col" class="p-4">Progress</th>
                            <th scope="col" class="p-4">Completed</th>
                            <th scope="col" class="p-4">Verify</th>
                            <th scope="col" class="p-4">Status</th>
                            <th scope="col" class="p-4">Admin</th>
                            <th scope="col" class="p-4">Change Status</th>
                            <th scope="col" class="p-4">Change Admin</th>
                            <th scope="col" class="p-4">Tasks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        //getting data
                        $sql = "SELECT * FROM `users`";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        while ($row = mysqli_fetch_assoc($result)) {
                            //checking if account is activve
                            if ($row["active"] == 1) {
                                $status = "Active";
                                $change_status = "Inactive";
                                $change_status_id = 0;
                            } else {
                                $status = "Unactive";
                                $change_status = "Active";
                                $change_status_id = 1;
                            }
                            //check if admin
                            if ($row["admin"] == 1) {
                                $admin = "Admin";
                                $change_admin = "User";
                                $change_admin_id = 0;
                            } else {
                                $admin = "User";
                                $change_admin = "Admin";
                                $change_admin_id = 1;
                            }

                            //admin can't change himself
                            if ($_SESSION["id"] == $row["id"]) {
                                $change_status = "Can't";
                                $change_status_id = 2;
                                $change_admin = "Can't";
                                $change_admin_id = 2;
                            }

                            //check if verified
                            if ($row["status"] == 1) {
                                $verify = "Verified";
                            } else {
                                $verify = "Unverified";
                            }

                            $totalTasks = 0;
                            $progress = 0;
                            $finished = 0;

                            //for tasks num
                            $sql = "SELECT * FROM `tasks` WHERE `id` = ?";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt, "s", $row["id"]);
                            mysqli_stmt_execute($stmt);
                            $result2 = mysqli_stmt_get_result($stmt);
                            $num = mysqli_num_rows($result2);
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                $totalTasks++;
                                if ($row2["task_status"] == "progress") {
                                    $progress++;
                                } else if ($row2["task_status"] == "finished") {
                                    $finished++;
                                }
                            }
                            //for eye icon
                            if ($num == 0) {
                                $color = "bg-red-600 hover:bg-red-500";
                            } else {
                                $color = "bg-cyan-500 hover:bg-cyan-400";
                            }

                            //echoing data
                            echo '<tr class="border-b-gray-500 border-b bg-[#F8F8F8] last:border-b-0">
                            <td class="text-center py-3">' . $row["id"] . '</td>
                            <td class="text-center py-3">' . $row["name"] . '</td>
                            <td class="text-center py-3">' . $row["email"] . '</td>
                            <td class="text-center py-3">' . $totalTasks . '</td>
                            <td class="text-center py-3">' . $progress . '</td>
                            <td class="text-center py-3">' . $finished . '</td>
                            <td class="text-center py-3">' . $verify . '</td>
                            <td class="text-center py-3">' . $status . '</td>
                            <td class="text-center py-3">' . $admin . '</td>
                            <td class="py-3 relative">
                                <button onclick="window.location.assign(`dashboard/_changeuseractive?id=' . $row["id"] . '&status=' . $change_status_id . '`)" class="absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  px-4 py-2 text-center whitespace-nowrap">' . $change_status . '</button>
                            </td>
                            <td class="py-3 relative">
                                <button onclick="window.location.assign(`dashboard/_changeuseradmin?id=' . $row["id"] . '&admin=' . $change_admin_id . '`)" class="absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  px-4 py-2 text-center whitespace-nowrap">' . $change_admin . '</button>
                            </td>
                            <td class="py-3 relative">
                                <button class="absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 flex items-center p-2 text-white shadow-md ' . $color . ' rounded-md"
                                onclick="window.location.assign(`tasks?id=' . $row["id"] . '`)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <script src="side/dashboard.js"></script>
</body>

</html>