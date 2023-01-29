<?php 
class videoUploadData {
    public $videoDataArray, $title, $desc, $privacy, $categories, $uploadedBy;

    public function __construct($videoDataArray, $title, $desc, $privacy, $categories, $uploadedBy){
        $this->videoDataArray= $videoDataArray;
        $this->title=$title;
        $this->desc=$desc;
        $this->privacy=$privacy;
        $this->categories=$categories;
        $this->uploadedBy=$uploadedBy;
    }

    public function updateDetails($con, $videoId) {
        $query = $con->prepare("UPDATE videos SET title=:title, description=:description, privacy=:privacy,
                                    categories=:categories WHERE id=:videoid");
        $query->bindParam(":title", $this->title);
        $query->bindParam(":description", $this->desc);
        $query->bindParam(":privacy", $this->privacy);
        $query->bindParam(":categories", $this->categories);
        $query->bindParam(":videoid", $videoId);

        return $query->execute();
    }
}
?>