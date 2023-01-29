<?php
class videoGridItem{
    private $video, $largeMode;

    public function __construct($video, $largeMode){
        $this->video=$video;
        $this->largeMode=$largeMode;
    
    }

    public function create(){
        $thumbnail = $this->createThumbnail();
        $details = $this->createDetails();
        $url = "watch.php?id=" . $this->video->getId();

        return "<a href='$url'>
                    <div class='videoGridItem'>
                        $thumbnail
                        $details
                    </div>
                </a>";
    }

    public function createThumbnail(){
        
        $thumbnail = $this->video->getThumbnail();
        $duration = $this->video->getDuration();

        return "<div class='thumbnail'>
                    <img src='$thumbnail'>
                    <div class='duration'>
                        <span>$duration</span>
                    </div>
                </div>";
    }

    public function createDetails(){
        $title = $this->video->getTitle();
        $username = $this->video->getUploadedBy();
        $views = $this->video->getViews();
        $timeStamp = $this->video->getTimeStamp();

        return "<div class='details'>
                    <h3 class='title'>$title</h3>
                    <span class='username'>$username</span>
                    <div class='stats'>
                        <span class='viewCount'>$views -</span>
                        <span class='timeStamp'>$timeStamp</span>
                    </div>
                </div>";
    }
}




?>