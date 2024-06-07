<?php
echo '<div id="edit-modal-' . $i . '" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative shadow bg-gray-700 border border-white rounded-md">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                <h3 class="text-xl font-semibold text-white">
                    Edit This Task
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
            <form action="partials/_update.php?id=' . $task_id . '" method="post">
            <div class="p-4 md:p-5 space-y-4">
                    <div>
                        <label for="task-edit-id-' . $task_id . '" class="block mb-2 text-sm font-medium text-white">Your
                            Task Id</label>
                        <input type="text" id="task-edit-id-' . $task_id . '" name="task-edit-id-' . $task_id . '"
                            value="#' . $task_id . '"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                            readonly>
                    </div>
                    <div>
                        <label for="task-edit-title-' . $task_id . '" class="block mb-2 text-sm font-medium text-white">Your
                            Task Title</label>
                        <input type="text" id="task-edit-title-' . $task_id . '" name="task-edit-title-' . $task_id . '"
                            value="' . $title . '"
                            class="border text-sm rounded-lg  focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white" maxlength="50">
                    </div>
                    <div>
                        <label for="task-edit-desc-' . $task_id . '" class="block mb-2 text-sm font-medium text-white">Your
                            Task Description</label>
                        <textarea id="task-edit-desc-' . $task_id . '" name="task-edit-desc-' . $task_id . '" rows="4"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white hide-scrollbar resize-none" maxlength="300">' . $desc . '</textarea>
                    </div>
                    <div>
                        <label for="task-edit-time-' . $task_id . '" class="block mb-2 text-sm font-medium text-white">Your
                            Task Time</label>
                        <input type="datetime-local" value="' . $time . '" id="task-edit-time-' . $task_id . '"
                            name="task-edit-time-' . $task_id . '"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white calender">
                    </div>
                    <button type="submit"
                        class="w-full text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Update</button>
                </div>
            </form>
            <form method="post" action="partials/_comment">
                <div class="p-4 md:p-5 space-y-4">
                    <label for="work-comment-id-' . $task_id . '" class="block mb-2 text-sm font-medium text-white">Add Comment</label>
                    <input type="text" id="work-comment-id-' . $task_id . '" name="comment" placeholder="Done this/that"
                    class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white" minlength="12">
                    <input type="hidden" name="id" value="' . $task_id . '">
                    <button type="submit"
                        class="w-full text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>';