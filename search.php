<?php
require_once("assets/includes/header.php");
require_once("assets/includes/classes/SearchResultsProvider.php");

if(!isset($_GET["term"]) || $_GET["term"]==""){
    echo "you must enter a search term";
    exit();
}

$term = $_GET["term"];

$serachResultsProvider = new SearchResultsProvider($con, $userLoggedInObj);
$videos = $serachResultsProvider->getVideos($term);

$videoGrid = new videoGrid($con, $userLoggedInObj);
?>

<div class="largeVideoGridContainer">

    <?php

    if(sizeof($videos)>0){
        echo $videoGrid->createLarge($videos, sizeof($videos) . " videos found");
    }
    else{
        echo "No results found";
    }
    ?>

</div>






<?php
require_once("assets/includes/footer.php");?>