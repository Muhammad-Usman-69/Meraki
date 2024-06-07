<?php
include ("partials/_dbconnect.php");
session_start();

if ($_SESSION["log"] != true) {
    header("location:/?error=Please log in");
    exit();
}

//check if admin
/* if (isset($_SESSION["admin"]) && $_SESSION["admin"] == true) {
    header("location:dashboard");
    exit();
} */

$id = $_SESSION["id"];
$sql = "SELECT * FROM `users` WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$name = $row["name"];
$email = $row["email"];
$profile_img = $row["img"];
$status = $row["status"];

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

<body class="flex flex-col min-h-screen hide-scrollbar bg-gray-800" onresize="showTitle()">

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

    <!--header-->
    <header class="h-20">
        <nav class="flex z-20 fixed shadow-sm shadow-black w-full justify-between items-center bg-gray-700">

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
                    <li class="list-none overflow-hidden transition-all duration-300 ease-in-out h-0 border-b-gray-600">
                        <button data-modal-target="logout-modal" data-modal-toggle="logout-modal" type="button"
                            class="block w-full py-1.5 px-3 text-gray-300 bg-gray-900 hover:bg-gray-800 overflow-hidden whitespace-nowrap text-left">Log
                            out</button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php include ("partials/_lo-modal.php") ?>

    <?php
    if ($status == 0) {
        echo '<div class="m-3">
        <div class="border-yellow-400 bg-yellow-100 flex items-center w-full border-l-[6px] py-3 px-4">
            <div class="bg-yellow-400 flex items-center justify-center mr-5 h-8 w-10 rounded-md">
                <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.0156 11.6156L10.9969 1.93125C10.5188 1.28437 9.78752 0.91875 9.00002 0.91875C8.18439 0.91875 7.45314 1.28437 7.00314 1.93125L0.984395 11.6156C0.421895 12.375 0.33752 13.3594 0.759395 14.2031C1.18127 15.0469 2.02502 15.5813 2.98127 15.5813H15.0188C15.975 15.5813 16.8188 15.0469 17.2406 14.2031C17.6625 13.3875 17.5781 12.375 17.0156 11.6156ZM16.1156 13.6406C15.8906 14.0625 15.4969 14.3156 15.0188 14.3156H2.98127C2.50315 14.3156 2.10939 14.0625 1.88439 13.6406C1.68752 13.2188 1.71564 12.7406 1.99689 12.375L8.01564 2.69062C8.24064 2.38125 8.60627 2.18437 9.00002 2.18437C9.39377 2.18437 9.75939 2.35312 9.9844 2.69062L16.0031 12.375C16.2844 12.7406 16.3125 13.2188 16.1156 13.6406Z"
                        fill="white" />
                    <path
                        d="M8.9999 6.15002C8.6624 6.15002 8.35303 6.43127 8.35303 6.79689V9.86252C8.35303 10.2 8.63428 10.5094 8.9999 10.5094C9.36553 10.5094 9.64678 10.2281 9.64678 9.86252V6.76877C9.64678 6.43127 9.3374 6.15002 8.9999 6.15002Z"
                        fill="white" />
                    <path
                        d="M8.9999 11.25C8.6624 11.25 8.35303 11.5313 8.35303 11.8969V12.0375C8.35303 12.375 8.63428 12.6844 8.9999 12.6844C9.36553 12.6844 9.64678 12.4031 9.64678 12.0375V11.8688C9.64678 11.5313 9.3374 11.25 8.9999 11.25Z"
                        fill="white" />
                </svg>
            </div>
            <div class="flex justify-between items-center w-full">
                <h5 class="text-base font-semibold text-[#9D5425]">
                    Account is Unverified!
                </h5>
                <button type="button" onclick="window.open(`partials/_email`, `_self`)" class="px-3 py-1 rounded-md text-[#9D5425] bg-yellow-400 hover:bg-opacity-80 active:bg-opacity-60">Verify</button>
            </div>
        </div>
    </div>';
    }
    ?>


    <div class="profile py-14 grid place-items-center md:grid-cols-[1fr_2px_1fr]">
        <div class="profile-pic flex justify-center relative group w-64 h-64">

            <?php
            if ($profile_img != "none") {
                echo '<img src="profile/images/' . $profile_img . '" alt="profile" class="rounded-full object-contain bg-white">';
            } else {
                echo '<img src="images/user.png" alt="profile" class="rounded-full object-contain bg-white">';
            }
            ?>

            <img src="images/upload-image.png" alt="profile"
                class="absolute opacity-0 h-full z-10 p-16 rounded-full transition-all duration-300 group-hover:bg-gray-100 group-hover:opacity-100">
            <form action="partials/_upload-img.php" method="POST" enctype="multipart/form-data"
                class="absolute z-20  opacity-0 h-full">
                <input type="file" id="p_img" name="p_img" accept="image/jpg, image/jpeg, image/png"
                    oninput="this.parentNode.submit();" class="h-full cursor-pointer" />
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
                        <img src="images/copy-files.png" alt="" class="w-6 invert">
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
                        <img src="images/copy-files.png" alt="" class="w-6 invert">
                    </button>
                </p>
            </li>
            <li class="grid grid-cols-1">
                <h4 class="font-semibold text-sm text-gray-400">User ID:</h4>
                <p class="text-lg text-white flex justify-between items-center space-x-4">
                    <span class="break-all id">
                        <?php echo $id; ?>
                    </span>
                    <button onclick="copy(document.querySelector('.id').innerHTML)">
                        <img src="images/copy-files.png" alt="" class="w-6 invert">
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
            <img class="w-6 invert" src="images/menu.png" alt="all">
        </button>
        <button class="bg-gray-700 p-2 status-button border-x border-gray-500 hover:bg-gray-600" id="1"
            onclick="active(this.id)">
            <img class="w-6 invert" src="images/hourglass.png" alt="progress">
        </button>
        <button class="bg-gray-700 p-2 rounded-tr-md status-button hover:bg-gray-600" id="2"
            onclick="active(this.id)">
            <img class="w-6 invert" src="images/finish.png" alt="finished">
        </button>
    </div>

    <!-- table -->
    <table class="w-full">
        <thead class="uppercase text-xs bg-gray-700 text-gray-400 text-left">
            <tr>
                <th scope="col" class="px-4 py-3 sm:px-8 text-center">Id</th>
                <th scope="col" class="px-4 py-3 title-header w-full hidden">Title</th>
                <th scope="col" class="px-4 py-3 sm:w-32 md:w-48 flex justify-between items-center">
                    <span>Time</span>
                    <div class="flex flex-col space-y-2">
                        <button type="button" onclick="window.location.assign('?o=asc')">
                            <img src="images/up-arrow.png" width="16" class="invert-[75%]" <?php if (isset($_GET['o']) && $_GET['o'] == 'asc') {
                                echo 'style="filter: invert(100%)"';
                            } ?> alt="">
                        </button>
                        <button type="button" onclick="window.location.assign('?o=desc')">
                            <img src="images/down-arrow.png" width="16" class="invert-[75%]" <?php if (isset($_GET['o']) && $_GET['o'] == 'desc') {
                                echo 'style="filter: invert(100%)"';
                            } ?> alt="">
                        </button>
                    </div>
                </th>
                <th scope="col" class="px-4 py-3 xl:min-w-56 text-center">Function</th>
                <th scope="col" class="px-4 py-3 sm:px-8 text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-center bg-gray-800 text-gray-300 border-b border-gray-700 hidden no-result">
                <td class="py-6" colspan="5">No Results Found</td>
            </tr>
            <?php
            $id = $_SESSION["id"];
            $sql = "SELECT * FROM `tasks` WHERE `id` = ?";
            //if any specific order
            if (isset($_GET["o"]) && ($_GET["o"] == "asc" || $_GET["o"] == "desc")) {
                $order = $_GET["o"];
                $sql = "SELECT * FROM `tasks` WHERE `id` = ? ORDER BY `task_time` $order";
            }
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $num = mysqli_num_rows($result);
            if ($num != 0) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $title = $row["task_title"];
                    $desc = $row["task_desc"];
                    $status = $row["task_status"];
                    $task_id = $row["task_id"];
                    $time = $row["task_time"];
                    echo '<tr class="bg-gray-800 border-gray-700 text-white border-b hidden tr" id="#' . $task_id . '">
                    <td class="px-4 py-4 sm:px-8 text-center">#' . $task_id . '</td>
                    <td class="py-4 title">' . $title . '</td>
                    <td class="px-4 py-4">
                        <input type="datetime-local" class="bg-gray-800 outline-none datetime hidden" value="' . $time . '">
                        <input type="date" class="bg-gray-800 outline-none w-[87px] hide-cal date hide" readonly>
                        <input type="time" class="bg-gray-800 outline-none w-[87px] hide-cal time" readonly>
                    </td>';

                    //checking status
                    if ($status != "progress") {
                        echo '<td class="text-center py-3 grid place-items-center space-y-1">
                                <button data-modal-target="detail-modal-' . $i . '" data-modal-toggle="detail-modal-' . $i . '"
                                    class="rounded-md bg-blue-500 hover:bg-blue-600 p-2">
                                    <img class="invert w-6" src="images/detail.png" alt="detail">
                                </button>
                                <button data-modal-target="restore-modal-' . $i . '" data-modal-toggle="restore-modal-' . $i . '" class="rounded-md bg-gray-500 hover:bg-gray-600 p-2">
                                    <img class="w-6 invert" src="images/restore.png" alt="edit">
                                </button>
                        </td>
                        ';

                        //restore modal
                        include ("partials/_restoremodal.php");

                        //detail modal
                        include ("partials/_detailmodal.php");
                    } else {
                        echo '<td class="text-center py-3 space-y-1 grid place-items-center">
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
                                </td>';

                        //echo detail modal
                        include ("partials/_detailmodal.php");

                        //echo edit modal
                        include ("partials/_editmodal.php");

                        //echo finish mark modal
                        include ("partials/_finishmodal.php");

                        //echo delete modal
                        include ("partials/_deletemodal.php");
                    }

                    echo '<td class="px-3 py-4 capitalize status sm:px-8 text-center">' . $status . '</td>
                    </tr>';
                    $i++;
                }
            }
            ?>

        </tbody>
    </table>


    <div class="mt-auto" id="scroll">
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

    <script>
        //showing title
        function showTitle() {
            //taking title head
            let titleHead = document.querySelector(".title-header");
            let titles = document.querySelectorAll(".title");
            //taking screen width 
            let screenWidth = document.body.scrollWidth + 4;
            if (screenWidth >= 1280) {
                titleHead.classList.remove("hidden");
                titles.forEach(title => title.classList.remove("hidden"));
                } else {
                titleHead.classList.add("hidden");
                titles.forEach(title => title.classList.add("hidden"));
            }
        }
        showTitle();
        window.addEventListener("resize", () => showTitle());
    </script>
    <script src="profile/profile.js"></script>
    <script src="side/flowbite.js"></script>
</body>

</html>