<?php
class videoGrid{

    private $con, $userLoggedInObj;
    private $largeMode=false;
    private $gridClass="videoGrid";

    public function __construct($con, $userLoggedInObj){
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create($videos, $title){

        if($videos==null){
            $gridItems=$this->generateItems();

        }
        else{
            $gridItems = $this->generateItemsFromVideos($videos);
        }

        $header="";

        if($title !=null){
            $header=$this->createGridHeader($title);

            
        }

        return "$header
                <div class='$this->gridClass'>
                    $gridItems
                </div>";
    }

    public function generateItems(){
        $query = $this->con->prepare("SELECT * FROM videos ORDER BY RAND() LIMIT 15");
        $query->execute();
    
        $elementsHtml="";
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            
            $video = new video($this->con, $row, $this->userLoggedInObj);
            $item = new videoGridItem($video, $this->largeMode);
            $elementsHtml .= $item->create();
        }
    
        return $elementsHtml;
    }
    
    public function generateItemsFromVideos($videos){
    
        $elementsHtml = "";

        foreach($videos as $video) {
            $item = new videoGridItem($video, $this->largeMode);
            $elementsHtml .= $item->create();
        }

        return $elementsHtml;
    }
    
    public function createGridHeader($title){
        
        return "<div class='videoGridHeader'>
                    <div class='left'>
                        $title 
                    </div>
                </div>";
    }

    public function createLarge($videos, $title){
        $this->gridClass .=" large";
        $this->largeMode=true;
        return $this->create($videos, $title);
    }

}



?>