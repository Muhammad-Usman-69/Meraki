<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Muhammad Usman">
    <title>Meraki - Email Verification</title>
    <link rel="stylesheet" href="../side/style.css">
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon">
</head>

<body>
    <div class="h-screen w-full flex flex-col justify-center items-center bg-gray-800 space-y-8">

        <img src="../images/spinner.png" alt="" class="w-32 h-32 invert animate-spin spin-slow">

        <ul class="space-y-3">
            <!-- request container -->
            <li class="grid grid-cols-[32px_1fr] space-x-3">
                <div class="bg-green-500 p-1 rounded-sm">
                    <img src="../images/finish.png" alt="" class="w-6 h-6 invert">
                </div>
                <p class="text-gray-300 text-lg">Request Recieved</p>
            </li>

            <!-- progress container -->
            <li class="progress grid grid-cols-[32px_1fr] space-x-3">
                <div class="bg-green-500 p-1 rounded-sm">
                    <img src="../images/spinner.png" alt="" class="w-6 h-6 animate-spin invert">
                </div>
                <p class="text-gray-300 text-lg">Sending Email...</p>
            </li>

            <!-- Verification Successful -->
            <li class="success transition-all duration-1000 grid grid-cols-[32px_1fr] space-x-3 opacity-0">
                <div class="bg-red-500 p-1 rounded-sm">
                    <img src="../images/close.png" alt="" class="w-6 h-6 invert">
                </div>
                <p class="text-gray-300 text-lg">Email has been sent!</p>
            </li>

        </ul>
        <p class="redirect text-white text-lg opacity-0 transition-all duration-1000">You may redirect to the main page
        </p>
    </div>


    <?php

    include("_dbconnect.php");
    session_start();

    if (!isset($_SESSION["log"])) {
        header("location:/?error=Not logged in");
    }

    //sending code & id to db
    $id = $_SESSION["id"];

    // Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';

    // Create a PHPMailer instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_CONNECTION;
        ; // Disable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'meraki4446996@gmail.com'; // SMTP username
        $mail->Password = 'eqvv wxjk mkht rcxw'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption
        $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->Timeout = 1;
        // Recipients
        $mail->setFrom('meraki4446996@gmail.com', 'Meraki');
        $mail->addAddress('usmansaleem4446996@gmail.com', 'Usman');

        //not showing errors
        $mail->SMTPDebug = false;
        $mail->do_debug = 0;

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Email Verification';
        $mail->Body = '<b>Hello World!</b>';

        // Send email
        $mail->send();
    } catch (Exception $e) {
        echo '<script>
    document.querySelector(".success").innerHTML = `<div class="bg-red-500 p-1 rounded-sm">
                <img src="../images/close.png" alt="" class="w-6 h-6 invert">
        </div>
        <p class="text-gray-300 text-lg">Please try again later</p>`;
    </script>';
    }

    ?>
    <script>
        setTimeout(() => {
            document.querySelector(".success").classList.add("opacity-100");
            document.querySelector(".redirect").classList.add("opacity-100");
        }, 500);
    </script>

</body>

</html>