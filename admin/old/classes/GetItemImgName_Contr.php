<?php

// Get item image name
// For deleting the images from the upload folder
class GetItemImgName_Contr extends GetItemImgName_Model {

    protected function contr_getItemImgName() {
        $imgArray = $this->model_getItemImgName();
        if (isset($imgArray)) {
            $imgName = $imgArray['imgName'];
            return $imgName;
        } else {
            return "0"; // image url that can't exist
        }
    }
}