<?php

// Delete item image
class DelItemImg_Contr extends SetItemImg_Model {
    public $imgID;
    public $itemID;
    public $itemImgName;

    public function __construct($imgID, $itemID, $itemImgName) {
        $this->imgID = $imgID;
        $this->itemID = $itemID;
        $this->itemImgName = $itemImgName;
    }

    public function contr_delItemImg() {

        // validate IDs
        if ($this->validateIDs()) {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        if ($this->delItemImg() === true) {

            // delete images from upload folder
            if (file_exists("itemImages/resized_" . $this->itemImgName)) {
                unlink("itemImages/resized_" . $this->itemImgName);
            }
            if (file_exists("itemImages/thumb_" . $this->itemImgName)) {
			    unlink("itemImages/thumb_" . $this->itemImgName);
            }
            
            header("location: " . pageURL(true,true) . "action=itemImgList&itemID=" . $this->itemID);
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }
    }

    // model
    private function delItemImg() {
        return $this->model_delItemImg();
    }

    // validate IDs
    private function validateIDs() {
        if ((!is_numeric($this->itemID)) || (!is_numeric($this->imgID))) {
            return true;
        }
    }
}