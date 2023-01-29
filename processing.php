<?php
require_once("assets/includes/header.php");
require_once("assets/includes/classes/VideoUploadData.php");
require_once("assets/includes/classes/videoProcessor.php");

if(!isset($_POST["uploadButton"])){
    echo "No file sent to page.";
    exit();
}

$videoUploadData=new videoUploadData(
    $_FILES["fileInput"],
    $_POST["titleInput"],
    $_POST["descInput"],
    $_POST["privacyInput"],
    $_POST["categoriesInput"],
    $userLoggedInObj->getUsername()
);

$videoProcessor = new videoProcessor($con);
$wasSuccessfull = $videoProcessor->upload($videoUploadData);


if($wasSuccessfull){
    echo "upload successfull";
}

?>