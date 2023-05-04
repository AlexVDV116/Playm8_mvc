<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$userProfileID = $_SESSION["auth_user"]["userProfileID"];

require_once '../dao/userProfileDAO.php';

if (isset($_POST["submit"])) {

    // Grab the data of the file
    $file = $_FILES["file"];
    $fileName = $_FILES["file"]["name"];
    $fileTmpName = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];
    $fileType = $_FILES["file"]["type"];
    $fileError = $_FILES["file"]["error"];

    // Grab the extension of the file
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowedExt = ["jpg", "jpeg", "png"];

    // Check if file extension is allowed else redirect with error message
    if (in_array($fileActualExt, $allowedExt)) {
        // Check if an error occuroed while uploading
        if ($fileError === 0) {
            // Check if the file size is less then 5 megabytes
            if ($fileSize < 5120000) {
                // Generate an unique file name and concat with file extentsion
                $fileNameNew = $userProfileID . "." . $fileActualExt;
                $fileDest = '../uploads/' . $fileNameNew;

                // Function that moves the file from the tmp location to the uploads folder
                // If you run this using XAMPP make sure the Apache process owner has read/write permission to your file destination folder
                move_uploaded_file($fileTmpName, $fileDest);

                // Update the userProfiles.userProfilePicture collum with the new filename
                $userProfileDAO = new userProfileDAO;
                if ($userProfileDAO->checkRecordExists($userProfileID) == true) {
                    $userProfileDAO->updateUserProfilePicture($fileNameNew, $userProfileID);

                    // Redirect user with success message
                    header("location: ../view/editUserProfile.php?upload=success");
                } else {
                    header("location: ../view/editUserProfile.php?upload=fail");
                }
            } else {
                header("location: ../view/editUserProfile.php?error=filesize");
                exit();
            }
        } else {
            header("location: ../view/editUserProfile.php?error=uploaderror");
            exit();
        }
    } else {
        header("location: ../view/editUserProfile.php?error=fileextnotallowed");
        exit();
    }
}
