<?php
//check if request is post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();

    //check if user is logged in
    if ($_SESSION["log"] != true) {
        header("location:/?error=Please log in");
        exit();
    }

    //taking file
    $file = $_FILES["p_img"];

    //taking file properties
    $fileName = $_FILES["p_img"]["name"];
    $fileTmpName = $_FILES["p_img"]["tmp_name"]; //path of image
    $fileSize = $_FILES["p_img"]["size"];
    $fileError = $_FILES["p_img"]["error"];
    $fileType = $_FILES["p_img"]["type"];

    //take apart string when there is a punctation mark in filename
    //we get an array for file name and extension
    $fileExt = explode(".", $fileName);

    //making it lower case and taking (last element) extension like .jpg
    $fileActualExt = strtolower(end($fileExt));

    //giving name of file type allowed
    $allowed = ["jpg", "jpeg", "png"];

    //check if file has extension which is allowed
    if (!in_array($fileActualExt, $allowed)) {
        header("location: /profile/?error=Unknown file type. Only allowed are jpg, jpeg and png");
        exit();
    }

    //check if there is any error in file uploaded
    if ($fileError !== 0) {
        header("location: /profile/?error=An error occured. Please upload again");
        exit();
    }

    //check file size
    if ($fileSize > 500000) {
        header("location: /profile/?error=File too large. Maximum size is 500 KB");
        exit();
    }

    //giving file unique id (gives current time in number of ms) and adding ext to it
    $fileNewName = uniqid("", true) . "." . $fileActualExt;

    //giving destination for file
    $fileDest = "../profile/images/" . $fileNewName;

    //now moving the file
    $result = move_uploaded_file($fileTmpName, $fileDest);

    //check if pasted
    if ($result != true) {
        header("location: /profile/?error=An error occured. Please upload again later");
        exit();
    }

    //taking id of user
    $id = $_SESSION["id"];

    //moving to database
    include("../partials/_dbconnect.php");

    $sql = "UPDATE `users` SET `img` = ? WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $fileNewName, $id);
    $sql_result = mysqli_stmt_execute($stmt);

    //check if data is moved to db successfully
    if ($sql_result != true) {
        header("location: /profile/?error=An error occured. Please try again");
        exit();
    }

    header("location: /profile/?alert=Uploaded successfully");
    exit();

} else {
    header("location: /profile/?error=Access Denied");
    exit();
}
