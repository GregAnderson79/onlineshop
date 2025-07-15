<?php
// Get item image name (Controller)
// For deleting the images from the upload folder
namespace Item\Images\ImageName;

class Process extends Model {
    protected function process() {
        $imgArray = $this->query();
        if (isset($imgArray)) {
            $imgName = $imgArray['imgName'];
            return $imgName;
        } else {
            return "0"; // empty url
        }

        unset($imgArray, $imgName);
    }
}