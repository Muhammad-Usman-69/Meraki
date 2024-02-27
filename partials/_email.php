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
                <div class="bg-green-500 p-1 rounded-sm">
                    <img src="../images/finish.png" alt="" class="w-6 h-6 invert">
                </div>
                <p class="text-gray-300 text-lg">Email has been sent!</p>
            </li>

        </ul>
        <p class="redirect text-white text-lg opacity-0 transition-all duration-1000">You will be redirectred to your
            profile in 5
        </p>
    </div>


    <?php

    session_start();

    //checking for log
    if (!isset($_SESSION["log"])) {
        header("location:/?error=Not logged in");
    }

    include("_dbconnect.php");

    //taking all cresidentials
    $id = $_SESSION["id"];
    $name = $_SESSION["name"];
    $email = $_SESSION["email"];

    function random_str(
        $length,
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ) {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new Exception('$keyspace must be at least two characters long');
        }
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }

    //taking code
    $code = random_str(64);

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
        $mail->addAddress($email, $name);

        //not showing errors
        $mail->SMTPDebug = false;
        $mail->do_debug = 0;

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Email Verification';
        $mail->Body = '<!DOCTYPE html>
        <html lang="en" class="scroll-smooth">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content="Muhammad Usman">
            <link rel="shortcut icon"
                href="https://cdn.discordapp.com/attachments/1121752081032814602/1209007524573880360/logo.jpg?ex=65e55b00&is=65d2e600&hm=220c84ffae5579a80bd8039dd5e2fb37ebc5ff5f85dbf40e851e907b394ba987&"
                type="image/x-icon">
        </head>
        <body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">
            <div style="display: flex; min-height: 100vh; align-items: center; justify-content: center; background-color: rgb(55 65 81);">
                <div style="width: 18rem; border: 1px solid rgb(75 85 99); border-radius: 0.375rem; overflow: hidden;">
                    <div style="background-color: rgb(31 41 55); padding: 0.75rem 0; text-align: center; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                        <img src="https://cdn.discordapp.com/attachments/1121752081032814602/1209007524573880360/logo.jpg?ex=65e55b00&is=65d2e600&hm=220c84ffae5579a80bd8039dd5e2fb37ebc5ff5f85dbf40e851e907b394ba987&"
                            style="border-radius: 9999px; width: 3.5rem; height: 3.5rem;" alt="mailicon">
                    </div>
                    <div style="background-color: #fff; padding: 1rem;">
                        <p style="font-size: 1.25rem; margin: 0 0 0.5rem;">Email Verification</p>
                        <p style="margin: 0 0 0.5rem;">Hi ' . $name . '!</p>
                        <div style="text-align: center;">
                            <a href="localhost/partials/_verify?id=' . $id . '&code=' . $code . '"
                                style="display: inline-block; padding: 0.5rem 1.5rem; background-color: rgb(31 41 55); color: #fff; text-decoration: none; border-radius: 0.375rem; font-weight: bold;">Verify</a>
                        </div>
                        <hr style="border-top: 1px solid rgb(55 65 81); background-color: rgb(55 65 81); margin: 1rem 1rem;">
                    </div>
                    <div style="background-color: rgb(31 41 55); color: #fff; padding: 0.5rem; text-align: center; font-size: 0.75rem; border-bottom-left-radius: 0.375rem; border-bottom-right-radius: 0.375rem;">By Team Meraki &copy;</div>
                </div>
            </div>
        </body>
        
        </html>';

        // Send email
        $r = $mail->send();
        if ($r) {
            //updating id
            $sql = "UPDATE `verify` SET `verification_code` = ? WHERE `id` = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $code, $id);
            mysqli_stmt_execute($stmt);
        }
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
        let redirect = document.querySelector(".redirect");

        //taking i for decreamenting
        let i = 5;

        setTimeout(() => {
            //showing what has to be shown
            document.querySelector(".success").classList.add("opacity-100");
            redirect.classList.add("opacity-100");


            //redirecting to profile
            setInterval(() => {
                //stopping if 1
                if (i == -1) {
                    document.location.assign("../p?alert=Please Check Your Email Account");
                    return;
                }
                
                redirect.innerHTML = "You will be redirectred to your profile in " + i;

                i--;
            }, 700);
        }, 500);

    </script>

</body>

</html>