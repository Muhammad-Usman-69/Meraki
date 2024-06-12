<tr class="bg-gray-800 border-gray-700 text-white border-b hidden tr" id="#6969">
    <td class="px-6 py-4">#1</td>
    <!--max 150-->
    <td class="py-4 text-sm sm:text-base">Login to Meraki! A To Do List.</td>
    <td class="px-3 py-4">
        <input type="datetime-local" class="bg-gray-800 outline-none datetime hidden" value="2030-01-20T00:00">
        <input type="date" class="bg-gray-800 outline-none w-[87px] hide-cal date" readonly>
        <input type="time" class="bg-gray-800 outline-none w-[87px] hide-cal time" readonly>
    </td>
    <td class="py-4 grid place-items-center space-y-1">
        <div class="flex space-x-1">
            <button data-modal-target="dummy-login-detail-modal" data-modal-toggle="dummy-login-detail-modal"
                class="rounded-md bg-blue-500 hover:bg-blue-600 p-2">
                <img class="invert w-6" src="../images/detail.png" alt="detail">
            </button>
            <button data-modal-target="dummy-login-edit-modal" data-modal-toggle="dummy-login-edit-modal" href=""
                class="rounded-md bg-yellow-500 hover:bg-yellow-600 p-2">
                <img class="invert w-6" src="../images/edit.png" alt="edit">
            </button>
        </div>
        <div class="w-fit">
            <button data-modal-target="dummy-login-finish-modal" data-modal-toggle="dummy-login-finish-modal" href=""
                class="rounded-md bg-green-600 hover:bg-green-700 p-2">
                <img class="invert w-6" src="../images/finish.png" alt="finish">
            </button>
        </div>
    </td>
</tr>

<div id="dummy-login-detail-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative shadow bg-gray-700 border border-white rounded-md">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                <h3 class="text-xl font-semibold text-white">
                    Review your work
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                    data-modal-hide="dummy-login-detail-modal">
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
                        <label for="work-id-1" class="block mb-2 text-sm font-medium text-white">Your
                            Work Id</label>
                        <input type="text" id="work-id-1" name="work-id-1"
                            value="#1"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                            readonly>
                    </div>
                    <div>
                        <label for="work-title-1" class="block mb-2 text-sm font-medium text-white">Your
                            Work
                            Title</label>
                        <input type="text" id="work-title-1" name="work-title-1"
                            value="Login to Meraki! A To Do List."
                            class="border text-sm rounded-lg  focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white title"
                            readonly>
                    </div>
                    <div>
                        <label for="work-desc-1" class="block mb-2 text-sm font-medium text-white">Your
                            Work Description</label>
                        <textarea id="work-desc-1" name="work-desc-1" rows="4"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white hide-scrollbar resize-none description"
                            readonly>1) Click on menu bar on top right corner. &#013;2) Click on login. &#013;3) Fill out details. &#013;4) Log in.</textarea>
                    </div>
                    <div>
                        <label for="work-time-1" class="block mb-2 text-sm font-medium text-white">Your
                            Work Time</label>
                        <input type="datetime-local" value="2030-01-20T00:00" minlength="8" id="work-time-1"
                            name="work-time-1"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white hide-cal"
                            readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dummy-login-edit-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative shadow bg-gray-700 border border-white rounded-md">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                <h3 class="text-xl font-semibold text-white">
                    Edit your work
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                    data-modal-hide="dummy-login-edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="/?error=Can't update this" method="post">
                <div class="p-4 md:p-5 space-y-4">
                    <div>
                        <label for="work-edit-id-1"
                            class="block mb-2 text-sm font-medium text-white">Your
                            Work Id</label>
                        <input type="text" id="work-edit-id-1" name="work-edit-id-1"
                            value="#1"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                            readonly>
                    </div>
                    <div>
                        <label for="work-edit-title-1"
                            class="block mb-2 text-sm font-medium text-white">Your
                            Work Title</label>
                        <input type="text" id="work-edit-title-1" name="work-edit-title-1"
                            value="Login to Meraki! A To Do List."
                            class="border text-sm rounded-lg  focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white">
                    </div>
                    <div>
                        <label for="work-edit-desc-1"
                            class="block mb-2 text-sm font-medium text-white">Your
                            Work Description</label>
                        <textarea id="work-edit-desc-1" name="work-edit-desc-1" rows="4"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white hide-scrollbar resize-none">1) Click on menu bar on top right corner. &#013;2) Click on login. &#013;3) Fill out details. &#013;4) Log in.</textarea>
                    </div>
                    <div>
                        <label for="work-edit-time-1"
                            class="block mb-2 text-sm font-medium text-white">Your
                            Work Time</label>
                        <input type="datetime-local" value="2030-01-20T00:00" id="work-edit-time-1"
                            name="work-edit-time-1"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white calender">
                    </div>
                    <button type="submit"
                        class="w-full text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="dummy-login-finish-modal" data-modal-backdrop="static" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative rounded-lg shadow bg-gray-700 border border-white">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                data-modal-hide="dummy-login-finish-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 w-12 h-12 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-400">Are you sure you want to mark this as finished?
                </h3>
                <button onclick="window.open(`/?error=Can't finish this`, `_self`)"
                    data-modal-hide="dummy-login-finish-modal" type="button"
                    class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-700 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 me-2">
                    Yes, I&#39;m sure
                </button>
                <button data-modal-hide="dummy-login-finish-modal" type="button"
                    class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </div>
    </div>
</div>

<div id="dummy-login-delete-modal" data-modal-backdrop="static" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative rounded-lg shadow bg-gray-700 border border-white">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                data-modal-hide="dummy-login-delete-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 w-12 h-12 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-400">Are you sure you want to mark this as deleted?
                </h3>
                <button onclick="window.open(`/?error=Can't delete this`, `_self`)"
                    data-modal-hide="dummy-login-finish-modal" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 me-2">
                    Yes, I&#39;m sure
                </button>
                <button data-modal-hide="dummy-login-delete-modal" type="button"
                    class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </div>
    </div>
</div>