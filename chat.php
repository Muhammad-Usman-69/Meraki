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
    <title>Chat - Dashboard Meraki</title>
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
        <div class="no-scrollbar w-full h-screen flex flex-col overflow-y-scroll">

            <!-- header -->
            <?php include ("dashboard/_header.php"); ?>

            <hr class="mx-3 border-t border-gray-700" id="seperator">

            <div class="chat w-full flex flex-col text-sm" id="chat">
                <!-- chats -->
                <div class="space-y-3 p-4 overflow-y-scroll hide-scrollbar" id="message-container">
                </div>
            </div>

            <!-- inputs -->
            <form id="send-message" class="mt-auto border-t border-gray-700 text-gray-700 flex flex-row">
                <input type="text" name="message" class="p-4 w-full outline-none border-none text-sm"
                    placeholder="Type a message" id="message">
                <button type="submit"
                    class="bg-gray-50 text-center px-4 outline-none border-l border-gray-700 active:bg-gray-200">
                    <svg viewBox="0 0 24 24" height="24" width="24" preserveAspectRatio="xMidYMid meet" class=""
                        version="1.1" x="0px" y="0px" enable-background="new 0 0 24 24">
                        <title>send</title>
                        <path fill="currentColor"
                            d="M1.101,21.757L23.8,12.028L1.101,2.3l0.011,7.912l13.623,1.816L1.112,13.845 L1.101,21.757z">
                        </path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
    <script src="side/dashboard.js"></script>
    <script>
        let adminId = "<?php echo $_SESSION["id"]; ?>";
        let adminName = "<?php echo $_SESSION["name"]; ?>";

        //giving container height
        let chatCont = document.getElementById("chat");
        let seperator = document.getElementById("seperator");
        let header = document.querySelector("header");
        let senderForm = document.getElementById("send-message");
        let height = document.body.scrollHeight - (header.offsetHeight + seperator.offsetHeight + senderForm.offsetHeight);
        chatCont.style.height = height + "px";

        /* document.getElementById("message-container").addEventListener("scroll", () => {
            
        }) */

        let triggered = 0;

        function chat() {
            let p = fetch("dashboard/_chats.php");
            p.then(res => {
                return res.json();
            }).then(chats => {

                //for scrolling to bottom incase of new message but only if other admin is at bottom
                let msgCont = document.getElementById("message-container");
                let scrollValue = document.getElementById("message-container").scrollTop;
                let bottomValue = msgCont.scrollHeight - msgCont.offsetHeight;
                let userScroll = Boolean(scrollValue == bottomValue);


                //taking message container 
                let msgContainer = document.getElementById("message-container");
                chats.forEach(chat => {
                    let id = chat.user_id;
                    let time = chat.time;
                    let message = chat.message;

                    // if admin then show to right
                    if (adminId == chat.user_id) {
                        justify = "end";
                    } else {
                        justify = "start";
                    }

                    container = `<div class="flex justify-${justify} text-gray-700">
                        <div class="bg-gray-100 rounded-lg space-y-2 p-2 flex flex-col min-w-[85%] md:min-w-[40%] min-w-[85%] md:max-w-[40%]">
                            <div class="flex justify-between text-xs space-x-3">
                                <p class="hover:underline cursor-pointer font-bold">${id}</p>
                                <p>${time}</p>
                            </div>
                            <p>${message}</p>
                        </div>
                    </div>`;

                    //stopping if don't contain
                    if (msgContainer.innerHTML.includes(container)) {
                        return;
                    }

                    //changing
                    document.getElementById("message-container").innerHTML += container;
                });


                if (userScroll == true) {
                    bottom();
                }

                //if already triggerd then stop
                if (triggered == 1) {
                    return;
                }

                //triggering bottom function after info is loaded
                bottom();

                //increamenting if triggered
                triggered++;
            })
        }


        //triggering by default
        chat();

        //repeating every 1 second
        setInterval(chat, 1000);

        function sendMessage() {
            //taking values
            let id = adminId;
            let name = adminName;
            let message = document.getElementById("message").value;

            //stopping if empty
            if (message == "") {
                return
            }

            // Create an XMLHttpRequest object
            const xhttp = new XMLHttpRequest();

            // Define a callback function for when the request is complete
            xhttp.onload = function () {

                //setting triggered to zero
                triggered = 0;

                //triggering chat
                chat();
            }

            // Send a request
            xhttp.open("POST", "dashboard/_postchat.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(`message=${message}&userid=${id}&username=${name}`);
        }

        //if submitting
        let form = document.getElementById("send-message");

        form.addEventListener("submit", (e) => {
            //preventing form submission and sending message
            e.preventDefault();
            sendMessage();

            // clearing input
            document.getElementById("message").value = "";

        });


        //scrolling to the bottom
        function bottom() {
            document.getElementById("message-container").scrollTo(0, (document.getElementById("message-container").scrollHeight));
        };
    </script>
</body>

</html>