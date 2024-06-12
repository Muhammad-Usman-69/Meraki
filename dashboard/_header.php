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
        echo '<img src="' . $row2["img"] . '" alt="" class="h-9 w-9 rounded-full border-2 border-gray-800">
        <p class="text-gray-700 text-sm">' . $row2["name"] . '</p>';
        ?>
    </a>
</header>