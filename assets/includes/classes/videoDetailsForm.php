<?php class videoDetailsForm {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function createUploadForm(){
        $fileInput=$this->createFileInput();
        $titleInput=$this->createTitleInput(null);
        $descInput=$this->createDescInput(null);
        $privacyInput=$this->createPrivacyInput(null);
        $categoriesInput=$this->createCategoriesInput(null);
        $uploadInput=$this->createUploadButton();

    return
        "<form action='processing.php' method='POST' enctype='multipart/form-data'>
            $fileInput
            $titleInput
            $descInput
            $privacyInput
            $categoriesInput
            $uploadInput
        </form>";
    }

    public function createEditDetailsForm($video) {
        $titleInput = $this->createTitleInput($video->getTitle());
        $descriptionInput = $this->createDescInput($video->getDescription());
        $privacyInput = $this->createPrivacyInput($video->getPrivacy());
        $categoriesInput = $this->createCategoriesInput($video->getCategories());
        $saveButton = $this->createSaveButton();
        return "<form method='POST'>
                    $titleInput
                    $descriptionInput
                    $privacyInput
                    $categoriesInput
                    $saveButton
                </form>";
    }

    private function createFileInput(){
        return "<div>
                    <label for='file'><b>Add the video file</b>
                    </label><br>
                    <input type='file' id='file' required name='fileInput' >
                </div><br>";
    }

    private function createTitleInput($value) {
        if($value == null) $value = "";
        return "<div>
                    <input type='text' id='title' name='titleInput' placeholder='Title' value='$value' required>
                </div><br>";
    }

    private function createDescInput($value) {
        if($value == null) $value = "";
        return "<div>
                    <textarea name='descInput' id='desc' cols='70' rows='7' placeholder='Description' >$value</textarea>
                </div><br>";
    }

    private function createPrivacyInput($value) {
        if($value == null) $value = "";

        $privateSelected = ($value == 0) ? "selected='selected'" : "";
        $publicSelected = ($value == 1) ? "selected='selected'" : "";
        return "<div>
                    <select name='privacyInput'>
                        <option value='0' $privateSelected>private</option>
                        <option value='1' $publicSelected> public</option>
                    </select>
                </div>";
    }

    private function createCategoriesInput($value) {
        if($value == null) $value = "";
        $query = $this->con->prepare("SELECT * FROM categories");
        $query->execute();

        $html = "<br><div>
                    <label class='categories'> <b>Select Your category<b></label><br>
                    <select class='categories' name = 'categoriesInput'>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $id = $row["id"];
            $name = $row["name"];
            $selected = ($id == $value) ? "selected='selected'" : "";

            $html .="<option $selected value='$id'>$name</option>";
                    

        }
        $html .="</select>
        </div>";
        return $html;
    }

    private function createUploadButton(){
        return "<br><button type='submit' name = 'uploadButton'>Upload</button>";
    }

    private function createSaveButton() {
        return "<button type='submit' class='btn btn-primary' name='saveButton'>Save</button>";
    }
}
?>