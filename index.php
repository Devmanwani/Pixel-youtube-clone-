<?php 
require_once("assets/includes/header.php");?>

<div class = "videoSection">
<?php
    $subscriptionsProvider = new subscriptionsProvider($con, $userLoggedInObj);
    $subscriptionVideos = $subscriptionsProvider->getVideos();

    $videoGrid = new videoGrid($con, $userLoggedInObj->getUsername());

    if(user::isLoggedIn() && sizeof($subscriptionVideos)>0){
        echo $videoGrid->create($subscriptionVideos, "Subscriptions", false);
    }
    echo $videoGrid->create(null, "Recommended", false);

?>
</div>



<?php require_once("assets/includes/footer.php"); ?>
