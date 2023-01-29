<?php
require_once("assets/includes/header.php");
require_once("assets/includes/classes/TrendingProvider.php");

$trendingProvider = new TrendingProvider($con, $userLoggedInObj);
$videos = $trendingProvider->getVideos();

$videoGrid = new videoGrid($con, $userLoggedInObj);
?>
<div class="largeVideoGridContainer">
    <?php
    if(sizeof($videos) > 0) {
        echo $videoGrid->createLarge($videos, "Trending videos uploaded in the last week", false);
    }
    else {
        echo "No trending videos to show";
    }
    ?>
</div>