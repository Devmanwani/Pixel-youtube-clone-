<?php 
require_once("assets/includes/header.php");
require_once("assets/includes/classes/videoPlayer.php");
require_once("assets/includes/classes/videoInfoSection.php");
require_once("assets/includes/classes/commentSection.php");
require_once("assets/includes/classes/comment.php");



if(!isset($_GET["id"])){
    echo "no url passed into the page";
    exit();

}

$video = new video($con, $_GET["id"], $userLoggedInObj);
$video->incrementViews();
?>

<script src = "javascript/videoPlayerActions.js"></script>

<script src = "javascript/commentActions.js"></script>

<div class = "watchLeft">

    <?php
        $videoPlayer = new videoPlayer($video);
        echo $videoPlayer->create(true);

        $videoPlayer = new videoInfoSection($con, $video, $userLoggedInObj);
        echo $videoPlayer->create();

        $commentSection = new commentSection($con, $video, $userLoggedInObj);
        echo $commentSection->create();
    ?>

</div>

<div class = "suggestions">
    <?php
        $videoGrid = new videoGrid($con, $userLoggedInObj);
        echo $videoGrid->create(null, null, false);

    ?>

</div>

<?php require_once("assets/includes/footer.php"); ?>
