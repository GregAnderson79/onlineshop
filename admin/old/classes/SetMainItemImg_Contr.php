<?php

// Set item image to "main"
class SetMainItemImg_Contr extends SetMainItemImg_Model {
    public $imgID;
    public $itemID;

    public function __construct($imgID, $itemID) {
        $this->imgID = $imgID;
        $this->itemID = $itemID;
    }

    public function contr_setMainItemImg() { 
        // validate IDs
        if ($this->validateIDs()) {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        // unset, set
        if ($this->unsetCurrentMain() === true) {
            if ($this->setMainImg() === true) {
                header("location: " . pageURL(true,true) . "action=itemImgList&itemID=" . $this->itemID);
            } else {
                header("location: " . pageURL(true,true) . "&error=0");
            }
        } else {
            header("location: " . pageURL(true,true) . "&error=0");
        }
    }

    // validate IDs
    private function validateIDs() {
        if ((!is_numeric($this->itemID)) || (!is_numeric($this->imgID))) {
            return true;
        }
    }

    // unset current main image
    private function unsetCurrentMain() {
        return $this->model_unsetCurrentMain();
    }

    // model
    private function setMainImg() {
        return $this->model_setMainImg();
    }
}