<?php
class videoProcessor{
    private $con;
    private $allowedTypes=array("mp4");
    private $ffprobePath;
    private $ffmpegPath;

    public function __construct($con){
        $this->con=$con;
        $this->ffprobePath = realpath("ffmpeg/bin/ffprobe.exe");
        $this->ffmpegPath = realpath("ffmpeg/bin/ffmpeg.exe");
    }

    public function upload($videoUploadData){

        $targetdir="uploads/videos/";
        $videoData=$videoUploadData->videoDataArray;

        $tempFilePath=$targetdir . uniqid() . basename($videoData["name"]);

        $tempFilePath= str_replace(" ","_",$tempFilePath);

        $isValidData = $this->processData($videoData, $tempFilePath);

        if(!$isValidData){
            return false;
        }

        if (move_uploaded_file($videoData["tmp_name"], $tempFilePath)){
            
            $finalFilePath = $targetdir . uniqid() . ".mp4";

            if(!$this->insertVideoData($videoUploadData, $tempFilePath)){
            echo " insert query failed";
            return false;
            }

            if(!$this->generateThumbnails($tempFilePath)){
            echo " upload failed- could not generate thumbnails";
            return false;
            }
            return true;
        }
    }

    private function processData($videoData, $filepath){

    $videoType= pathinfo($filepath, PATHINFO_EXTENSION);

    if(!$this->isValidType($videoType)) {
        echo "Invalid file type";
        return false;
    }

    else if($this->hasError($videoData)){
        echo "Error code:"  . $videoData["error"];
        return false;
    }

    return true;
    }

    private function isValidType($type) {
        $lowercased=strtolower($type);
        return in_array($lowercased, $this->allowedTypes);
    }

    private function hasError($data){
        return $data["error"]!=0;
    }

    private function insertVideoData($uploadData, $filePath){
        $query= $this->con->prepare("INSERT INTO videos(title, uploadedBy, description, privacy, categories, filePath)
                                    VALUES(:title, :uploadedBy, :description, :privacy, :categories, :filePath)");
        
        $query->bindParam("title", $uploadData->title);
        $query->bindParam("uploadedBy", $uploadData->uploadedBy);
        $query->bindParam("description", $uploadData->desc);
        $query->bindParam("privacy", $uploadData->privacy);
        $query->bindParam("categories", $uploadData->categories);
        $query->bindParam("filePath", $filePath);   
        
        return $query->execute();
    }

    public function generateThumbnails($filePath){
        $thumbnailSize = "266x138";
        $numThumbnails = 3;
        $pathThumbnails = "uploads/videos/thumbnails";

        $duration = $this->getVideoDuration($filePath);

        $videoId= $this->con->lastInsertId();
        $this->updatedDuration($duration, $videoId);

        for($num=1; $num<=$numThumbnails; $num++){
            $imageName=uniqid() . ".jpg";
            $interval = ($duration * 0.8)/$numThumbnails * $num;
            $endThumbnailPath= "$pathThumbnails/$videoId-$imageName";

            $cmd = "$this->ffmpegPath -i $filePath -ss $interval -s $thumbnailSize -vframes 1 $endThumbnailPath 2>&1";

            $outputLog = array();
            exec($cmd, $outputLog, $returnCode);
            
            if($returnCode != 0) {
                //Command failed
                foreach($outputLog as $line) {
                    echo $line . "<br>";
                }
            }

            $query = $this->con->prepare("INSERT INTO thumbnails(videoId, filePath, selected)
                                        VALUES(:videoId, :filePath, :selected)");
            $query->bindParam(":videoId", $videoId);
            $query->bindParam(":filePath", $endThumbnailPath);
            $query->bindParam(":selected", $selected);

            $selected = $num == 1 ? 1 : 0;

            $success = $query->execute();

            if(!$success) {
                echo "Error inserting thumbail\n";
                return false;
            }
        }

        return true;
    }
    private function getVideoDuration($filePath){

        return (int)shell_exec("$this->ffprobePath -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 $filePath");
    }

    private function updatedDuration($duration, $videoId){
        

        $hours= floor($duration / 3600);
        $mins = floor(($duration-($hours*3600)) / 60);
        $secs = floor($duration % 60);

        $hours= ($hours<1)? "" : $hours . ":";
        $mins= ($mins<10)? "0" . $mins . ":" : $mins . ":";
        $secs= ($secs<10)? "0" . $secs: $secs;

        $duration = $hours . $mins . $secs;

        $query = $this->con->prepare("UPDATE videos SET duration=:duration WHERE id=:videoId");
        $query->bindParam(":duration", $duration);
        $query->bindParam(":videoId", $videoId);
        $query->execute();
    }

}
?>

