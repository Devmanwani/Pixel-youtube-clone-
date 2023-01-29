<?php
require_once("../assets/includes/config.php"); 
require_once("../assets/includes/classes/Comment.php"); 
require_once("../assets/includes/classes/User.php"); 

$username = $_SESSION["userLoggedIn"];
$videoId = $_POST["videoId"];
$commentId = $_POST["commentId"];

$userLoggedInObj = new user($con, $username);
$comment = new comment($con, $commentId, $userLoggedInObj, $videoId);

echo $comment->getReplies();
?>