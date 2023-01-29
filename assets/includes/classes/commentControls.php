<?php
require_once("buttonProvider.php");

class commentControls{

    private $con, $comment, $userLoggedInObj;

    public function __construct($con, $comment, $userLoggedInObj){
        $this->con = $con;
        $this->comment = $comment;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create(){
        $replyButton = $this->createReplyButton();
        $replySection = $this->createReplySection();

        return "<div class = 'controls'>
                   $replyButton
                </div>
                $replySection";

    }

    private function createReplyButton(){
        $text = "REPLY";
        $action = "toggleReply(this)";

        return buttonProvider::createButton($text, null , $action, null );
    }

    

    private function createReplySection(){
        $postedBy = $this->userLoggedInObj->getUsername();
        $videoId = $this->comment->getVideoId();
        $commentId = $this->comment->getId();

        $profileButton = buttonProvider::createUserProfileButton($this->con, $postedBy);

        $cancelButtonAction = "toggleReply(this)";
        $cancelButton = buttonProvider::createButton("cancel", null, $cancelButtonAction, "cancelComment");

        $postButtonAction = "postComment(this, \"$postedBy\", $videoId, $commentId, \"repliesSection\")";
        $postButton = buttonProvider::createButton("Reply", null, $postButtonAction, "postComment");

        return "
                <div class='commentForm hidden'>
                    $profileButton
                    <textarea class='commentBody' placeholder='Add a Comment'></textarea>
                    $cancelButton
                    $postButton 
                </div>";
    }

    

    
}

?>