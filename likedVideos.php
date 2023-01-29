<?php
require_once("assets/includes/header.php");
require_once("assets/includes/classes/LikedVideosProvider.php");

if(!user::isLoggedIn()) {
    header("Location: signIn.php");
}

$likedVideosProvider = new LikedVideosProvider($con, $userLoggedInObj);
$videos = $likedVideosProvider->getVideos();

$videoGrid = new videoGrid($con, $userLoggedInObj);
?>
<div class="largeVideoGridContainer">
    <?php
    if(sizeof($videos) > 0) {
        echo $videoGrid->createLarge($videos, "Videos that you have liked", false);
    }
    else {
        echo "No videos to show";
    }
    ?>
</div>