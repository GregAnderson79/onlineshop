<?php

// Set item image
class SetItemImg_Model extends Database_Model {

    // set item image
    protected function model_setItemImg($imgName) {
        if ($this->itemID) {
            $sql = "INSERT INTO itemImages (imgName, itemID, isMain, altTag, caption) VALUES (?, ?, ?, ?, ?);";
            $statement = $this->connect()->prepare($sql);
            if (!$statement->execute([$imgName, $this->itemID, false, $this->altTag, $this->caption])) {
                $statement = null;
                header("location: " . pageURL(true,true) . "error=0");
                exit();
            } else {
                return true;
                $statement = null;
            }
        }
    }

    // delete item image
    protected function model_delItemImg() {
        $sql = "DELETE FROM itemImages WHERE imgID = ?;";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->imgID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }
}