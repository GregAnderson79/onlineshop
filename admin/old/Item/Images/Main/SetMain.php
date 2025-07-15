<?php
// Set item image to "main" (Controller)
namespace Item\Images\Main;

class SetMain extends Model {
    public $imgID;
    public $itemID;

    public function __construct($imgID, $itemID) {
        $this->imgID = $imgID;
        $this->itemID = $itemID;
    }

    public function process() { 
        // validate IDs
        if ($this->validateIDs()) {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        // unset, set
        if ($this->unset() === true) {
            if ($this->set() === true) {
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
    private function unset() {
        return $this->queryUnset();
    }

    // model
    private function set() {
        return $this->querySet();
    }
}