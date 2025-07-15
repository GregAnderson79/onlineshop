<?php

// Get item image name
// For deleting the images from the upload folder
class GetItemImgName_View extends GetItemImgName_Contr {
    public $imgID;

    public function __construct($imgID) {
        $this->imgID = $imgID;
    }

    public function view_getItemImgName() {
        // validate ID
        if ($this->validateID()) {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        return $this->getItemImgName();
    }

    private function getItemImgName() {
        return $this->contr_getItemImgName();
    }

    // validate ID
    private function validateID() {
        if (!is_numeric($this->imgID)) {
            return true;
        }
    }
}