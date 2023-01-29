<?php
require_once("../assets/includes/config.php");
require_once("../assets/includes/classes/user.php");
require_once("../assets/includes/classes/comment.php");

if(isset($_POST['commentText']) && isset($_POST['postedBy']) && isset($_POST['videoId'])){
    $userLoggedInObj = new user($con, $_SESSION["userLoggedIn"]);

    $query = $con->prepare("INSERT INTO comments(postedBy, videoId, responseTo, body)
                            VALUES(:postedBy, :videoId, :responseTo, :body)");
    $query->bindParam(":postedBy", $postedBy);
    $query->bindParam(":videoId", $videoId);
    $query->bindParam(":responseTo", $responseTo);
    $query->bindParam(":body", $commentText);

    $postedBy = $_POST['postedBy'];
    $videoId = $_POST['videoId'];
    $responseTo = $_POST['responseTo'];
    $commentText = $_POST['commentText'];

    $query->execute();

    
    $newComment = new comment($con, $con->lastInsertId(), $userLoggedInObj, $videoId);
    echo $newComment->create();
}
else{
    
}


?>