<?php
//check if request is post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
        echo "file not allowed";
        exit();
    } 

    //check if there is any error in file uploaded
    if ($fileError !== 0) {
        echo 'file has error';
        exit();
    }

    //check file size
    if ($fileSize > 500000) {
        echo 'file size is too large and > 500 kb';
        exit();
    }

    //giving file unique id (gives current time in number of ms) and adding ext to it
    $fileNewName = uniqid("", true) . "." . $fileActualExt;

    //giving destination for file
    $fileDest = "../profile/images/" . $fileNewName;

    //now moving the file
    $result = move_uploaded_file($fileTmpName, $fileDest);

    if ($result == true) {
        echo "paste successful";
    }
    
} else {
    echo "not post";
    exit();
}
