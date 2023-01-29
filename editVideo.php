<?php
require_once("assets/includes/header.php");
require_once("assets/includes/classes/videoPlayer.php");
require_once("assets/includes/classes/videoDetailsForm.php");
require_once("assets/includes/classes/videoUploadData.php");
require_once("assets/includes/classes/SelectThumbnail.php");

if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}

if(!isset($_GET["videoId"])) {
    echo "No video selected";
    exit();
}

$video = new video($con, $_GET["videoId"], $userLoggedInObj);
if($video->getUploadedBy() != $userLoggedInObj->getUsername()) {
    echo "Not your video";
    exit();
}

$detailsMessage = "";
if(isset($_POST["saveButton"])) {
    $videoData = new videoUploadData(
        null,
        $_POST["titleInput"],
        $_POST["descInput"],
        $_POST["privacyInput"],
        $_POST["categoriesInput"],
        $userLoggedInObj->getUsername()
    );

    if($videoData->updateDetails($con, $video->getId())) {
        $detailsMessage = "<div class='alert alert-success'>
                                <strong>SUCCESS!</strong> Details updated successfully!
                            </div>";
        $video = new video($con, $_GET["videoId"], $userLoggedInObj);
    }
    else {
        $detailsMessage = "<div class='alert alert-danger'>
                                <strong>ERROR!</strong> Something went wrong
                            </div>";
    }
}
?>
<script src="javascript/editVideoActions.js"></script>
<div class="editVideoContainer column">

    <div class="message">
        <?php echo $detailsMessage; ?>
    </div>

    <div class="topSection">
        <?php
        $videoPlayer = new videoPlayer($video);
        echo $videoPlayer->create(false);

        $selectThumbnail = new SelectThumbnail($con, $video);
        echo $selectThumbnail->create();
        ?>
    </div>

    <div class="bottomSection">
        <?php
        $formProvider = new videoDetailsForm($con);
        echo $formProvider->createEditDetailsForm($video);
        ?>
    </div>

</div>