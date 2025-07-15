<?php
// Get item image name (View)
// For deleting the images from the upload folder
namespace Items\Item\Images\ImageName;

class GetName extends Process {
    public $imgID;

    public function __construct($imgID) {
        $this->imgID = $imgID;
    }

    public function imageName() {
        // validate ID
        if ($this->validateID()) {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        return $this->process();
    }

    // validate ID
    private function validateID() {
        if (!is_numeric($this->imgID)) {
            return true;
        }
    }
}