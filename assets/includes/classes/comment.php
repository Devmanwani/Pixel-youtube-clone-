<?php
require_once("buttonProvider.php");
require_once("commentControls.php");
    class comment{
        private $con, $sqlData, $userLoggedInObj, $videoId;

        public function __construct($con, $input, $userLoggedInObj, $videoId){

            if(!is_array($input)){
                $query = $con->prepare("SELECT * FROM comments WHERE id=:id");
                $query->bindParam(":id",$input);
                $query->execute();

                $input = $query->fetch(PDO::FETCH_ASSOC);
            }

            $this->sqlData =$input;
            $this->con = $con;
            $this->userLoggedInObj = $userLoggedInObj;
            $this->videoId = $videoId;
        }

        public function create(){
            $id = $this->sqlData["id"];
            $videoId = $this->getVideoId();
            $body = $this->sqlData["body"];
            $postedBy = $this->sqlData["postedBy"];
            $profileButton = buttonProvider::createUserProfileButton($this->con, $postedBy);
            

            $commentControlsObj = new commentControls($this->con, $this, $this->userLoggedInObj);
            $commentControls = $commentControlsObj->create();

            $numResponses = $this->getNumberOfReplies();
        
            if($numResponses > 0 && user::isLoggedIn()) {
                $viewRepliesText = "<span class='repliesSection viewReplies' onclick='getReplies($id, this, $videoId)'>
                                        View all $numResponses replies</span>";
            }
            else {
                $viewRepliesText = "<div class='repliesSection'></div>";
            }

            return "<div class='itemContainer'>
                        <div class='comment'>
                            $profileButton
                            <div class='mainContainer'>

                                <div class='commentHeader'>
                                    <a href='profile.php?username=$postedBy'>
                                        <span class='username'>$postedBy</span>
                                    </a>
                                </div>

                                <div class='body'>
                                    $body
                                </div>
                            </div>
                        </div>
                        $commentControls
                        $viewRepliesText
                    </div>";

        }

        public function getNumberOfReplies() {
            $query = $this->con->prepare("SELECT count(*) FROM comments WHERE responseTo=:responseTo");
            $query->bindParam(":responseTo", $id);
            $id = $this->sqlData["id"];
            $query->execute();
    
            return $query->fetchColumn();
        }


        public function getId() {
            return $this->sqlData["id"];
        }
    
        public function getVideoId() {
            return $this->videoId;
        }

        public function getReplies() {
            $query = $this->con->prepare("SELECT * FROM comments WHERE responseTo=:commentId ORDER BY datePosted ASC");
            $query->bindParam(":commentId", $id);
    
            $id = $this->getId();
    
            $query->execute();
    
            $comments = "";
            $videoId = $this->getVideoId();
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $comment = new comment($this->con, $row, $this->userLoggedInObj, $videoId);
                $comments .= $comment->create();
            }
    
            return $comments;
        }

    }

?>