<?php

require_once("../assets/includes/config.php");
require_once("../assets/includes/classes/video.php");
require_once("../assets/includes/classes/user.php");

$username = $_SESSION["userLoggedIn"];
$videoId = $_POST["videoId"];

$userLoggedInObj = new User($con, $username);
$video = new video($con, $videoId, $userLoggedInObj);

echo $video->like();

?>