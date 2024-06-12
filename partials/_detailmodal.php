<?php
echo '<div id="detail-modal-' . $i . '" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full overflow-y-scroll hide-scrollbar">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative shadow bg-gray-700 border border-white rounded-md">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                <h3 class="text-xl font-semibold text-white">Review This Task (' . $user_id . ')</h3>
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
                        <label for="task-id-' . $task_id . '" class="block mb-2 text-sm font-medium text-white">Task Id</label>
                        <input type="text" id="work-id-' . $task_id . '" name="work-id-' . $task_id . '"
                            value="#' . $task_id . '"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                            readonly />
                    </div>
                    <div>
                        <label for="work-title-' . $task_id . '" class="block mb-2 text-sm font-medium text-white">Task Title</label>
                        <input type="text" id="work-title-' . $task_id . '" name="work-title-' . $task_id . '"
                            value="' . $title . '"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                            readonly />
                    </div>
                    <div>
                        <label for="work-desc-' . $task_id . '" class="block mb-2 text-sm font-medium text-white">Task Description</label>
                        <textarea id="work-desc-' . $task_id . '" name="work-desc-' . $task_id . '" rows="4"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white hide-scrollbar resize-none description"
                            readonly>' . $desc . '</textarea>
                    </div>
                    <div>
                        <label for="work-time-' . $task_id . '" class="block mb-2 text-sm font-medium text-white">Task Time</label>
                        <input type="datetime-local" value="' . $time . '" minlength="8" id="work-time-' . $task_id . '"
                            name="work-time-' . $task_id . '"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white hide-cal"
                            readonly />
                    </div>
                    <!--comments -->
                    <div>
                        <p class="block mb-3 text-sm font-medium text-white">
                            Related Comments
                        </p>
                        <div class="space-y-4">';

//checking comments
$sql = "SELECT * FROM `comments` WHERE `user_id` = ? AND `task_id` = ? ORDER BY `time` ASC";
$stmt2 = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt2, "ss", $user_id, $task_id);
mysqli_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
$num = mysqli_num_rows($result2);
if ($num == 0) {
    echo '<p class="text-white text-center text-sm">No Comments</p>';
} else {
    //initializing for increamental value
    $j = 1;
    while ($row = mysqli_fetch_assoc($result2)) {
        echo '
            <div class="flex-col space-y-2 text-white text-sm text-justify">
                <p>' . $j . ') ' . $row["comment"] . '</p>
                <div class="flex space-x-3 justify-end items-center">
                    <p>By <span class="font-bold">' . $row["user_name"] . '</span></p>
                    <input type="datetime-local" value="' . $row["time"] . '" class="bg-transparent outline-none hide-cal sm:text-base" readonly />
                </div>';
        $j++;
    }
} //ending 

echo '</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>';
