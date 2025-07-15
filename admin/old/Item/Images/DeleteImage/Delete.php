<?php
// Delete item image
namespace Item\Images\DeleteImage;

class Delete extends Model {
    public $imgID;
    public $itemID;
    public $itemImgName;

    public function __construct($imgID, $itemID, $itemImgName) {
        $this->imgID = $imgID;
        $this->itemID = $itemID;
        $this->itemImgName = $itemImgName;
    }

    public function process() {

        // validate IDs
        if ($this->validateIDs()) {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        if ($this->delete() === true) {

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
    private function delete() {
        return $this->query();
    }

    // validate IDs
    private function validateIDs() {
        if ((!is_numeric($this->itemID)) || (!is_numeric($this->imgID))) {
            return true;
        }
    }
}