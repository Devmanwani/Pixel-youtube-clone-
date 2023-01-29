<?php require_once("assets/includes/config.php");
    require_once("assets/includes/classes/user.php");
    require_once("assets/includes/classes/buttonProvider.php");
    require_once("assets/includes/classes/video.php");
    require_once("assets/includes/classes/videoGrid.php");
    require_once("assets/includes/classes/videoGridItem.php");
    require_once("assets/includes/classes/subscriptionsProvider.php");
    require_once("assets/includes/classes/NavigationMenuProvider.php");
    
    $usernameLoggedIn = isset($_SESSION["userLoggedIn"]) ? $_SESSION["userLoggedIn"] : "";
    $userLoggedInObj = new user($con, $usernameLoggedIn);
    
?>
<!DOCTYPE html>
<html>
<head>
<title> PIXEL</title>
<link rel="stylesheet" type= "text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
<script src="javascript/commonActions.js"></script>
<script src="javascript/userActions.js"></script>


</head>
<body>
<div id="pageContainer">
    <div id="headContainer">
        <button class="navShowHide">
            <img src="assets/images/icons/menu.png" title="Menu" alt="Menu">
        </button>
        <a class="logoContainer" href="index.php"><img src="assets/images/icons/logo.png" title="logo" alt="PIXEL"></a>
        <div class="searchBarContainer">
            <form action="search.php" method="GET">
                <input type="text" class="searchBar" name="term" placeholder="Search">
                <button class="searchButton">
                    <img src="assets/images/icons/search.png" alt="search" title="search">
                </button>
                
            </form>
        </div>
        
        <div class=rightIcons>
             
            <?php if(user::isLoggedIn()){
                echo buttonProvider::createHyperlinkButton(null,'assets/images/icons/upload.png','upload.php', 'newUpload');}?>
            
            
            <?php $var = new buttonProvider();
             echo $var->createUserNavigationButton($con, $userLoggedInObj->getUsername());?>
        </div>
    </div>
    <div id="sideNavContainer" style="display: none">
        <?php
        $navigationProvider = new NavigationMenuProvider($con, $userLoggedInObj);
        echo $navigationProvider->create();
        
        ?>
    </div>
    <div id="mainSectionContainer">
        
        <div id="mainContentContainer">